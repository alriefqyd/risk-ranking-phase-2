$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').each(function () {
        $(this).select2({
            allowClear: true,
            placeholder: $(this).data('placeholder')
        })
    })

    var $summernote = $('.summernote');
    $summernote.each(function () {
        var _this = $(this)
        var _disable = _this.data('disable')
        _this.summernote(
            {
                disable: true,
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

    $('.modal-note').on('click', function () {
        var _val = $(this).data('note')
        $('#detail_note_project').find('#editor1').attr('data-note', _val);
    });

    $('#detail_note_project .modal-note').click(function (e) {
        // start here
    });

    /**
     * handle for open modal note
     * data will get from db using ajax
     */
    $('#detail_note_project').on('shown.bs.modal', function (e) {
        var _this = $(this);
        var _note_viewer = _this.find('.js-note-viewer');
        var relatedTarget = $(e.relatedTarget)
        var _id = relatedTarget.data('id');
        var _note = relatedTarget.data('note');
        $.ajax({
            url: '/project/getProjectNote/' + _id,
            type: 'get',
            success: function (data) {
                if (data.status === 200) {
                    var editor = CKEDITOR.instances['editor1'];
                    _this.find('.modal-body').removeClass('d-none')
                    _this.find('.js-project_id').val(data.project.id);
                    if (_note_viewer.length > 0) {
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
    $('#detail_note_project').on('hide.bs.modal', function (e) {
        var _this = $(this);
        _this.find('.modal-body').addClass('d-none')
        _this.find('.loader-box').removeClass('d-none');
    });

    /**
     * Save Note
     */
    $('.js-save-note').on('click', function () {
        var _id = $(this).closest('.detail_note_project').find('.js-project_id').val()
        var editor = CKEDITOR.instances['editor1'];
        var _note = editor.getData();
        var _url = 'project/' + _id;
        var _modalNote = $('#detail_note_project');

        try {
            $.ajax({
                url: _url,
                data: {project_id: _id, note: _note, isQuickUpdate: true},
                type: 'put',
                success: function (data) {
                    if (data.status === 200) {
                        _modalNote.modal('toggle');
                        notification('', 'Note Successfully Added', '')
                    }
                }
            })
        } catch (error) {
            console.log(error)
        }
    });

    /**
     * Show Modal Confirmation Delete
     */
    $('#projectDelete').on('shown.bs.modal', function (e) {
        var relatedTarget = $(e.relatedTarget)
        var _id = relatedTarget.data('id');
        var _this = $(this);
        _this.find('.js-id-delete').val(_id)
    })

    /**
     * Delete Project
     */
    $('.js-delete-project').on('click', function () {
        var _this = $(this);
        var _parent = _this.closest('#projectDelete');
        var _id = _parent.find('.js-id-delete').val();
        var url = '/project/' + _id;

        $.ajax({
            url: url,
            type: 'delete',
            success: function (data) {
                if (data.status === 200) {
                    $('#projectDelete').modal('toggle')
                    notification('danger', 'Project Successfully Deleted', 'fa fa-cross')
                    setTimeout(function () {
                        location.reload();
                    }, 1500)
                }
            }
        })
    });

    /**
     * Export Handle From Controller Using AJAX
     */
    $('.btn-export').on('click', function (e) {
        e.preventDefault();
        var _this = $(this);
        _this.attr('disabled', 'disabled')
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
    $('.js-switch-bc_status').each(function () {
        var _this = $(this)
        _this.on('change', function () {
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
                url: 'project/' + _id,
                method: 'put',
                data: {bc_status: _val, isQuickUpdate: true},
                success: function (data) {
                    __this.removeAttr('disabled')
                    notification('', 'BC Status Updated')
                }
            })

        })
    })

    /* ================================================================================================
       Project Form JS Start
     */

    var projectCategoryInit = function (el) {
        var _this = $(el);
        if (_this.data("select2")) _this.select2("destroy");
        _this.select2({
            placeholder: "please select",
            allowClear: true,
            width: '100%',
            ajax: {
                url: _this.data('url'),
                data: function (params) {
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

    var projectSponsorInit = function (el) {
        var _this = $(el);
        if (_this.data("select2")) _this.select2("destroy");
        _this.select2({
            placeholder: "please select",
            allowClear: true,
            width: '100%',
            ajax: {
                url: _this.data('url'),
                data: function (params) {
                    var owner = _this.closest('.js-project-form').find('.js-select-owner').val();
                    return {
                        user_department: _this.data('id'),
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
    _projectCategory.each(function () {
        projectCategoryInit(this)
    })

    var _project_sponsor = $('.js-select-sponsor');
    _project_sponsor.each(function () {
        projectSponsorInit(this)
    })

    $('.js-select-project-category').on('change', function () {
        $(this).closest('.js-project-form').find('.js-project-type').val('').trigger('change')
    });

    $('.js-select-owner').on('change', function () {
        $(this).closest('.js-project-form').find('.js-select-sponsor').val('').trigger('change')
    });

    /**
     * Handle Notification After save and Update Data
     */
    var _notif = $('.check-notification');
    if (_notif.length > 0) {
        try {
            var _message = _notif.data('msg')
            notification('', _message, '')
        } catch (e) {
            console.log(e)
        }

    }

    /**
     * Handle Show Hide Project Edit Form
     */
    $('.js-btn-edit_project').on('click', function () {
        var _this = $(this)
        var _parent = _this.closest('.js-tab-parent');
        _parent.find('.js-form-project-edit').removeClass('d-none');
        _parent.find('.js-form-project-detail').addClass('d-none');
        $(this).addClass('d-none');
        _parent.find('.js-title-form').removeClass('d-none')
        _parent.find('.js-title-detail').addClass('d-none')
        _parent.find('.js-btn-view_project').removeClass('d-none')
    })

    $('.js-btn-view_project').on('click', function () {
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
    $('.js-expand-text').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            $(this).closest('.js-limit-char').addClass('d-none');
            $(this).closest('td').find('.js-expand-char').removeClass('d-none');
        })
    })

    $('.js-hide-text').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            $(this).closest('.js-expand-char').addClass('d-none');
            $(this).closest('td').find('.js-limit-char').removeClass('d-none');
        })
    })

    /**
     * TinyMce
     */

    tinymce.init({
        selector: '.tinymce',
        plugins: 'table image',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        menubar: false,
        tinycomments_author: 'Author name',
        mergetags_list: [
            {value: 'First.Name', title: 'First Name'},
            {value: 'Email', title: 'Email'},
        ]
    });
    /**
     * Handle Hide Show Editor Form
     */


    var _check_count = 0;
    $('tr').find('.js-checkbox-assessment').each(function (i, e) {
        var _this = $(this)
        var _btn_submit_assessment = $('.js-create-assessment');
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_assessment, true)
        })
    })


    function checkDisableButton(__this, _btn_submit_assessment, isHaveFroala, _checkAll) {
        var _editor = __this.closest('tr').find('.tinymce')
        if (__this.is(':checked')) {
            if (_editor.length > 0) tinymce.get(_editor.attr('id')).show()
            if (_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) {
                __this.closest('tr').find('.js-cost-estimate').removeClass('d-none');
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-analysis-head').length > 0) {
                __this.closest('tr').find('.js-complexity-analysis-head').removeClass('d-none')
            }
            _check_count += 1
        } else {
            if (_check_count > 0 && !_checkAll) {
                _check_count -= 1;
            }

            if (_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) {
                __this.closest('tr').find('.js-cost-estimate').addClass('d-none');
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-analysis-head').length > 0) {
                __this.closest('tr').find('.js-complexity-analysis-head').addClass('d-none')
            }
            _editor.addClass('d-none');
            if (_editor.length > 0) {
                tinymce.get(_editor.attr('id')).hide()
            }

        }

        if (_check_count < 1) {
            _btn_submit_assessment.attr('disabled', 'disabled')
            _btn_submit_assessment.find('.loader-34').addClass('d-none')
            return false
        } else {
            _btn_submit_assessment.removeAttr('disabled')
        }
    }

    /**
     * Save Assessment Using AJAX
     */

    var _assessment_form = $('.js-assessment-form')

    $('.js-create-assessment').on('click', function (e) {
        e.preventDefault();
        tinyMCE.triggerSave();
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
        var _text_problem_statement = _check_problem_statement.is(':checked') ? $('.js-text-problem-statement').val() : ''
        var _text_objective = _check_objective.is(':checked') ? $('.js-text-objective').val() : ''
        var _text_project_scope = _check_project_scope.is(':checked') ? $('.js-text-project-scope').val() : ''
        var _text_key_performance = _check_key_performance.is(':checked') ? $('.js-key-performance').val() : ''
        var _text_project_risk = _check_project_risk.is(':checked') ? $('.js-key-project-risk').val() : ''
        var _text_impact = _check_impact_not_executed.is(':checked') ? $('.js-impact').val() : ''
        var _text_alternative = _check_alternative.is(':checked') ? $('.js-alternative').val() : ''
        var _text_cost_estimate = _check_cost_estimate.is(':checked') ? _form.find('.js-cost_estimate_assessment').val() : ''
        var _text_complexity_level = $('.js-select-score').val()
        var _text_level_project = _check_level.is(':checked') ? $('.js-text-level').val() : ''
        var _text_detail_estimate = _check_detail_cost.is(':checked') ? $('.js-text-detail-cost').val() : ''
        var _project_id = $('.js-project-id').val();
        var _url_submit = _form.attr('action')
        var _type = _form.attr('method');
        var _status = _this.data('status') ? _this.data('status') : 'draft';
        var _complexity_sore = $('.js-complexity-score-label-val').val();
        var _complexity_analysis_type = $('.js-complexity-label-val').val();

        var _new_text_level_project = $('.js-complexity-label-val').val();
        var _new_score = $('.js-complexity-score-label-val') .val();

        var _investment_just_purchase = $('input[name="investment_just_purchase"]:checked').val();
        var _needs_engineering_development = $('input[name="needs_engineering_development"]:checked').val();
        var _require_more_two = $('input[name="require_more_two"]:checked').val();
        var _require_more_two_simultant = $('input[name="require_more_two_simultant"]:checked').val();
        var _num_work_one_hundred = $('input[name="num_work_one_hundred"]:checked').val();
        var _transportation_under_vale = $('input[name="transportation_under_vale"]:checked').val();
        var _require_shutdown = $('input[name="require_shutdown"]:checked').val();
        var _interferences_delay = $('input[name="interferences_delay"]:checked').val();
        var _require_environmental_license = $('input[name="require_environmental_license"]:checked').val();
        var _require_community_involvement = $('input[name="require_community_involvement"]:checked').val();
        var _require_purchase = $('input[name="require_purchase"]:checked').val();

        // _this.attr('disabled', 'disabled')
        // _this.find('.loader-34').removeClass('d-none')
        //
        // if (!_form.valid()) {
        //     _this.removeAttr('disabled')
        //     _this.find('.loader-34').addClass('d-none')
        //     return false
        // }

        var files = $('.js-assessment-attachment_initial_cost_estimate')[0].files;
        var files_complexity = $('.js-assessment-attachment_complexity_matrix')[0].files;

        var sub_basket = null;
        $('.js-checkbox-sub-basket').each(function(){
           if($(this).is(':checked')){
               sub_basket = $(this).data('id');
           }
        });

        var formData = new FormData();
        if(files.length > 0) formData.append('document_initial_cost_estimate', files[0])
        if(files_complexity.length > 0) formData.append('document_complexity_matrix', files_complexity[0])
        formData.append('project_name', _form.data('name'))
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        formData.append('file_category', 'Project Level Assessment')
        formData.append('project_id', _project_id)
        formData.append('problems_statement', setBooleanNumber(_check_problem_statement.is(':checked')))
        formData.append('objective', setBooleanNumber(_check_objective.is(':checked')))
        formData.append('project_scope', setBooleanNumber(_check_project_scope.is(':checked')))
        formData.append('key_performance_metric', setBooleanNumber(_check_key_performance.is(':checked')))
        formData.append('key_project_risk_mitigants', setBooleanNumber(_check_project_risk.is(':checked')))
        formData.append('impact_if_not_executed', setBooleanNumber(_check_impact_not_executed.is(':checked')))
        formData.append('cost_estimate', setBooleanNumber(_check_cost_estimate.is(':checked')))
        formData.append('level_project', setBooleanNumber(_check_level.is(':checked')))
        formData.append('alternative_to_proposal', setBooleanNumber(_check_alternative.is(':checked')))
        formData.append('detail_estimate_cost', setBooleanNumber(_check_detail_cost.is(':checked')))
        formData.append('problem_statement_text', _text_problem_statement)
        formData.append('objective_text', _text_objective)
        formData.append('project_scope_text', _text_project_scope)
        formData.append('key_performance_metric_text', _text_key_performance)
        formData.append('key_project_risk_mitigants_text', _text_project_risk)
        formData.append('impact_if_not_executed_text', _text_impact)
        formData.append('alternatives_to_proposal_text', _text_alternative)
        formData.append('cost_estimate_text', _text_cost_estimate)
        formData.append('level_project_text', _text_complexity_level)
        formData.append('detail_estimate_cost_text', _text_detail_estimate)
        formData.append('complexity_score_assessment', _new_score)
        formData.append('status', _status)
        formData.append('investment_just_purchase',_investment_just_purchase ?? '');
        formData.append('needs_engineering_development',_needs_engineering_development ?? '');
        formData.append('require_more_two',_require_more_two ?? '');
        formData.append('require_more_two_simultant',_require_more_two_simultant ?? '');
        formData.append('num_work_one_hundred',_num_work_one_hundred ?? '');
        formData.append('require_shutdown',_require_shutdown ?? '');
        formData.append('interferences_delay',_interferences_delay ?? '');
        formData.append('require_environmental_license',_require_environmental_license ?? '');
        formData.append('require_community_involvement',_require_community_involvement ?? '');
        formData.append('require_purchase',_require_purchase ?? '');
        formData.append('transportation_under_vale',_transportation_under_vale ?? '');
        formData.append('score',_complexity_sore ?? '');
        formData.append('complexity_analysis_type',_complexity_analysis_type ?? '')

        $.ajax({
            url: _url_submit,
            type: _type,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === 200) window.location.href = data.url;
                else {
                    notification('danger', data, 'fa fa-time', 'Error')
                    _this.removeAttr('disabled')
                    _this.find('.loader-34').addClass('d-none')
                }
            }
        })
    })

    function setBooleanNumber(val) {
        if (val === true) return 1;
        return 0;
    }


    $('.js-assessment-create').validate({
        ignore: [],
        focusInvalid: false,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_problem_statement: {
                required: {
                    depends: function () {
                        if ($('#checkbox-problem-statement').is(':checked') &&
                            removeHtmlTag($('.js-text-problem-statement').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_objective: {
                required: {
                    depends: function () {
                        if ($('#checkbox-objective').is(':checked') &&
                            removeHtmlTag($('.js-text-objective').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_project_scope: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project-scope').is(':checked') &&
                            removeHtmlTag($('.js-text-project-scope').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_kpm: {
                required: {
                    depends: function () {
                        if ($('#checkbox-kpm').is(':checked') &&
                            removeHtmlTag($('.js-key-performance').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_prm: {
                required: {
                    depends: function () {
                        if ($('#checkbox-prm').is(':checked') &&
                            removeHtmlTag($('.js-key-project-risk').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_iie: {
                required: {
                    depends: function () {
                        if ($('#checkbox-iie').is(':checked') &&
                            removeHtmlTag($('.js-impact').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_alternative: {
                required: {
                    depends: function () {
                        if ($('#checkbox-alternative').is(':checked') &&
                            removeHtmlTag($('.js-alternative').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_cost_estimate: {
                required: {
                    depends: function () {
                        if ($('#checkbox-cost-estimate').is(':checked') &&
                            !$('.js-cost_estimate_assessment').val()
                        ) {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_level: {
                required: {
                    depends: function () {
                        if ($('#checkbox-level').is(':checked') &&
                            removeHtmlTag($('.js-text-level').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_detail_estimate: {
                required: {
                    depends: function () {
                        if ($('#checkbox-detail-estimate').is(':checked') &&
                            removeHtmlTag($('.js-text-detail-cost').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
        },
        messages: {
            validate_problem_statement: {
                required: "Since you check problem statement this field is required"
            },
            validate_objective: {
                required: "Since you check Objective this field is required"
            },
            validate_project_scope: {
                required: "Since you check Project Scope this field is required"
            },
            validate_kpm: {
                required: "Since you check Key Performance Metric this field is required"
            },
            validate_prm: {
                required: "Since you check Key Project Risk Mitigants this field is required"
            },
            validate_iie: {
                required: "Since you check Impact If not Executed this field is required"
            },
            validate_alternative: {
                required: "Since you check Alternative To Proposal this field is required"
            },
            validate_cost_estimate: {
                required: "Since you check Cost Estimate this field is required"
            },
            validate_level: {
                required: "Since you check Level Project this field is required"
            },
            validate_detail_estimate: {
                required: "Since you check Detail Estimate Cost this field is required"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            }
        }
    })

    function removeHtmlTag(text) {
        if (!text) return '';
        return text.replace(/(<([^>]+)>)/ig, "").trim()
    }

    /**
     * Handle Accordion Button to Submit in Assessment
     */
    $('.js-btn-complexity-score-accordion').on('click',function(e){
        e.preventDefault();
    });


    $('.js-cost_estimate_assessment').on('change keyup',function (){
        setAssessmentLevelProject($(this).val(),$('.js-complexity-score-label-val').val())
    })

    var _complexity_score = 0;
    var _complexity = null
    var _complexity_analysis = [
        {'key' : 'investment_just_purchase', value:0},
        {'key' : 'needs_engineering_development', value:0},
        {'key' : 'require_more_two', value:15},
        {'key' : 'require_more_two_simultant', value:15},
        {'key' : 'num_work_one_hundred', value:12},
        {'key' : 'transportation_under_vale', value:8},
        {'key' : 'require_shutdown', value:12},
        {'key' : 'interferences_delay', value:8},
        {'key' : 'require_environmental_license', value:10},
        {'key' : 'require_community_involvement', value:10},
        {'key' : 'require_purchase', value:10},
    ]
    var _array_value = [0,0,0,0,0,0,0,0,0,0,0];

    function setArrayValueToZero(_array){
        for(var i=0; i<_array.length; i++ ){
            _array_value[i] = 0;
        }
    }
    $('.js-complexity-analysis').each(function (i,v){
        var _this = $(this)

        if(_this.prop('checked') && _this.val() == 1) {
            var _existscore = _complexity_analysis.find(x => x.key === _this.attr('name')).value;
            _array_value[_this.data('idx')] = _existscore
        }

        if($('input[name="investment_just_purchase"]:checked').val() == 1 &&
            $('input[name="needs_engineering_development"]:checked').val() == 0){
            $('.js-disable-step').attr('disabled','disabled')
            $('.js-disable-step').prop('checked', false);
        }

        _this.on('change',function(){
            var __this = $(this);
            var _idx = __this.data('idx')
            var _attr_name = __this.attr('name');
            var _investment_just_purchase = $('input[name="investment_just_purchase"]:checked').val();
            var _needs_engineering_development = $('input[name="needs_engineering_development"]:checked').val();
            var _score = _complexity_analysis.find(x => x.key === _attr_name).value;
            var _sum = 0;
            var _budget_value = __this.closest('.js-table-assessment').find('.js-cost_estimate_assessment').val()
            if(_investment_just_purchase == 1
                && _needs_engineering_development == 0){
                _complexity = 'Simple Purchase'
                _complexity_score = 0;
                $('.js-disable-step').attr('disabled','disabled')
                $('.js-disable-step').prop('checked', false);
                _sum = 0;
                setArrayValueToZero(_array_value);

            } else {
                if(__this.attr('value') == 1){
                    _array_value[_idx] = _score;
                }
                if(__this.attr('value') == 0){
                    _array_value[_idx] = 0;
                }

                var _sum_last_three_array = countSumArray([_array_value[8],_array_value[9],_array_value[10]])
                _sum = countSumArray(_array_value)
                $('.js-disable-step').removeAttr('disabled')

                if(_sum_last_three_array >= 10 && _sum <= 57){
                    _complexity = 'Moderate'
                } else {
                    _complexity = ''
                    if(_sum > 30 && _sum <= 57){
                        _complexity = 'Moderate'
                    }
                    if(_sum > 57 && _sum <= 100){
                        _complexity = 'High'
                    }
                    if(_sum <= 30 && _sum > 0){
                        _complexity = 'Low'
                    }
                }

            }

            $('.js-complexity-label').text(_complexity)
            $('.js-complexity-score-label').text(_sum)
            $('.js-complexity-label-val').val(_complexity)
            $('.js-complexity-score-label-val').val(_sum)

            setAssessmentLevelProject(_budget_value,_sum)
        })
    });

    function countSumArray(_array){
        return _array.reduce((partialSum, a) => partialSum + a, 0)
    }

    var _thirty_million = 30000000
    var _five_million = 5000000
    var _one_million = 1000000
    var _three_hundred_thousand = 300000


    var _matrix_level = [
        ['PDS','PDS','PDS'],
        ['COMPLEX','COMPLEX','COMPLEX'],
        ['MODERATE','MODERATE','COMPLEX'],
        ['LIGHT','MODERATE','MODERATE'],
        ['LIGHT','LIGHT','MODERATE']
    ]

    function setAssessmentLevelProject(_budget,_score){
       var _level_score = getIntervalScore(_score);
       var _level_capital_value = getIntervalCapital(_budget);
       if(_level_score === null || _level_capital_value === null){
           $('.js-complexity-score-label-assessment').text(0)
           $('.js-select-score').val('')
           $('.js-assessment-level-status-auto').text('Null')
       }
       if(_level_score !== null && _level_capital_value !== null){
           $('.js-cost-estimate-label-assessment').text(_budget)
           $('.js-complexity-score-label-assessment').text(_score)
           $('.js-assessment-level-status-auto').text(_matrix_level[_level_capital_value][_level_score])
           $('.js-select-score').val(_matrix_level[_level_capital_value][_level_score])
       }
    }

    function getIntervalScore(_val){
        if(_val > 3 && _val < 11) return 0;
        if(_val > 10 && _val < 17) return 1;
        if(_val > 17) return 2;
        return null;
    }

    function getIntervalCapital(_val){
        if(_val < _three_hundred_thousand && _val > 0) return 4;
        if(_val >= _three_hundred_thousand && _val <= _one_million) return 3;
        if(_val >= _one_million && _val <= _five_million) return 2;
        if(_val >= _five_million && _val <= _thirty_million) return 1;
        if(_val > _thirty_million) return 0;
        return null

    }

    /**
     * This block for set session laravel from js using ajax
     */
    $('.js-set-session').each(function () {
        var _this = $(this)
        _this.on('click', function (e) {
            e.preventDefault()
            var __this = $(this)
            var _tab = __this.data('url')
            var _action = __this.data('action')
            var _project_id = __this.data('id')
            __this.find('i').addClass('d-none')
            __this.find('.loader-box').removeClass('d-none')
            $.ajax({
                url: 'setSession',
                data: {
                    tab: _tab,
                    action: _action,
                    project_id: _project_id
                },
                success: function (data) {
                    window.location.href = data
                    setTimeout(function () {
                        __this.find('i').removeClass('d-none')
                        __this.find('.loader-box').addClass('d-none')
                    }, 3000)
                }
            })
        })
    })

    /**
     * Fel 1 Section
     */
    var _fel1_submit_form = $('.js-create-fel1')

    _fel1_submit_form.on('click', function (e) {
        e.preventDefault();
        tinyMCE.triggerSave();
        var _this = $(this)
        var _form = _this.closest('.js-fel1-form');
        var _project_scope = $('#checkbox-project_scope');
        var _identified_parameter = $('#checkbox-identified_parameter');
        var _alternative = $('#checkbox-alternatives');
        var _list_of_stakeholder = $('#checkbox-list_of_stakeholder')
        var _schedule_project = $('#checkbox-schedule');
        var _project_scope_text = $('.js-fel1-text-project-scope');
        var _identified_parameter_text = $('.js-text-identified_parameter_text');
        var _alternative_text = $('.js-text-alternatives_text');
        var _list_of_stakeholder_text = $('.js-text-list_of_stakeholder_text')
        var _schedule_project_text = $('.js-text-schedule_project_text');
        var _project_id = _form.find('.js-project-id').val();
        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        var _parameter_regulation = $('.js-fel1-attachment_parameter_regulation_requirement')[0].files;
        var _initial_process_diagram = $('.js-fel1-attachment_initial_progress_diagram')[0].files;
        var _data_of_alternatives = $('.js-fel1-attachment_data_of_alternatives')[0].files;
        var _initial_schedule = $('.js-fel1-attachment_initial_schedule')[0].files;
        var _project_level_assessment = $('.js-fel1-attachment_project_level_assessment')[0].files;
        var _stakeholder_list = $('.js-fel1-attachment_stakeholder_list')[0].files;

        _parameter_regulation = _parameter_regulation.length > 0 ? _parameter_regulation[0] : null

        var formData = new FormData();
        formData.append('file_category','FEL 1')
        formData.append('project_id',_project_id)
        formData.append('project_scope',setBooleanNumber(_project_scope.is(':checked')))
        formData.append('identified_parameter_requirement_regulation',setBooleanNumber(_identified_parameter.is(':checked')))
        formData.append('alternatives',setBooleanNumber(_alternative.is(':checked')))
        formData.append('list_of_stakeholder',setBooleanNumber(_list_of_stakeholder.is(':checked')))
        formData.append('schedule_project',setBooleanNumber(_schedule_project.is(':checked')))
        formData.append('project_scope_text',_project_scope_text.val())
        formData.append('identified_parameter_requirement_regulation_text',_identified_parameter_text.val())
        formData.append('alternatives_text',_alternative_text.val())
        formData.append('list_of_stakeholder_text',_list_of_stakeholder_text.val())
        formData.append('schedule_project_text',_schedule_project_text.val())
        formData.append('list_of_stakeholder_text',_status)
        formData.append('status',_list_of_stakeholder_text.val())
        formData.append('parameter_regulation',_parameter_regulation)
        formData.append('project_name',_form.data('name'))

        // return false
        if($('.js-fel1-form').valid()){
            _this.find('.loader-34').removeClass('d-none')
            _this.attr('disabled');
            $.ajax({
                url: _url,
                type: _type,
                processData: false,
                contentType: false,
                data: formData,
                success: function (data) {
                    window.location.href = data.url;
                }
            })
        }
    })


    $('.js-checkbox-fel1').each(function () {
        var _this = $(this)
        var _btn_submit_fel1 = $('.js-create-fel1');
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel1, false)
        })
    })

    $('.js-fel1-form').validate({
        ignore: [],
        focusInvalid: true,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_fel1_project_scope: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project_scope').is(':checked') &&
                            removeHtmlTag($('.js-fel1-text-project-scope').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel1_identified: {
                required: {
                    depends: function () {
                        if ($('#checkbox-identified_parameter').is(':checked') &&
                            removeHtmlTag($('.js-text-identified_parameter_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel1_alternatives: {
                required: {
                    depends: function () {
                        if ($('#checkbox-alternatives').is(':checked') &&
                            removeHtmlTag($('.js-text-alternatives_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel1_list_stakeholder: {
                required: {
                    depends: function () {
                        if ($('#checkbox-list_of_stakeholder').is(':checked') &&
                            removeHtmlTag($('.js-text-list_of_stakeholder_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel1_schedule: {
                required: {
                    depends: function () {
                        if ($('#checkbox-schedule').is(':checked') &&
                            removeHtmlTag($('.js-text-schedule_project_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
        },
        messages: {
            validate_fel1_project_scope: {
                required: "Since you check Project Scope Statement this field is required"
            },
            validate_fel1_identified: {
                required: "Since you check Identified Parameter, Requirement & Regulation this field is required"
            },
            validate_fel1_alternatives: {
                required: "Since you check Alternatives this field is required"
            },
            validate_fel1_list_stakeholder: {
                required: "Since you check List of Stakeholder this field is required"
            },
            validate_fel1_schedule: {
                required: "Since you check Schedule Project this field is required"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            }
        }
    })



    /**
     * Fel 2 Section
     */
    var _fel2_submit_form = $('.js-create-fel2')

    _fel2_submit_form.on('click', function (e) {
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
            url: _url,
            type: _type,
            data: {
                project_id: _project_id,
                project_scope: setBooleanNumber(_project_scope.is(':checked')),
                identify_main_equipment: setBooleanNumber(_identify_main_equipment.is(':checked')),
                boundary_and_assumption: setBooleanNumber(_boundary_assumption.is(':checked')),
                analysis_of_option: setBooleanNumber(_analysis_of_option.is(':checked')),
                permit_list: setBooleanNumber(_permit_list.is(':checked')),
                schedule_project: setBooleanNumber(_schedule_project.is(':checked')),
                cost_estimate: setBooleanNumber(_cost_estimate.is(':checked')),
                status: _status
            },
            success: function (data) {
                window.location.href = data.url;
            }
        })
    })


    $('.js-checkbox-fel2').each(function () {
        var _this = $(this)
        var _btn_submit_fel2 = $('.js-create-fel2');
        checkDisableButton(_this, _btn_submit_fel2, false, true, true)
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel2, false, false)
        })
    })

    /**
     * Fel 3 Section
     */
    var _fel3_submit_form = $('.js-create-fel3')

    _fel3_submit_form.on('click', function (e) {
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
            url: _url,
            type: _type,
            data: {
                project_id: _project_id,
                executive_summary: setBooleanNumber(_executive_summary.is(':checked')),
                problem_statement: setBooleanNumber(_problem_statement.is(':checked')),
                project_scope: setBooleanNumber(_project_scope.is(':checked')),
                alternatives_and_best_option: setBooleanNumber(_alternatives.is(':checked')),
                project_schedule: setBooleanNumber(_project_schedule.is(':checked')),
                list_of_equipment_and_specification: setBooleanNumber(_list_of_equipment.is(':checked')),
                hazop_study: setBooleanNumber(_hazop.is(':checked')),
                cost_estimate: setBooleanNumber(_cost_estimate.is(':checked')),
                status: _status
            },
            success: function (data) {
                window.location.href = data.url;
            }
        })
    })


    $('.js-checkbox-fel3').each(function () {
        var _this = $(this)
        var _btn_submit_fel3 = $('.js-create-fel3');
        checkDisableButton(_this, _btn_submit_fel3, false, true, true)
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_fel3, false, false)
        })
    })

    /**
     * Business Case Handle Here
     */
    $('.js-bc-risk-assessment-expand').on('click', function () {
        var _this = $(this);
        _this.siblings('ul').removeClass('d-none');
        _this.siblings('.js-bc-risk-assessment-hide').removeClass('d-none');
        _this.addClass('d-none');

    })

    $('.js-bc-risk-assessment-hide').on('click', function () {
        var _this = $(this);
        _this.siblings('ul').addClass('d-none');
        _this.siblings('.js-bc-risk-assessment-expand').removeClass('d-none');
        _this.addClass('d-none');

    })

    $('.js-checkbox-business_case').each(function () {
        var _this = $(this)
        var _btn_submit_bc = $('.js-create-bc');
        checkDisableButton(_this, _btn_submit_bc, false, true, true)
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_bc, false, false)
        })
    })

    var _bc_submit_form = $('.js-create-bc')

    _bc_submit_form.on('click', function (e) {
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
        var _npv = $('.js-npv_bc').val();
        var _payback_period = $('.js-payback_bc').val();
        var _irr = $('.js-irr_bc').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        _this.find('.loader-34').removeClass('d-none')
        _this.attr('disabled');

        $.ajax({
            url: _url,
            type: _type,
            data: {
                project_id: _project_id,
                problem_statement_and_objective: setBooleanNumber(_problem_and_objective.is(':checked')),
                project_alternatives: setBooleanNumber(_project_alternatives.is(':checked')),
                project_scope_of_work: setBooleanNumber(_scope_of_work.is(':checked')),
                major_equipment: setBooleanNumber(_major_equipment.is(':checked')),
                utility_requirements: setBooleanNumber(_utility_requirement.is(':checked')),
                permitting: setBooleanNumber(_permitting.is(':checked')),
                social_community_and_government: setBooleanNumber(_social_community.is(':checked')),
                financial_evaluation: setBooleanNumber(_financial_evaluation.is(':checked')),
                risk_assessment: setBooleanNumber(_risk_assessment.is(':checked')),
                additional_information: setBooleanNumber(_additional_information.is(':checked')),
                people: _risk_people,
                environment: _risk_environment,
                social_and_human_rights: _risk_human_rights,
                reputation: _risk_reputation,
                finance: _risk_finance,
                probability: _risk_probability,
                priority_level: !isNaN(parseInt(_risk_priority)) ? parseInt(_risk_priority) : '',
                status: _status,
                cost_estimate: _cost_estimate,
                npv: _npv ? parseInt(_npv) : 0,
                irr: _irr ? parseInt(_irr) : 0,
                payback_period: _payback_period ? parseInt(_payback_period) : 0
            },
            success: function (data) {
                if (data.status === 200) window.location.href = data.url;
                else notification('alert', data, '', '')
            }
        })
    })

    $('#checkbox-risk_assessment').on('change', function () {
        var _this = $(this);
        var _parent = _this.closest('td');
        var _risk_assessment_detail = _parent.find('.js-risk-assessment-bc')
        _parent.find('.loader-box').removeClass('d-none')
        if (_this.is(':checked')) {
            setTimeout(function () {
                _parent.find('.loader-box').addClass('d-none')
                _risk_assessment_detail.removeClass('d-none')
            }, 500)

        } else {
            _parent.find('.loader-box').addClass('d-none')
            _risk_assessment_detail.addClass('d-none')
        }
    });

    $('.js-risk-assessment-field').each(function () {
        var _this = $(this);
        _this.on('change', function () {
            var risk_level_values = [
                $('.js-risk-people').val(),
                $('.js-risk-finance').val(),
                $('.js-risk-environment').val(),
                $('.js-risk-reputation').val(),
                $('.js-risk-human-rights').val(),
            ]
            var _final_impact_score_value = Math.max.apply(Math, risk_level_values)
            $('.js-risk-assessment-bc').find('.u-rating-1to10').barrating('set', _final_impact_score_value);

            var _priority_level = setPriorityLevel(_final_impact_score_value, $('.js-risk-probability').val());
            $('.js-set-label-priority-level').text(_priority_level);
            setBackgroundPriority(_priority_level);
        })
    })


    var _existing_priority_element = $('.js-set-label-priority-level');
    if (_existing_priority_element.length > 0) {
        setBackgroundPriority(_existing_priority_element.text(), _existing_priority_element)
    }

    function setPriorityLevel(_final_impact_score, _probability) {

        var _risk_matrix = [
            [30, 27, 25, 23, 22],
            [29, 26, 24, 17, 16],
            [28, 20, 18, 10, 9],
            [21, 19, 11, 7, 4],
            [15, 13, 8, 5, 2],
            [14, 12, 6, 3, 1]
        ]

        return _risk_matrix[_final_impact_score - 1][_probability - 1] // min 1 because index array is start from 0
    }

    function setBackgroundPriority(_value, element) {
        var _background = 'white';
        if (element) {
            _value = parseInt(element.text());
        }

        if (_value > 0 && _value < 9) {
            _background = 'red';
        }
        if (_value > 8 && _value < 16) {
            _background = 'orange';
        }
        if (_value > 15 && _value < 22) {
            _background = 'yellow';
        }
        if (_value > 21 && _value < 31) {
            _background = 'green';
        }

        $('.js-set-label-priority-level').css('background-color', _background);
    }

    $('#checkbox-same-cost-estimate').on('change', function () {
        var _this = $(this);
        var _input = _this.closest('td').find('.js-cost_estimate_bc');
        if (_this.is(':checked')) {
            _input.val(_input.data('default'))
        } else {
            _input.val(0)
        }
    })
    var _check_finance_ev = $('#checkbox-financial_evaluation');
    _check_finance_ev.on('click', function () {
        financialDetail($(this))
    })
    financialDetail(_check_finance_ev)

    function financialDetail(_element) {
        var _this = _element;
        if (_this.is(':checked')) {
            $('.js-financial_evaluation_detail').removeClass('d-none');
        } else {
            $('.js-financial_evaluation_detail').addClass('d-none');
        }
    }

    /**
     * Cost Benefit
     * @type {number}
     * @private
     */
    var _table_no = 1;
    $(document).on('click', '.js-add-new-cost-benefit', function () {
        // $('.js-add-new-cost-benefit').on('click',function (){
        var template = $('#js-template-cost-benefit').html();
        Mustache.parse(template);
        var data = {
            "no": _table_no += 1
        }
        var _temp = Mustache.render(template, data)
        $('.js-table-cost-benefit').find('.js-table-body-cost-benefit').append(_temp)
    })

    $('.select2-temp').each(function () {
        var _this = $(this)
        _this.select2();
    })

    $('.js-create-cb').on('click', function (e) {
        $(this).find('.loader-34').removeClass('d-none')
        e.preventDefault();
        var _form = $('.js-cb-form');
        _form.submit()
    })

    $(document).on('keyup', '.js-cost-benefit', function () {
        var _parent = $(this).closest('tr')
        var _initial_and_sustaining = _parent.find('.js-initial-and-sustaining')
        var _js_additional_revenue = _parent.find('.js-additional-revenue')
        var _js_increment_operating = _parent.find('.js-increment-operating-cost')
        var _js_cost_saving = _parent.find('.js-cost-savings')

        var _js_cost_saving_val = _js_cost_saving.val() ? parseInt(_js_cost_saving.val()) : 0
        var _js_increment_operating_val = _js_increment_operating.val() ? parseInt(_js_increment_operating.val()) : 0
        var _js_additional_revenue_val = _js_additional_revenue.val() ? parseInt(_js_additional_revenue.val()) : 0

        var _total = _js_cost_saving_val + _js_increment_operating_val + _js_additional_revenue_val
        _parent.find('.js-net-incremental-benefits').val(_total)
    })

    /**
     * JS Checkbox Capex Investment
     */
    var _project_form = $('.js-project-form')
    var _check_capex_investment = 0
    $('.js-checkbox-open-bucket').each(function(){
        var _this = $(this);
        var _btn_next = _this.closest('.card').find('.js-next-capex-investment-form')
        _this.on('change',function(){
            var __this = $(this)
            validate_capex_investment($(this))
            if(_check_capex_investment >= 1) disabledCheckbox(__this.data('id'))
        })
    })

    var _idx = 0;
    function validate_capex_investment(_this){
        var __this = _this;
        var __sub_bucket_list = __this.closest('.js-basket-list-detail').find('.js-sub-basket-list');

        if(__this.is(':checked')){
            _idx = __this.data('idx');
            __sub_bucket_list.removeClass('d-none');

            if(__sub_bucket_list.length < 1) {
                _check_capex_investment += 2;
            }
            if(__sub_bucket_list.length > 0){
                _check_capex_investment += 1;
            }

            $('.js-hidden-basket').val(__this.data('id'))

        } else {
            $('.js-checkbox-sub-basket').prop('checked', false);
            $('.js-checkbox-sub-basket').removeAttr('disabled');
            _check_capex_investment = 0;

            $('.js-checkbox-sub-basket').removeAttr('checked');
            $('.js-hidden-basket').val('');
            __sub_bucket_list.addClass('d-none');
        }

        if(_check_capex_investment > 1){
            _this.closest('.card').find('.js-next-capex-investment-form').removeAttr('disabled')
        } else {
            $('.js-checkbox-open-bucket').removeAttr('disabled')
            _this.closest('.card').find('.js-next-capex-investment-form').attr('disabled','disabled')
        }
    }

    $('.js-checkbox-sub-basket').on('change',function(){
        var _this = $(this)
        if(_this.is(':checked')){
            _check_capex_investment += 1;
        }else {
            if(_check_capex_investment > 0) _check_capex_investment = 0
        }

        if(_check_capex_investment > 0){
            var _data_id = _this.closest('.js-basket-list-detail').find('.js-checkbox-open-bucket').data('id')
            disabledCheckbox(_data_id)
            disabledSubBasket(_this.data('id'))
            _this.closest('.card').find('.js-next-capex-investment-form').removeAttr('disabled')
        } else {
            $('.js-checkbox-sub-basket').removeAttr('disabled')
            $('.js-hidden-sub-basket').val('')
            _this.closest('.card').find('.js-next-capex-investment-form').attr('disabled','disabled')
        }
    })

    function disabledCheckbox(_id){
        $('.js-checkbox-open-bucket').each(function(){
            if($(this).data('id') != _id){
                $(this).attr('disabled','disabled')
            }
        })
    }

    function disabledSubBasket(_id){
        $('.js-checkbox-sub-basket').each(function(){
            if($(this).data('id') != _id){
                $(this).attr('disabled','disabled')
            }
            if($(this).data('id') == _id) $('.js-hidden-sub-basket').val($(this).data('id'))
        })
    }

    $('.js-next-capex-investment-form').on('click',function(e){
        e.preventDefault();
        $('.js-capex-investment-form').addClass('d-none');
        $('.js-project-form-card').removeClass('d-none');
        window.scrollTo(0,0)
    });

    $('.js-back-capex-investment-form').on('click',function(e){
        e.preventDefault();
        $('.js-project-form-card').addClass('d-none');
        $('.js-capex-investment-form').removeClass('d-none');
        window.scrollTo(0,0)
    });

    /**
     * Handle Project Form
     */

    _project_form.validate({
        rules:{
            checkbox_basket:{
                required: true
            },
            checkbox_sub_basket: {
                required : {
                    depends:function (element){
                        var _this = null
                        if($(this).data('idx') == 0){
                            _this = $(this)
                        }
                        if(_this) return _this.closest('.js-basket-list-detail').find('.js-checkbox-open-bucket').is(':checked');
                    }
                }
            }
        },
        messages:{
            checkbox_sub_basket:{
                required:"Sub Basket is Required"
            }
        },
        errorPlacement:function(error, element){
            if(element.hasClass('js-checkbox-sub-basket')){
                element.closest('.js-sub-basket-list').siblings('.js-sub-basket-error').append(error)
            }
        }
    })
})


