$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').each(function(){
        $(this).select2({
            allowClear:true,
            placeholder:$(this).data('placeholder')
        })
    })

    var $summernote = $('.summernote');
    $summernote.each(function(){
        var _this = $(this)
        var _disable = _this.data('disable')
        _this.summernote(
            {
                disable:true,
                inheritPlaceholder: true,
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['help']]
                ],
            });
        _this.summernote(_disable);
    });

    $('.modal-note').on('click',function(){
        var _val = $(this).data('note')
        $('#detail_note_project').find('#editor1').attr('data-note',_val);
    });

    $('#detail_note_project .modal-note').click(function(e){
        // start here
    });

    /**
     * handle for open modal note
     * data will get from db using ajax
     */
    $('#detail_note_project').on('shown.bs.modal', function(e) {
        var _this = $(this);
        var _note_viewer = _this.find('.js-note-viewer');
        var relatedTarget = $(e.relatedTarget)
        var _id = relatedTarget.data('id');
        var _note = relatedTarget.data('note');
        $.ajax({
            url:'/project/getProjectNote/'+_id,
            type:'get',
            success:function(data){
                if(data.status === 200){
                    var editor = CKEDITOR.instances['editor1'];
                    _this.find('.modal-body').removeClass('d-none')
                    _this.find('.js-project_id').val(data.project.id);
                    if(_note_viewer.length > 0){
                        _this.find('.js-project_note').html(data.project.note)
                    } else {
                        editor.setData(data.project.note);
                    }
                    _this.find('.loader-box').addClass('d-none');
                }
            }
        })

    });

    /**
     * Hide Ckeditor
     * Show Loading
     */
    $('#detail_note_project').on('hide.bs.modal', function(e) {
        var _this = $(this);
        _this.find('.modal-body').addClass('d-none')
        _this.find('.loader-box').removeClass('d-none');
    });

    /**
     * Save Note
     */
    $('.js-save-note').on('click',function(){
        var _id = $(this).closest('.detail_note_project').find('.js-project_id').val()
        var editor = CKEDITOR.instances['editor1'];
        var _note = editor.getData();
        var _url = 'project/'+_id;
        var _modalNote = $('#detail_note_project');

        try{
            $.ajax({
                url:_url,
                data:{project_id:_id,note:_note,isQuickUpdate:true},
                type:'put',
                success:function(data){
                    if(data.status === 200){
                        _modalNote.modal('toggle');
                        notification('','Note Successfully Added','')
                    }
                }
            })
        }catch(error){
            console.log(error)
        }
    });

    /**
     * Show Modal Confirmation Delete
     */
    $('#projectDelete').on('shown.bs.modal', function (e){
        var relatedTarget = $(e.relatedTarget)
        var _id = relatedTarget.data('id');
        var _this = $(this);
        _this.find('.js-id-delete').val(_id)
    })

    /**
     * Delete Project
     */
    $('.js-delete-project').on('click',function(){
        var _this = $(this);
        var _parent = _this.closest('#projectDelete');
        var _id = _parent.find('.js-id-delete').val();
        var url = '/project/'+_id;

        $.ajax({
            url:url,
            type:'delete',
            success:function (data){
                if(data.status === 200){
                    $('#projectDelete').modal('toggle')
                    notification('danger','Project Successfully Deleted','fa fa-cross')
                    setTimeout(function(){
                        location.reload();
                    },1500)
                }
            }
        })
    });

    /**
     * Export Handle From Controller Using AJAX
     */
    $('.btn-export').on('click',function(e){
        e.preventDefault();
        var _this = $(this);
        _this.attr('disabled','disabled')
        _this.find('.js-icon-download').addClass('d-none');
        _this.find('.loader-34').removeClass('d-none');
        $.ajax({
            url: 'export',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function (data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = 'risk-ranking-2023.xlsx';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                _this.find('.js-icon-download').removeClass('d-none');
                _this.find('.loader-34').addClass('d-none');
                _this.removeAttr('disabled')
            }
        });
    });

    /**
     * Handle Update BC Status
     */
    $('.js-switch-bc_status').each(function(){
        var _this = $(this)
        _this.on('change',function (){
            var __this = $(this);
            var _id = __this.data('id');
            var _val = 'mature';
            var _badge_status = __this.closest('.js-row-bc_status').find('.js-badge-status');
            __this.attr('disabled'); //not work
            if (__this.is(":checked")) {
                __this.siblings('span').removeClass('bg-danger');
                _badge_status.removeClass('badge-danger');
                _badge_status.addClass('badge-success');
                _badge_status.text('Mature');
            } else {
                _val = 'not_mature';
                __this.siblings('span').addClass('bg-danger');
                _badge_status.removeClass('badge-success');
                _badge_status.addClass('badge-danger');
                _badge_status.text('Not Mature');
            }

            $.ajax({
                url:'project/'+_id,
                method: 'put',
                data:{bc_status:_val,isQuickUpdate:true},
                success:function(data){
                    __this.removeAttr('disabled')
                    notification('','BC Status Updated')
                }
            })

        })
    })

 /* ================================================================================================
    Project Form JS Start
  */

    var projectCategoryInit =  function (el){
        var _this = $(el);
        if(_this.data("select2")) _this.select2("destroy");
        _this.select2({
            placeholder:"please select",
            allowClear: true,
            width:'100%',
            ajax:{
                url : _this.data('url'),
                data:function (params) {
                    var category = _this.closest('.js-project-form').find('.js-select-project-category').val();
                    return {
                        category: category,
                        q: params.term
                    }
                },
                processResults: function (resp) {
                    return {
                        results: resp
                    }
                }
            }
        })
    }

    var projectSponsorInit =  function (el){
        var _this = $(el);
        if(_this.data("select2")) _this.select2("destroy");
        _this.select2({
            placeholder:"please select",
            allowClear: true,
            width:'100%',
            ajax:{
                url : _this.data('url'),
                data:function (params) {
                    var owner = _this.closest('.js-project-form').find('.js-select-owner').val();
                    return {
                        user_department : _this.data('id'),
                        owner: owner,
                        q: params.term
                    }
                },
                processResults: function (resp) {
                    return {
                        results: resp
                    }
                }
            }
        })
    }

    var _projectCategory = $('.js-project-type');
    _projectCategory.each(function(){
        projectCategoryInit(this)
    })

    var _project_sponsor = $('.js-select-sponsor');
    _project_sponsor.each(function(){
        projectSponsorInit(this)
    })

    $('.js-select-project-category').on('change',function(){
        $(this).closest('.js-project-form').find('.js-project-type').val('').trigger('change')
    });

    $('.js-select-owner').on('change',function(){
        $(this).closest('.js-project-form').find('.js-select-sponsor').val('').trigger('change')
    });

    /**
     * Handle Notification After save and Update Data
     */
    var _notif = $('.check-notification');
    if(_notif.length > 0){
        var _message = _notif.data('msg')
        notification('',_message,'')
    }

    /**
     * Handle Show Hide Project Edit Form
     */
    $('.js-btn-edit_project').on('click',function(){
        var _this = $(this)
        var _parent = _this.closest('.js-tab-parent');
        _parent.find('.js-form-project-edit').removeClass('d-none');
        _parent.find('.js-form-project-detail').addClass('d-none');
        $(this).addClass('d-none');
        _parent.find('.js-title-form').removeClass('d-none')
        _parent.find('.js-title-detail').addClass('d-none')
        _parent.find('.js-btn-view_project').removeClass('d-none')
    })

    $('.js-btn-view_project').on('click',function(){
        var _this = $(this)
        var _parent = _this.closest('.js-tab-parent');
        _parent.find('.js-form-project-edit').addClass('d-none');
        _parent.find('.js-form-project-detail').removeClass('d-none');
        $(this).addClass('d-none');
        _parent.find('.js-title-form').addClass('d-none')
        _parent.find('.js-title-detail').removeClass('d-none')
        _parent.find('.js-btn-edit_project').removeClass('d-none')
    })

    /**
     * Handle Limit Text in Assessment
     */
    $('.js-expand-text').each(function(){
        var _this = $(this);
        _this.on('click',function(){
            $(this).closest('.js-limit-char').addClass('d-none');
            $(this).closest('td').find('.js-expand-char').removeClass('d-none');
        })
    })

    $('.js-hide-text').each(function(){
        var _this = $(this);
        _this.on('click',function(){
            $(this).closest('.js-expand-char').addClass('d-none');
            $(this).closest('td').find('.js-limit-char').removeClass('d-none');
        })
    })

    /**
     * Froala Editor
     */
    var editor = new FroalaEditor('div.froala',{
        heightMin: 100,
        heightMax: 200,
        lineHeights: {
            '1.15': '1.15',
            '1.5': '1.5',
            Double: '2'
        },
        toolbarButtons:['undo', 'redo' , 'bold', 'italic', 'underline','lineHeights','insert','formatOL', 'formatUL', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'insertImage']
    }, function (){
        // Block Function for froala
    });

    /**
     * Handle Hide Show Editor Form
     */
    var _check_count = 0;

    $('.js-checkbox-assessment').each(function(){
        var _this = $(this)
        var _btn_submit_assessment = $('.js-create-assessment');
        _this.on('change',function (){
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_assessment, true)
        })
    })


    function checkDisableButton(__this, _btn_submit_assessment, isHaveFroala, _checkAll, _checkCount){
        var _editor = __this.closest('tr').find('.froala')
        if(__this.is(':checked')){
            if(_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) __this.closest('tr').find('.js-cost-estimate').removeClass('d-none')
            _editor.removeClass('d-none')
            _check_count += 1
        } else {
            if(_check_count > 0 && !_checkAll){
                _check_count -=1;
            }

            if(_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) {
                __this.closest('tr').find('.js-cost-estimate').addClass('d-none')
                __this.closest('tr').find('.js-cost_estimate_assessment').val("")
            }
            _editor.find('.fr-element').text('')
            _editor.addClass('d-none')

        }

        if(_check_count < 1) {
            _btn_submit_assessment.attr('disabled','disabled')
            _btn_submit_assessment.find('.loader-34').addClass('d-none')
            return false
        } else {
            _btn_submit_assessment.removeAttr('disabled')
        }
    }

    /**
     * Save Assessment Using AJAX
     */

    $('.js-create-assessment').on('click',function (e){
        e.preventDefault();
        var _this = $(this);
        var _form = _this.closest('.js-assessment-form');
        var _check_problem_statement = $('#checkbox-problem-statement')
        var _check_objective = $('#checkbox-objective')
        var _check_project_scope = $('#checkbox-project-scope')
        var _check_key_performance = $('#checkbox-kpm')
        var _check_project_risk = $('#checkbox-prm')
        var _check_impact_not_executed = $('#checkbox-iie')
        var _check_alternative = $('#checkbox-alternative')
        var _check_cost_estimate = $('#checkbox-cost-estimate')
        var _check_level = $('#checkbox-level')
        var _check_detail_cost = $('#checkbox-detail-estimate')
        var _text_problem_statement = editor[0].html.get()
        var _text_objective = editor[1].html.get()
        var _text_project_scope = editor[2].html.get()
        var _text_key_performance = editor[3].html.get()
        var _text_project_risk = editor[4].html.get()
        var _text_impact = editor[5].html.get()
        var _text_alternative = editor[6].html.get()
        var _text_cost_estimate = _form.find('.js-cost_estimate_assessment').val()
        var _text_complexity_score = $('.js-select-score').val()
        var _text_level_project = editor[7].html.get()
        var _text_detail_estimate = editor[8].html.get()
        var _project_id = $('.js-project-id').val();
        var _url_submit = _form.attr('action')
        var _type = _form.attr('method');
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.attr('disabled','disabled')
        _this.find('.loader-34').removeClass('d-none')

        if(!_form.valid()){
            _this.removeAttr('disabled')
            _this.find('.loader-34').addClass('d-none')
            return false
        }

        $.ajax({
            url: _url_submit,
            type:_type,
            data:{
                project_id : _project_id,
                problems_statement : setBooleanNumber(_check_problem_statement.is(':checked')),
                objective : setBooleanNumber(_check_objective.is(':checked')),
                project_scope: setBooleanNumber(_check_project_scope.is(':checked')),
                key_performance_metric: setBooleanNumber(_check_key_performance.is(':checked')),
                key_project_risk_mitigants:setBooleanNumber(_check_project_risk.is(':checked')),
                impact_if_not_executed:setBooleanNumber(_check_impact_not_executed.is(':checked')),
                cost_estimate:setBooleanNumber(_check_cost_estimate.is(':checked')),
                level_project:setBooleanNumber(_check_level.is(':checked')),
                alternative_to_proposal:setBooleanNumber(_check_alternative.is(':checked')),
                detail_estimate_cost:setBooleanNumber(_check_detail_cost.is(':checked')),
                problem_statement_text:_text_problem_statement,
                objective_text:_text_objective,
                project_scope_text:_text_project_scope,
                key_performance_metric_text:_text_key_performance,
                key_project_risk_mitigants_text:_text_project_risk,
                impact_if_not_executed_text:_text_impact,
                alternatives_to_proposal_text:_text_alternative,
                cost_estimate_text:_text_cost_estimate,
                level_project_text:_text_level_project,
                detail_estimate_cost_text:_text_detail_estimate,
                complexity_score_assessment:_text_complexity_score,
                status:_status,
            },
            success:function (data){
                window.location.href = data.url;
            }
        })
    })

    function setBooleanNumber(val){
        if(val === true) return 1;
        return 0;
    }


    $('.js-assessment-create').validate({
        ignore: [],
        focusInvalid: false,
        invalidHandler: function(form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_problem_statement: {
                required: {
                    depends: function (){
                        if($('#checkbox-problem-statement').is(':checked') &&
                        removeHtmlTag(editor[0].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_objective:{
                required: {
                    depends: function (){
                        if($('#checkbox-objective').is(':checked') &&
                            removeHtmlTag(editor[1].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_project_scope:{
                required: {
                    depends: function (){
                        if($('#checkbox-project-scope').is(':checked') &&
                            removeHtmlTag(editor[2].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_kpm:{
                required: {
                    depends: function (){
                        if($('#checkbox-kpm').is(':checked') &&
                            removeHtmlTag(editor[3].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_prm:{
                required: {
                    depends: function (){
                        if($('#checkbox-prm').is(':checked') &&
                            removeHtmlTag(editor[4].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_iie:{
                required: {
                    depends: function (){
                        if($('#checkbox-iie').is(':checked') &&
                            removeHtmlTag(editor[5].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_alternative:{
                required: {
                    depends: function (){
                        if($('#checkbox-alternative').is(':checked') &&
                            removeHtmlTag(editor[6].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_cost_estimate:{
                required: {
                    depends: function (){
                        if($('#checkbox-cost-estimate').is(':checked') &&
                            !$('.js-cost_estimate_assessment').val()
                            ){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_level:{
                required: {
                    depends: function (){
                        if($('#checkbox-level').is(':checked') &&
                            removeHtmlTag(editor[8].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_detail_estimate:{
                required: {
                    depends: function (){
                        if($('#checkbox-detail-estimate').is(':checked') &&
                            removeHtmlTag(editor[9].html.get()) === ''){
                            return true
                        }
                        return false;
                    }
                }
            },
        },
        messages:{
            validate_problem_statement:{
                required: "Since you check problem statement this field is required"
            },
            validate_objective: {
                required: "Since you check Objective this field is required"
            },
            validate_project_scope :{
                required : "Since you check Project Scope this field is required"
            },
            validate_kpm :{
               required : "Since you check Key Performance Metric this field is required"
            },
            validate_prm :{
                required : "Since you check Key Project Risk Mitigants this field is required"
            },
            validate_iie :{
                required: "Since you check Impact If not Executed this field is required"
            },
            validate_alternative :{
                required: "Since you check Alternative To Proposal this field is required"
            },
            validate_cost_estimate :{
                required: "Since you check Cost Estimate this field is required"
            },
            validate_level :{
                required: "Since you check Level Project this field is required"
            },
            validate_detail_estimate :{
                required: "Since you check Detail Estimate Cost this field is required"
            },
        },
        errorElement : 'span',
        errorPlacement:function (error,element){
            if(element.hasClass('js-hidden-validate')){
                element.siblings('.js-error-message').html(error)
            }
        }
    })

    function removeHtmlTag(text){
        if(!text) return '';
        return text.replace(/(<([^>]+)>)/ig,"").trim()
    }

    /**
     * This block for set session laravel from js using ajax
     */
    $('.js-set-session').each(function(){
        var _this = $(this)
        _this.on('click',function(e){
            e.preventDefault()
            var __this = $(this)
            var _tab = __this.data('url')
            var _action = __this.data('action')
            var _project_id = __this.data('id')
            __this.find('i').addClass('d-none')
            __this.find('.loader-box').removeClass('d-none')
            $.ajax({
                url:'setSession',
                data:{
                    tab : _tab,
                    action : _action,
                    project_id : _project_id
                },
                success : function(data){
                    window.location.href = data
                    setTimeout(function (){
                        __this.find('i').removeClass('d-none')
                        __this.find('.loader-box').addClass('d-none')
                    },3000)
                }
            })
        })
    })

    /**
     * Fel 1 Section
     */
    var _fel1_submit_form = $('.js-create-fel1')

    _fel1_submit_form.on('click',function(e){
        e.preventDefault();
        var _this = $(this)
        var _form = _this.closest('.js-fel1-form');
        var _project_scope = $('#checkbox-project_scope');
        var _identified_parameter = $('#checkbox-identified_parameter');
        var _alternative = $('#checkbox-alternatives');
        var _list_of_stakeholder = $('#checkbox-list_of_stakeholder')
        var _schedule_project = $('#checkbox-schedule');
        var _project_id = _form.find('.js-project-id').val();
        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.find('.loader-34').removeClass('d-none')
        _this.attr('disabled');
        $.ajax({
            url:_url,
            type:_type,
            data:{
                project_id:_project_id,
                project_scope:setBooleanNumber(_project_scope.is(':checked')),
                identified_parameter_requirement_regulation:setBooleanNumber(_identified_parameter.is(':checked')),
                alternatives:setBooleanNumber(_alternative.is(':checked')),
                list_of_stakeholder:setBooleanNumber(_list_of_stakeholder.is(':checked')),
                schedule_project:setBooleanNumber(_schedule_project.is(':checked')),
                status : _status
            },
            success:function (data){
                window.location.href = data.url;
            }
        })
    })


    $('.js-checkbox-fel1').each(function(){
        var _this = $(this)
        var _btn_submit_fel1 = $('.js-create-fel1');
        _this.on('change',function (){
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel1,false)
        })
    })


    /**
     * Fel 2 Section
     */
    var _fel2_submit_form = $('.js-create-fel2')

    _fel2_submit_form.on('click',function(e){
        e.preventDefault();
        var _this = $(this)
        var _form = _this.closest('.js-fel2-form');
        var _project_scope = _form.find('#checkbox-project_scope-fel2');
        var _identify_main_equipment = _form.find('#checkbox-identify_main_equipment');
        var _boundary_assumption = _form.find('#checkbox-boundary_assumption');
        var _analysis_of_option = _form.find('#checkbox-analysis_of_option')
        var _permit_list = _form.find('#checkbox-permit_list');
        var _schedule_project = _form.find('#checkbox-schedule_project');
        var _cost_estimate = _form.find('#checkbox-cost_estimate');
        var _project_id = _form.find('.js-project-id').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.find('.loader-34').removeClass('d-none')
        _this.attr('disabled');
        $.ajax({
            url:_url,
            type:_type,
            data:{
                project_id:_project_id,
                project_scope:setBooleanNumber(_project_scope.is(':checked')),
                identify_main_equipment:setBooleanNumber(_identify_main_equipment.is(':checked')),
                boundary_and_assumption:setBooleanNumber(_boundary_assumption.is(':checked')),
                analysis_of_option:setBooleanNumber(_analysis_of_option.is(':checked')),
                permit_list:setBooleanNumber(_permit_list.is(':checked')),
                schedule_project:setBooleanNumber(_schedule_project.is(':checked')),
                cost_estimate:setBooleanNumber(_cost_estimate.is(':checked')),
                status : _status
            },
            success:function (data){
                window.location.href = data.url;
            }
        })
    })


    $('.js-checkbox-fel2').each(function(){
        var _this = $(this)
        var _btn_submit_fel2 = $('.js-create-fel2');
        checkDisableButton(_this,_btn_submit_fel2,false,true, true)
        _this.on('change',function (){
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel2,false, false)
        })
    })

    /**
     * Fel 3 Section
     */
    var _fel3_submit_form = $('.js-create-fel3')

    _fel3_submit_form.on('click',function(e){
        e.preventDefault();
        var _this = $(this)
        var _form = _this.closest('.js-fel3-form');
        var _executive_summary = _form.find('#checkbox-executive_summary');
        var _problem_statement = _form.find('#checkbox-problem_statement_fel3');
        var _project_scope = _form.find('#checkbox-project_scope_fel_3');
        var _alternatives = _form.find('#checkbox-alternatives_best_option')
        var _project_schedule = _form.find('#checkbox-project_schedule_fel_3');
        var _list_of_equipment = _form.find('#checkbox-list_of_equipment');
        var _hazop = _form.find('#checkbox-hazop');
        var _cost_estimate = _form.find('#checkbox-cost_estimate_fel3');

        var _project_id = _form.find('.js-project-id').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.find('.loader-34').removeClass('d-none')
        _this.attr('disabled');
        $.ajax({
            url:_url,
            type:_type,
            data:{
                project_id:_project_id,
                executive_summary:setBooleanNumber(_executive_summary.is(':checked')),
                problem_statement:setBooleanNumber(_problem_statement.is(':checked')),
                project_scope:setBooleanNumber(_project_scope.is(':checked')),
                alternatives_and_best_option:setBooleanNumber(_alternatives.is(':checked')),
                project_schedule:setBooleanNumber(_project_schedule.is(':checked')),
                list_of_equipment_and_specification:setBooleanNumber(_list_of_equipment.is(':checked')),
                hazop_study:setBooleanNumber(_hazop.is(':checked')),
                cost_estimate:setBooleanNumber(_cost_estimate.is(':checked')),
                status : _status
            },
            success:function (data){
                window.location.href = data.url;
            }
        })
    })


    $('.js-checkbox-fel3').each(function(){
        var _this = $(this)
        var _btn_submit_fel3 = $('.js-create-fel3');
        checkDisableButton(_this,_btn_submit_fel3,false,true, true)
        _this.on('change',function (){
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel3,false, false)
        })
    })

    /**
     * Business Case Handle Here
     */
    $('.js-bc-risk-assessment-expand').on('click', function (){
        var _this = $(this);
        _this.siblings('ul').removeClass('d-none');
        _this.siblings('.js-bc-risk-assessment-hide').removeClass('d-none');
        _this.addClass('d-none');

    })

    $('.js-bc-risk-assessment-hide').on('click', function (){
        var _this = $(this);
        _this.siblings('ul').addClass('d-none');
        _this.siblings('.js-bc-risk-assessment-expand').removeClass('d-none');
        _this.addClass('d-none');

    })

    $('.js-checkbox-business_case').each(function(){
        var _this = $(this)
        var _btn_submit_bc = $('.js-create-bc');
        checkDisableButton(_this,_btn_submit_bc,false,true, true)
        _this.on('change',function (){
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_bc,false, false)
        })
    })

    var _bc_submit_form = $('.js-create-bc')

    _bc_submit_form.on('click',function(e){
        e.preventDefault();
        var _this = $(this)
        var _form = _this.closest('.js-bc-form');
        var _problem_and_objective = _form.find('#checkbox-problem_and_objective');
        var _project_alternatives = _form.find('#checkbox-project_alternative');
        var _scope_of_work = _form.find('#checkbox-scope_of_work');
        var _major_equipment = _form.find('#checkbox-major_equipment')
        var _utility_requirement = _form.find('#checkbox-utility_requirement');
        var _permitting = _form.find('#checkbox-permitting');
        var _social_community = _form.find('#checkbox-social_community');
        var _financial_evaluation = _form.find('#checkbox-financial_evaluation');
        var _risk_assessment = _form.find('#checkbox-risk_assessment');
        var _additional_information = _form.find('#checkbox-additional_information');

        var _project_id = _form.find('.js-project-id').val();

        var _risk_people = $('.js-risk-people').val();
        var _risk_finance = $('.js-risk-finance').val();
        var _risk_environment = $('.js-risk-environment').val();
        var _risk_reputation = $('.js-risk-reputation').val();
        var _risk_human_rights = $('.js-risk-human-rights').val();
        var _risk_priority = _form.find('.js-set-label-priority-level').text();
        var _risk_probability = $('.js-risk-probability').val();

        var _cost_estimate = $('.js-cost_estimate_bc').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.find('.loader-34').removeClass('d-none')
        _this.attr('disabled');

        $.ajax({
            url:_url,
            type:_type,
            data:{
                project_id:_project_id,
                problem_statement_and_objective:setBooleanNumber(_problem_and_objective.is(':checked')),
                project_alternatives:setBooleanNumber(_project_alternatives.is(':checked')),
                project_scope_of_work:setBooleanNumber(_scope_of_work.is(':checked')),
                major_equipment:setBooleanNumber(_major_equipment.is(':checked')),
                utility_requirements:setBooleanNumber(_utility_requirement.is(':checked')),
                permitting:setBooleanNumber(_permitting.is(':checked')),
                social_community_and_government:setBooleanNumber(_social_community.is(':checked')),
                financial_evaluation:setBooleanNumber(_financial_evaluation.is(':checked')),
                risk_assessment:setBooleanNumber(_risk_assessment.is(':checked')),
                additional_information:setBooleanNumber(_additional_information.is(':checked')),
                people:_risk_people,
                environment:_risk_environment,
                social_and_human_rights:_risk_human_rights,
                reputation:_risk_reputation,
                finance:_risk_finance,
                probability:_risk_probability,
                priority_level:parseInt(_risk_priority),
                status : _status,
                cost_estimate: _cost_estimate
            },
            success:function (data){
                // console.log(data)
                window.location.href = data.url;
            }
        })
    })

    $('#checkbox-risk_assessment').on('change',function(){
        var _this = $(this);
        var _parent = _this.closest('td');
        var _risk_assessment_detail = _parent.find('.js-risk-assessment-bc')
        _parent.find('.loader-box').removeClass('d-none')
        if(_this.is(':checked')){
            setTimeout(function (){
                _parent.find('.loader-box').addClass('d-none')
                _risk_assessment_detail.removeClass('d-none')
            },500)

        } else {
            _parent.find('.loader-box').addClass('d-none')
            _risk_assessment_detail.addClass('d-none')
        }
    });

    $('.js-risk-assessment-field').each(function(){
        var _this = $(this);
        _this.on('change', function(){
            var risk_level_values = [
                $('.js-risk-people').val(),
                $('.js-risk-finance').val(),
                $('.js-risk-environment').val(),
                $('.js-risk-reputation').val(),
                $('.js-risk-human-rights').val(),
            ]
            var _final_impact_score_value = Math.max.apply(Math, risk_level_values)
            $('.js-risk-assessment-bc').find('.u-rating-1to10').barrating('set', _final_impact_score_value);

            var _priority_level = setPriorityLevel(_final_impact_score_value,$('.js-risk-probability').val());
            $('.js-set-label-priority-level').text(_priority_level);
            setBackgroundPriority(_priority_level);
        })
    })


    var _existing_priority_element = $('.js-set-label-priority-level');
    if(_existing_priority_element.length > 0) {
        setBackgroundPriority(_existing_priority_element.text(),_existing_priority_element)
    }
    function setPriorityLevel(_final_impact_score, _probability){

        var _risk_matrix = [
            [30,27,25,23,22],
            [29,26,24,17,16],
            [28,20,18,10,9],
            [21,19,11,7,4],
            [15,13,8,5,2],
            [14,12,6,3,1]
        ]

        return _risk_matrix[_final_impact_score - 1][_probability - 1] // min 1 because index array is start from 0
    }

    function setBackgroundPriority(_value,element){
        var _background = 'white';
        if(element){
            _value = parseInt(element.text());
        }

        if(_value > 0 && _value < 9){
            _background = 'red';
        }
        if(_value > 8 && _value < 16){
            _background = 'orange';
        }
        if(_value > 15 && _value < 22){
            _background = 'yellow';
        }
        if(_value > 21 && _value < 31){
            _background = 'green';
        }

        $('.js-set-label-priority-level').css('background-color',_background);
    }

    $('#checkbox-same-cost-estimate').on('change',function (){
        var _this = $(this);
        var _input = _this.closest('td').find('.js-cost_estimate_bc');
        if(_this.is(':checked')){
            _input.val(_input.data('default'))
        } else {
            _input.val(0)
        }
    })
})


