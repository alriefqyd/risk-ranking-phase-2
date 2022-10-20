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
                    if(data.status){
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
                    console.log(resp);
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
            var _editor = __this.closest('tr').find('.froala, .js-select2')
            if(__this.is(':checked')){
                _editor.removeClass('d-none')
                _check_count += 1
            } else {
                if(_check_count > 0 ){
                    _check_count -=1;
                }
                _editor.addClass('d-none')
            }

            if(_check_count < 1) {
                _btn_submit_assessment.attr('disabled','disabled')
                _btn_submit_assessment.find('.loader-34').addClass('d-none')
                return false
            } else {
                _btn_submit_assessment.removeAttr('disabled')
            }
        })
    })


    /**
     * Save Assessment Using AJAX
     */

    $('.js-create-assessment').on('click',function (e){
        var _this = $(this);
        var _form = $('.js-assessment-form');
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
        var _text_cost_estimate = editor[7].html.get()
        var _text_complexity_score = $('.js-select-score').val()
        var _text_level_project = editor[8].html.get()
        var _text_detail_estimate = editor[9].html.get()
        var _project_id = $('.js-project-id').val();


        e.preventDefault();
        _this.attr('disabled','disabled')
        _this.find('.loader-34').removeClass('d-none')

        if(!_form.valid()){
            _this.removeAttr('disabled')
            _this.find('.loader-34').addClass('d-none')
            return false
        }

        $.ajax({
            url:'/assessment/',
            type:'post',
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
                draft:'draft',
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
                            removeHtmlTag(editor[7].html.get()) === ''){
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
})


