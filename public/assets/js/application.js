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

    /**
     * Handle for open notifications
     */
    $('.js-notification-box').on('click',function(){
        var _this = $(this)
        var _dropdown_notification =  _this.siblings('.notification-dropdown')
        if(_dropdown_notification.hasClass('d-none')){
            _dropdown_notification.removeClass('d-none')
            _this.closest('.onhover-dropdown-custom').css('padding','9px')
            _this.closest('.onhover-dropdown-custom').css('background-color','#e9f0ee')
        } else {
            _dropdown_notification.addClass('d-none')
            _this.closest('.onhover-dropdown-custom').css('padding','9px')
            _this.closest('.onhover-dropdown-custom').css('background-color','white')
        }
    })

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
            url: '/getProjectNote/' + _id,
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
                    notification('', 'Project Successfully Deleted', 'fa fa-cross')
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
                url: '/getSubDepartment',
                data: function (params) {
                    var owner = _this.closest('.js-project-form').find('.js-select-owner').val();
                    return {
                        owner: owner,
                        q: params.term
                    }
                },
                processResults: function (resp) {
                    return {
                        results: resp
                    }
                },
            }
        })

        _this.on('change', function() {
            var selectedData = _this.select2('data')[0];

            if (selectedData && selectedData.data && selectedData.data.owner) {
                var owner = selectedData.data.owner;
                var sponsor = selectedData.data.sponsor;
                $('.js-project-owner').val(sponsor); // Update form text input value with the owner data
                $('.js-project-sponsor').val(owner); // Update form text input value with the owner data
            } else{
                var $selectedOption = _this.find(':selected');

                var selectedValue = $selectedOption.val(); // Get the value attribute of the selected option
                var selectedText = $selectedOption.text(); // Get the text of the selected option
                var sponsor = $selectedOption.data('sponsor'); // Get custom data attribute value
                var owner = $selectedOption.data('owner'); // Get custom data attribute value
                $('.js-project-owner').val(owner); // Update form text input value with the owner data
                $('.js-project-sponsor').val(sponsor); // Update form text input value with the owner data
            }
        });
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
            var _status = _notif.data('status')
            var _template = _notif.data('template') === 'danger' ? 'danger' : ''
            notification(_template, _message, '',_status)
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
        $('.js-upload-attachment').val('')
        $('.js-error-attachment_extension').text('')
        $('.js-error-file_size').text('')
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
        plugins: 'table image fullscreen lists',
        toolbar: 'fullscreen | undo redo | fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
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
            checkDisableButton(__this,_btn_submit_assessment,_check_count, false)
        })
    })


    function checkDisableButton(__this, _btn_submit_assessment, countCheck, _checkAll) {
        var validCount = countCheck
        var _editor = __this.closest('tr').find('.tinymce')
        if (__this.is(':checked')) {
            if (_editor.length > 0) tinymce.get(_editor.attr('id')).show()
            if (_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) {
                __this.closest('tr').find('.js-cost-estimate').removeClass('d-none');
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-analysis-head').length > 0) {
                __this.closest('tr').find('.js-complexity-analysis-head').removeClass('d-none')
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-assessment-head').length > 0) {
                __this.closest('tr').find('.js-complexity-assessment-head').removeClass('d-none')
            }
        } else {
            if (_editor.length < 1 && __this.closest('tr').find('.js-cost-estimate').length > 0) {
                __this.closest('tr').find('.js-cost-estimate').addClass('d-none');
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-analysis-head').length > 0) {
                __this.closest('tr').find('.js-complexity-analysis-head').addClass('d-none')
            }
            if (_editor.length < 1 && __this.closest('tr').find('.js-complexity-assessment-head').length > 0) {
                __this.closest('tr').find('.js-complexity-assessment-head').addClass('d-none')
            }
            _editor.addClass('d-none');
            if (_editor.length > 0) {
                tinymce.get(_editor.attr('id')).hide()
            }
        }
    }

    /**
     * Upload Attachment Validation
     */
    var DOCUMENT_EXTENSION = ['docx','doc','pdf','xlsx','xls','csv','xlx','ppt','pptx','xlsm'];
    var ZIP_EXTENSION = ['zip','rar'];

    var _check_count = 0;
    $(document).on('change', '.js-upload-attachment', function () {
        var _this = $(this);
        var _extension = _this.val().substr((_this.val().lastIndexOf('.') + 1));
        var _size = _this[0].files[0].size;
        var _listExtension = DOCUMENT_EXTENSION;

        var _mandatory_attachment = $(this).closest('table').find('.js-attachment-mandatory').length;
        if (_this.hasClass('js-upload-zip')) {
            _listExtension = ZIP_EXTENSION.concat(DOCUMENT_EXTENSION);
        }

        var _mandatory_attachment_valid = $(this).closest('table').find('.js-attachment-mandatory').filter(function (){
            return $(this).val() != ''
        }).length

        var _validate_size = true
        var _validate_extension = true

        if (_this[0].files[0]) {
            if (_size > 40000000) {
                _this.closest('.row').find('.js-error-file_size').text('Error : File size cannot be more than 40 MB ')
                _validate_size = false;
            } else {
                _this.closest('.row').find('.js-error-file_size').text('');
            }

            if (_listExtension.indexOf(_extension) < 0) {
                _this.closest('.row').find('.js-error-attachment_extension').text('Error: File extension not allowed ')
                _validate_extension = false;
            } else {
                _this.closest('.row').find('.js-error-attachment_extension').text('');
            }
        }

        _this.attr('data-validate', _validate_extension && _validate_size)

        var _error_validate = _this.closest('table').find('.js-upload-attachment').filter(function(){
            return $(this).attr('data-validate') == 'false'
        }).length

        //for update
        var _existing_attachment = _this.closest('table').find('.js-upload-attachment').filter(function(){
            return $(this).attr('data-validated') == 'true'
        }).length

        _mandatory_attachment_valid = _mandatory_attachment_valid + _existing_attachment

        if ((_mandatory_attachment_valid >= _mandatory_attachment && (_error_validate < 1))) {
            // Enable save button and hide error message if mandatory count is met
            _this.closest('form').find('.js-save-button').removeAttr('disabled', 'disabled');
            _this.closest('form').find('.js-error-attachment').addClass('d-none');
        } else {
            // Disable save button and show error message if mandatory count is not met
            _this.closest('form').find('.js-save-button').attr('disabled', 'disabled');
            _this.closest('form').find('.js-error-attachment').removeClass('d-none');
        }

    });

    function validatedCount(_this){
        var _mandatory_attachment = _this.closest('.js-row-header-tab').siblings('.js-form-project-edit').find('.js-attachment-mandatory').length;

        var _mandatory_attachment_valid = _this.closest('.js-row-header-tab').siblings('.js-form-project-edit').find('.js-attachment-existing-assessment').filter(function (){
            return $(this).text() != ''
        }).length

        if(_mandatory_attachment_valid >= _mandatory_attachment){
            $('.js-save-button').removeAttr('disabled', 'disabled');
            $('.js-error-attachment').addClass('d-none');
        } else {
            // Disable save button and show error message if mandatory count is not met
            $('.js-save-button').attr('disabled', 'disabled');
            $('.js-error-attachment').removeClass('d-none');
        }
    }


    /**
     * Save Assessment Using AJAX
     */

    $('.js-currency-format').each(function(){
        var _val = currencyFormat($(this).val())
        $(this).val(_val);
    })

    $('.js-currency-format-text').each(function(){
        var _convert = $(this).text().replace('.',',')
        var _val = currencyFormat(_convert)
        $(this).text(_val);
    })

    var _assessment_form = $('.js-assessment-form')

    $(document).on('click', '.js-create-assessment', function (e) {
        e.preventDefault();
        tinyMCE.triggerSave();
        var _this = $(this);
        var _form = _this.closest('.js-assessment-form');
        var _check_problem_statement = $('#checkbox-problem-statement')
        var _check_objective = $('#checkbox-objective')
        var _check_project_scope = $('#checkbox-project-scope')
        var _check_key_performance = $('#checkbox-key-performance-metric')
        var _check_project_risk = $('#checkbox-prm')
        var _check_impact_not_executed = $('#checkbox-impact-if-not-executed')
        var _check_alternative = $('#checkbox-alternative')
        var _check_cost_estimate = $('#checkbox-cost-estimate')
        var _check_level = $('#checkbox-level')
        var _check_detail_cost = $('#checkbox-detail-estimate')
        var _check_project_complexity_assessment = $('#checkbox-complexity-assessment')
        var _check_executive_summary = $('.js-executive-summary');
        var _check_project_schedule = $('.js-project-schedule');
        var _check_economic_evaluation = $('.js-check-economic-evaluation');
        var _check_hazop_study = $('.js-checkbox-hazop-study');
        var _check_list_equipment_specification = $('.js-checkbox-list-equipment-specification');

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
        var _complexity_score_analysis = $('.js-complexity-analyzis-score-label-val').val();
        var _complexity_analysis_type = $('.js-complexity-label-val').val();

        var _new_text_level_project = $('.js-complexity-label-val').val();
        var _complexity_score_assessment = $('.js-hidden-project-level-assessment-score').val();

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

        var _complexity_assessment_technology = $('.js-complexity-assessment-technology').val()
        var _complexity_assessment_engineering = $('.js-complexity-assessment-engineering').val()
        var _complexity_assessment_owner_business = $('.js-complexity-assessment-owner_business').val()
        var _complexity_assessment_external_approval = $('.js-complexity-assessment-external-approval').val()

        var _list_equipment_specification_text = $('.js-text-list-equipment-specification').val();
        var _executive_summary_text = $('.js-text-executive-summary').val();
        var _hazop_study_text = $('.js-text-hazop-study').val();
        var _project_schedule_text = $('.js-text-project-schedule').val();
        var _economic_evaluation_text = $('.js-text-economic-evaluation').val();

        _this.attr('disabled', 'disabled')
        _this.find('.loader-34').removeClass('d-none')

        var _location_of_asset_capitalization = [];
        $.each($('.js-row-area-capitalization').find('tr'), function(){
            var _this = $(this);
            var _area = _this.find('.js-form-area').val();
            var _cost_center = _this.find('.js-form-cost-center').val()
            var _data = {
                'area' : _area,
                'cost_center' : _cost_center
            }
            if(_area != '' && _cost_center != '') _location_of_asset_capitalization.push(_data);
        })

        var _kpi_indicator_kpm_text = [];
        if(_check_key_performance.is(':checked')){
            $.each($('.js-table-body-kpm-kpi').find('.js-row-kpi'), function (){
                var _this = $(this);
                var _data = {
                    'description' : _this.find('.js-kpi-description').val(),
                    'uom' : _this.find('.js-kpi-uom').val(),
                    'time_benefit' : _this.find('.js-kpi-time-benefit').val(),
                    'remarks': _this.find('.js-kpi-remarks').val()
                }

                _kpi_indicator_kpm_text.push(_data);
            })
        }

        if(_location_of_asset_capitalization != '') _location_of_asset_capitalization = JSON.stringify(_location_of_asset_capitalization);
        _kpi_indicator_kpm_text = JSON.stringify(_kpi_indicator_kpm_text);

        var files = $('.js-assessment-attachment_initial_cost_estimate')[0].files;
        var files_complexity = $('.js-assessment-attachment_complexity_matrix')[0].files;
        var files_preliminary_design = $('.js-assessment-attachment_preliminary_design')[0].files;
        var files_utility_infrastructure_facilities = $('.js-assessment-attachment_utility_infrastructure_facilities_diagram')[0].files;
        var files_hazop_study = $('.js-assessment-attachment_hazop_study')[0].files;
        var files_moc_document = $('.js-assessment-attachment_moc_document')[0].files;
        var files_cost_estimate_with_rough = $('.js-assessment-attachment_cost_estimate_with_rough_of_magnitude')[0].files;
        var files_quotation_of_equipment = $('.js-assessment-attachment_quotation_of_equipment')[0].files;
        var files_project_assessment_level = $('.js-assessment-attachment_project_assessment_level')[0].files;
        var files_fel1 = $('.js-assessment-attachment_fel1')[0].files;
        var files_fel2 = $('.js-assessment-attachment_fel2')[0].files;

        var sub_basket = null;
        $('.js-checkbox-sub-basket').each(function(){
           if($(this).is(':checked')){
               sub_basket = $(this).data('id');
           }
        });

        var formData = new FormData();
        if(files.length > 0) formData.append('document_initial_cost_estimate', files[0])
        if(files_complexity.length > 0) formData.append('document_complexity_matrix', files_complexity[0])
        if(files_preliminary_design.length > 0) formData.append('preliminary_design', files_preliminary_design[0])
        if(files_utility_infrastructure_facilities.length > 0) formData.append('utility_infrastructure_facilities_diagram', files_utility_infrastructure_facilities[0])
        if(files_hazop_study.length > 0) formData.append('document_hazop_study', files_hazop_study[0])
        if(files_moc_document.length > 0) formData.append('moc_document', files_moc_document[0])
        if(files_cost_estimate_with_rough.length > 0) formData.append('cost_estimate_with_rough_of_magnitude', files_cost_estimate_with_rough[0])
        if(files_quotation_of_equipment.length > 0) formData.append('quotation_of_equipment', files_quotation_of_equipment[0])
        if(files_project_assessment_level.length > 0) formData.append('project_assessment_level', files_project_assessment_level[0])
        if(files_fel1.length > 0) formData.append('fel1', files_fel1[0])
        if(files_fel2.length > 0) formData.append('fel2', files_fel2[0])


        formData.append('project_name', _form.data('name'))
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        formData.append('file_category', 'Project Level Assessment')
        formData.append('project_id', _project_id)
        formData.append('executive_summary', setBooleanNumber(_check_executive_summary.is(':checked')))
        formData.append('project_schedule', setBooleanNumber(_check_project_schedule.is(':checked')))
        formData.append('hazop_study', setBooleanNumber(_check_hazop_study.is(':checked')))
        formData.append('economic_evaluation', setBooleanNumber(_check_economic_evaluation.is(':checked')))
        formData.append('list_equipment_specification', setBooleanNumber(_check_list_equipment_specification.is(':checked')))
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
        formData.append('complexity_assessment_checkbox', setBooleanNumber(_check_project_complexity_assessment.is(':checked')))
        formData.append('problem_statement_text', _text_problem_statement)
        formData.append('objective_text', _text_objective)
        formData.append('project_scope_text', _text_project_scope)
        formData.append('key_performance_metric_text', _kpi_indicator_kpm_text)
        formData.append('key_project_risk_mitigants_text', _text_project_risk)
        formData.append('impact_if_not_executed_text', _text_impact)
        formData.append('alternatives_to_proposal_text', _text_alternative)
        formData.append('cost_estimate_text', _text_cost_estimate)
        formData.append('level_project_text', _text_complexity_level)
        formData.append('detail_estimate_cost_text', _text_detail_estimate)
        formData.append('complexity_score_assessment', _complexity_score_assessment)
        formData.append('complexity_analyzis_score', _complexity_score_analysis)
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
        // formData.append('score',_complexity_sore ?? '');
        formData.append('complexity_analysis_type',_complexity_analysis_type ?? '')
        formData.append('complexity_assessment_technology',_complexity_assessment_technology ?? '')
        formData.append('complexity_assessment_engineering',_complexity_assessment_engineering ?? '')
        formData.append('complexity_assessment_owner_business',_complexity_assessment_owner_business ?? '')
        formData.append('complexity_assessment_external_approval',_complexity_assessment_external_approval ?? '')
        formData.append('location_of_asset_capitalization', _location_of_asset_capitalization)
        formData.append('list_equipment_specification_text', _list_equipment_specification_text)
        formData.append('executive_summary_text', _executive_summary_text)
        formData.append('hazop_study_text', _hazop_study_text)
        formData.append('project_schedule_text', _project_schedule_text)
        formData.append('economic_evaluation_text', _economic_evaluation_text)

        if(_form.valid()){
            $.ajax({
                url: _url_submit,
                type: _type,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status === 200) window.location.href = data.url;
                    else {
                        notification('danger', data, 'fa fa-time', data.message)
                        _this.removeAttr('disabled')
                        _this.find('.loader-34').addClass('d-none')
                    }
                }
            })
        } else {
            _this.removeAttr('disabled')
            _this.find('.loader-34').addClass('d-none')
        }
    })

    function setBooleanNumber(val) {
        if (val === true) return 1;
        return 0;
    }

    /**
     * Handle Change Complexity Analysis Assessment
     */
    function updateComplexityAnalysisConfirmation(_value){
        var _score_val = $('.js-complexity-analyzis-score-label-val').val();
        var _complexity_type = $('.js-complexity-label-val');
        var _existing_complexity = _complexity_type.attr('data-existing-type');
        var _existing_fel3 = _complexity_type.attr('data-is-ma-exist');
        var _new_complexity = _complexity_type.val();
        var _form_assessment = $('.js-assessment-form');
        var _button_submit = _form_assessment.find('.js-create-assessment');

        if(_existing_complexity.length > 0 &&
            _existing_fel3.length > 0 &&
            _existing_complexity != _value){
            _button_submit.attr('data-bs-toggle','modal')
            _button_submit.attr('data-original-title','test')
            _button_submit.attr('data-bs-target','#exampleModal')
            $('.js-btn-submit-assessment-non-confirm').removeClass('js-create-assessment')
            $('.js-btn-submit-assessment-confirm').addClass('js-create-assessment')
        } else {
            _button_submit.removeAttr('data-bs-toggle','modal')
            _button_submit.removeAttr('data-original-title','test')
            _button_submit.removeAttr('data-bs-target','#exampleModal')
            $('.js-btn-submit-assessment-confirm').removeClass('js-create-assessment')
            $('.js-btn-submit-assessment-non-confirm').addClass('js-create-assessment')
        }
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
            validate_check_empty_count:{
                required: {
                    depends:function(){
                        var _count = 0;
                        $('.js-checkbox-assessment').each(function(){
                            if($(this).is(':checked')){
                                _count += 1;
                            }
                        })
                        return _count < 1;
                    }
                }
            }
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
            validate_check_empty_count: {
                required: "Please fill the checkbox form"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            } else if(element.hasClass('js-validate-checkbox-count')){
                element.closest('.js-assessment-form').find('.error-msg-checkbox').append(error)
            } else {
                error.insertAfter(element)
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
            $('.js-complexity-score-label-assessment').text(_score)
            $('.js-select-score').val('')
            $('.js-assessment-level-status-auto').text('Null')
        }
        if(_level_score !== null && _level_capital_value !== null){
            var _currency_budget = currencyFormat(_budget)
            $('.js-cost-estimate-label-assessment').text(_currency_budget)
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
        var _thirty_million = 30000000
        var _five_million = 5000000
        var _one_million = 1000000
        var _three_hundred_thousand = 300000

        if(_val < _three_hundred_thousand && _val > 0) return 4;
        if(_val >= _three_hundred_thousand && _val <= _one_million) return 3;
        if(_val >= _one_million && _val <= _five_million) return 2;
        if(_val >= _five_million && _val <= _thirty_million) return 1;
        if(_val > _thirty_million) return 0;

        return null

    }

    $('.js-cost_estimate_assessment').on('change keyup',function (){
        var _this = $(this)
        var _val = _this.val()
        var _default_val = removeFormatCurrency(_val)
        setAssessmentLevelProject(_default_val,$('.js-hidden-project-level-assessment-score').val())
    })

    function removeFormatCurrency(_val){
        _val = _val.toString()
        var _split = _val.split('.')
        var _join =  _split.join('');
        var _split_comma = _join.split(',')
        return  _split_comma[0]
    }

    var _complexity_analysis_score = 0;
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
                _complexity_analysis_score = 0;
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
            updateComplexityAnalysisConfirmation(_complexity);
            $('.js-complexity-label').text(_complexity)
            $('.js-complexity-score-label').text(_sum)
            $('.js-complexity-label-val').val(_complexity)
            $('.js-complexity-analyzis-score-label-val').val(_sum)
        })
    });

    function countSumArray(_array){
        return _array.reduce((partialSum, a) => partialSum + a, 0)
    }

    /**
     * Handle Project Assessment Score
     * @type {number}
     * @private
     */

    var _complexity_score = [0,0,0,0]
    $('.js-complexity-assessment-score').each(function(){
        setAssessmentScore($(this),false)
        $(this).on('change',function(){
            setAssessmentScore($(this),true)
        });
    })

    function setAssessmentScore(_this,_setAssessment){
        var _idx = _this.data('idx')
        var _val = _this.val() ? _this.val() : 0
        var _budget_value = _this.closest('.js-table-assessment').find('.js-cost_estimate_assessment').val()
        _complexity_score[_idx] = parseInt(_val)
        var _score = _complexity_score.reduce((a, b) => a + b)
        $('.js-label-project-complexity-score').text(_score)
        $('.js-hidden-project-level-assessment-score').val(_score)
        var _default_budget = _budget_value
        if(_budget_value) _default_budget = removeFormatCurrency(_budget_value)
        if(_setAssessment) setAssessmentLevelProject(_default_budget,_score)
        setMessageMandatoryAssessment(_score)
    }

    function setMessageMandatoryAssessment(_score){
        var _mandatory_message = "<span class='text-warning'> Complexity Score : " + _score + " . Mandatory Action Required: Submit Form "
        if(_score >= 4 && _score <= 10){
            _mandatory_message = _mandatory_message + "FEL 3</span>";
        } else if (_score >= 11 && _score <= 16){
            _mandatory_message = _mandatory_message + "FEL 2</span>";
        } else if (_score >= 17 ) {
            _mandatory_message = _mandatory_message + "FEL 1 & FEL 2</span>";
        } else {
            _mandatory_message = "";
        }

        $('.js-assessment-message-mandatory-form-fels').html(_mandatory_message)
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

    $(document).on('click', '.js-checkbox-investment-strategy', function(){
        var _this = $(this);
        var _not_checked_checkbox =  $('.js-checkbox-investment-strategy').not(this)
        var _not_checked_element = $('.js-level-1').not(_this.closest('.js-level-1'))
        if(_this.is(':checked')){
            _not_checked_checkbox.attr('disabled','disabled')
            _this.closest('.js-level-1').find('.js-level-2').removeClass('d-none')

        } else {
            _not_checked_checkbox.removeAttr('disabled')
            _this.closest('.js-level-1').find('.js-level-2').addClass('d-none')
            $('.js-next-assessment-form').attr('disabled','disabled')
            $('.js-checkbox-investment-strategy-level-2').removeAttr('disabled')
            $('.js-checkbox-investment-strategy-level-2').prop('checked',false)
            $('.js-level-2').addClass('d-none')
            $('.js-level-3').addClass('d-none')
            $('.js-checkbox-investment-strategy-level-3').removeAttr('disabled')
            $('.js-checkbox-investment-strategy-level-3').prop('checked',false)
        }
        $('.js-next-assessment-form').removeClass('d-none')
        $('.js-button-submit-assessment').addClass('d-none');
    })

    $(document).on('click','.js-checkbox-investment-strategy-level-2',function(){
        var _this = $(this);
        var _not_checked_element = $('.js-level-2').not(_this.closest('.js-level-2'))
        var _not_checked_checkbox =  $('.js-checkbox-investment-strategy-level-2').not(this)
        if(_this.is(':checked')){
            _not_checked_checkbox.attr('disabled','disabled')
            _this.closest('.js-level-2').find('.js-level-3').removeClass('d-none');
        } else {
            _not_checked_checkbox.removeAttr('disabled')
            _this.closest('.js-level-2').find('.js-level-3').addClass('d-none');
            $('.js-next-assessment-form').attr('disabled','disabled')
            $('.js-checkbox-investment-strategy-level-3').removeAttr('disabled')
            $('.js-checkbox-investment-strategy-level-3').prop('checked',false)
            $('.js-level-3').addClass('d-none')
        }
        $('.js-next-assessment-form').removeClass('d-none')
        $('.js-button-submit-assessment').addClass('d-none');
    });

    $(document).on('click','.js-checkbox-investment-strategy-level-3',function(){
        var _this = $(this);
        var _not_checked_checkbox =  $('.js-checkbox-investment-strategy-level-3').not(this)
        if(_this.is(':checked')){
            _not_checked_checkbox.attr('disabled','disabled')
            $('.js-next-assessment-form').removeAttr('disabled')
        } else {
            _not_checked_checkbox.removeAttr('disabled')
            $('.js-next-assessment-form').attr('disabled','disabled')
        }
        $('.js-next-assessment-form').removeClass('d-none')
        $('.js-button-submit-assessment').addClass('d-none');
    });

    $(document).on('click','.js-next-assessment-form', function(e){
        var _this = $(this);
        const path = window.location.pathname;

        _this.attr('disabled','disabled');
        _this.find('.loader-34-custom').removeClass('d-none');

        // Extract the last segment of the path (assuming the ID is the last part of the URL)
        const segments = path.split('/');
        const id = segments[segments.length - 1];

        var _data = {
            'project_id' : id,
            'level1' : $('.js-checkbox-investment-strategy:checked').val(),
            'level2' : $('.js-checkbox-investment-strategy-level-2:checked').val(),
            'level3' : $('.js-checkbox-investment-strategy-level-3:checked').val(),
        };

        $.ajax({
            url : '/update-investment-strategy',
            data : _data,
            type: 'POST',
            success:function(result){
                if(result.status === 200){
                    $('.js-table-form-assessment').removeClass('d-none');
                    _this.addClass('d-none')
                    _this.removeAttr('disabled')
                    _this.find('.loader-34-custom').addClass('d-none');
                    $('.js-button-submit-assessment').removeClass('d-none');
                } else {
                    console.log(result.message)
                }
            }
        });
    })

    $(document).on('click','.js-add-location-area-capitalization', function(){
        var _temp = ' <tr><td>\n' +
            '              <input type="text" class="form-control js-form-area">\n' +
            '         </td>\n' +
            '         <td>\n' +
            '              <input type="text" class="form-control js-form-cost-center">\n' +
            '         </td>\n' +
            '         <td>\n' +
            '              <i class="fa fa-plus-circle cursor-pointer js-add-location-area-capitalization"></i>\n' +
            '              <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-location-area-capitalization"></i>\n' +
            '         </td></tr>'
        $('.js-row-area-capitalization').append(_temp)
    })

    $(document).on('click','.js-delete-location-area-capitalization', function(){
        var _area_form = $('.js-add-location-area-capitalization');
        var _this = $(this);
        if(_area_form.length > 1){
            _this.closest('tr').remove();
        }
    })

    $(document).on('click','.js-checkbox-key-performance-metric', function (){
        var _this = $(this);
        if(_this.is(':checked')){
            $('.js-table-kpm-kpi').removeClass('d-none')
            if($('.js-table-kpm-kpi').find('.js-table-body-kpm-kpi tr').length < 1){
                renderRowKpi(1);
            }
        } else {
            $('.js-table-kpm-kpi').addClass('d-none');
            $('.js-table-kpm-kpi').find('tbody tr').remove();
        }
    })

    $(document).on('click','.js-add-kpm-kpi', function(){
        var _num = $('.js-table-body-kpm-kpi').find('tr').length + 1;
       renderRowKpi(_num);
    });

    $(document).on('click','.js-delete-kpm-kpi', function(){
        if($('.js-table-body-kpm-kpi').find('tr').length > 1){
            $(this).closest('tr').remove();
        }
    });

    function renderRowKpi(_num){
        var _temp = '<tr class="js-row-kpi">\n' +
            '            <td>' + _num + '</td>\n' +
            '            <td><input type="text" class="form-control js-kpi-description"></td>\n' +
            '            <td><input type="text" class="form-control js-kpi-uom"></td>\n' +
            '            <td><input type="text" class="form-control js-kpi-time-benefit"></td>\n' +
            '            <td><input type="text" class="form-control js-kpi-remarks"></td>\n' +
            '            <td>\n' +
            '               <i class="fa fa-plus-circle cursor-pointer js-add-kpm-kpi"></i>\n' +
            '               <i class="fa fa-times-circle m-l-2 text-danger cursor-pointer js-delete-kpm-kpi"></i>\n' +
            '            </td>\n' +
            '         </tr>'
        $('.js-table-body-kpm-kpi').append(_temp)
    }

    /**
     * Fel 1 Section
     */
    var _fel1_submit_form = $('.js-create-fel1')

    _fel1_submit_form.on('click', function (e) {
        e.preventDefault();
        var _this = $(this)
        _this.attr('disabled', 'disabled')
        _this.find('.loader-34').removeClass('d-none')
        tinyMCE.triggerSave();

        var _form = _this.closest('.js-fel1-form');
        var _project_scope = $('#checkbox-project-scope-fel1');
        var _identified_parameter = $('#checkbox-identified_parameter');
        var _alternative = $('#checkbox-alternatives');
        var _list_of_stakeholder = $('#checkbox-list_of_stakeholder')
        var _schedule_project = $('#checkbox-schedule');
        var _project_scope_text = $('#checkbox-project-scope-fel1').is(':checked') ? $('.js-fel1-text-project-scope').val() : '';
        var _identified_parameter_text = $('#checkbox-identified_parameter').is(':checked') ? $('.js-text-identified_parameter_text').val() : '';
        var _alternative_text = $('#checkbox-alternatives').is(':checked') ? $('.js-text-alternatives_text').val() : '';
        var _list_of_stakeholder_text = $('#checkbox-list_of_stakeholder').is(':checked') ? $('.js-text-list_of_stakeholder_text').val() : '';
        var _schedule_project_text = $('#checkbox-schedule').is(':checked') ? $('.js-text-schedule_project_text').val() : '';
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
        var _fel1_approve = $('.js-fel1-attachment_fel1_approve')[0].files;

        var formData = new FormData();
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        formData.append('file_category','FEL 1')
        formData.append('project_id',_project_id)
        formData.append('project_scope',setBooleanNumber(_project_scope.is(':checked')))
        formData.append('identified_parameter_requirement_regulation',setBooleanNumber(_identified_parameter.is(':checked')))
        formData.append('alternatives',setBooleanNumber(_alternative.is(':checked')))
        formData.append('list_of_stakeholder',setBooleanNumber(_list_of_stakeholder.is(':checked')))
        formData.append('schedule_project',setBooleanNumber(_schedule_project.is(':checked')))
        formData.append('project_scope_text',_project_scope_text)
        formData.append('identified_parameter_requirement_regulation_text',_identified_parameter_text)
        formData.append('alternatives_text',_alternative_text)
        formData.append('list_of_stakeholder_text',_list_of_stakeholder_text)
        formData.append('schedule_project_text',_schedule_project_text)
        formData.append('list_of_stakeholder_text',_list_of_stakeholder_text)
        formData.append('status',_status)
        if(_parameter_regulation.length > 0) formData.append('parameter_regulation',_parameter_regulation[0])
        if(_initial_process_diagram.length > 0) formData.append('initial_process_diagram',_initial_process_diagram[0])
        if(_data_of_alternatives.length > 0) formData.append('data_of_alternatives',_data_of_alternatives[0])
        if(_initial_schedule.length > 0) formData.append('initial_schedule',_initial_schedule[0])
        if(_project_level_assessment.length > 0) formData.append('project_level_assessment',_project_level_assessment[0])
        if(_stakeholder_list.length > 0) formData.append('stakeholder_list',_stakeholder_list[0])
        if(_fel1_approve.length > 0) formData.append('fel1_approve',_fel1_approve[0])
        formData.append('project_name',_form.data('name'))

        if($('.js-fel1-form').valid()){
            $.ajax({
                url: _url,
                type: _type,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data)
                    if (data.status === 200) window.location.href = data.url;
                    else {
                        notification('danger', data, 'fa fa-time', data.message)
                        _this.removeAttr('disabled')
                        _this.find('.loader-34').addClass('d-none')
                    }
                }
            })
        } else {
            _this.removeAttr('disabled')
            _this.find('.loader-34').addClass('d-none')
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
            validate_check_empty_count:{
                required: {
                    depends:function(){
                        var _count = 0;
                        $('.js-checkbox-fel1').each(function(){
                            if($(this).is(':checked')){
                                _count += 1;
                            }
                        })
                        return _count < 1;
                    }
                }
            },
        },
        messages: {
            validate_fel1_project_scope: {
                required: "Since you check Project Scope Statement this field is required"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            } else if(element.hasClass('js-validate-checkbox-count')){
                element.closest('.js-fel1-form').find('.error-msg-checkbox').append(error)
            } else {
                error.insertAfter(element)
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
        _this.attr('disabled', 'disabled')
        _this.find('.loader-34').removeClass('d-none')
        tinyMCE.triggerSave();

        var _form = _this.closest('.js-fel2-form');
        var _project_scope = _form.find('#checkbox-project_scope-fel2');
        var _identify_main_equipment = _form.find('#checkbox-identify_main_equipment');
        var _boundary_assumption = _form.find('#checkbox-boundary_assumption');
        var _analysis_of_option = _form.find('#checkbox-analysis_of_option')
        var _permit_list = _form.find('#checkbox-permit_list');
        var _schedule_project = _form.find('#checkbox_fel2-schedule_project');
        var _alternative_and_analysis = _form.find('#checkbox-alternatives_and_analysis')
        var _cost_estimate = _form.find('#checkbox-cost_estimate_fel2');
        var _project_id = _form.find('.js-project-id').val();

        var _project_scope_text = _project_scope.is(':checked') ? _form.find('.js-fel2-text-project-scope').val() : '';
        var _identify_main_equipment_text = _identify_main_equipment.is(':checked') ? _form.find('.js-text-identify_main_equipment').val() : '';
        var _boundary_assumption_text = _boundary_assumption.is(':checked') ? _form.find('.js-text-boundary_and_assumption_text').val() : '';
        var _analysis_of_option_text = _analysis_of_option.is(':checked') ? _form.find('.js-text-analysis_of_option_text').val() : '';
        var _permit_list_text = _permit_list.is(':checked') ? _form.find('.js-text-permit_list_text').val() : '';
        var _schedule_project_text = _schedule_project.is(':checked') ? _form.find('.js-text-fel2-schedule_project_text').val() : '';
        var _cost_estimate_text = _cost_estimate.is(':checked') ? _form.find('.js-cost_estimate_assessment').val() : '';
        var _alternative_and_analysis_text = _alternative_and_analysis.is(':checked') ? _form.find('.js-text-alternatives_and_analysis').val() : '';
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        var _file_calculation_of_capacity = $('.js-fel2-attachment_calculation_of_capacity')[0].files;
        var _file_data_of_survey_parameter = $('.js-fel2-attachment_data_of_survey_parameter')[0].files;
        var _file_diagram_process = $('.js-fel2-attachment_diagram_process')[0].files;
        var _file_initial_risk_assessment = $('.js-fel2-attachment_initial_risk_assessment')[0].files;
        var _file_initial_utility_diagram = $('.js-fel2-attachment_initial_utility_diagram')[0].files;
        var _file_quotation_main_equipment = $('.js-fel2-attachment_quotation_main_equipment')[0].files;
        var _file_project_level_assessment = $('.js-fel2-attachment_project_level_assessment')[0].files;
        var _file_fel1 = $('.js-fel2-attachment_fel1')[0].files;
        var _file_technical_evaluation = $('.js-fel2-attachment_technical_evaluation')[0].files;
        var _file_financial_evaluation = $('.js-fel2-attachment_financial_evaluation')[0].files;
        var _file_schedule_level2 = $('.js-fel2-attachment_schedule_level-2')[0].files;
        var _file_cost_estimate = $('.js-fel2-attachment_cost_estimate')[0].files;

        var formData = new FormData();
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        formData.append('file_category','FEL 2')
        if(_file_calculation_of_capacity.length > 0) formData.append('reference_of_capacity',_file_calculation_of_capacity[0])
        if(_file_data_of_survey_parameter.length > 0) formData.append('data_of_survey_parameter',_file_data_of_survey_parameter[0])
        if(_file_diagram_process.length > 0) formData.append('diagram_process',_file_diagram_process[0])
        if(_file_initial_risk_assessment.length > 0) formData.append('initial_risk_assessment',_file_initial_risk_assessment[0])
        if(_file_initial_utility_diagram.length > 0) formData.append('initial_utility_diagram',_file_initial_utility_diagram[0])
        if(_file_quotation_main_equipment.length > 0) formData.append('quotation_main_equipment',_file_quotation_main_equipment[0])
        if(_file_project_level_assessment.length > 0) formData.append('project_level_assessment',_file_project_level_assessment[0])
        if(_file_fel1.length > 0) formData.append('fel1',_file_fel1[0])
        if(_file_technical_evaluation.length > 0) formData.append('technical_evaluation',_file_technical_evaluation[0])
        if(_file_financial_evaluation.length > 0) formData.append('financial_evaluation',_file_financial_evaluation[0])
        if(_file_schedule_level2.length > 0) formData.append('schedule_level_2',_file_schedule_level2[0])
        if(_file_cost_estimate.length > 0) formData.append('file_cost_estimate',_file_cost_estimate[0])

        formData.append('project_id',_project_id)
        formData.append('project_name',_form.data('name'))
        formData.append('project_scope',setBooleanNumber(_project_scope.is(':checked')))
        formData.append('identify_main_equipment',setBooleanNumber(_identify_main_equipment.is(':checked')))
        formData.append('boundary_and_assumption',setBooleanNumber(_boundary_assumption.is(':checked')))
        formData.append('analysis_of_option',setBooleanNumber(_analysis_of_option.is(':checked')))
        formData.append('permit_list',setBooleanNumber(_permit_list.is(':checked')))
        formData.append('schedule_project',setBooleanNumber(_schedule_project.is(':checked')))
        formData.append('cost_estimate',setBooleanNumber(_cost_estimate.is(':checked')))
        formData.append('alternatives_and_analysis',setBooleanNumber(_alternative_and_analysis.is(':checked')))
        formData.append('project_scope_text',_project_scope_text)
        formData.append('identify_main_equipment_text',_identify_main_equipment_text)
        formData.append('boundary_and_assumption_text',_boundary_assumption_text)
        formData.append('analysis_of_option_text',_analysis_of_option_text)
        formData.append('permit_list_text',_permit_list_text)
        formData.append('schedule_project_text',_schedule_project_text)
        formData.append('cost_estimate_text',_cost_estimate_text)
        formData.append('alternatives_and_analysis_text',_alternative_and_analysis_text)
        formData.append('status',_status)

        var _url = _form.attr('action')
        var _type = _form.attr('method')

        if($('.js-fel2-form').valid()){
            $.ajax({
                url: _url,
                type: _type,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status === 200) window.location.href = data.url;
                    else {
                        notification('danger', data, 'fa fa-time', data.message)
                        _this.removeAttr('disabled')
                        _this.find('.loader-34').addClass('d-none')
                    }
                }
            })
        } else {
            _this.find('.loader-34').addClass('d-none')
            _this.removeAttr('disabled');
        }
    })

    $('.js-fel2-form').validate({
        ignore: [],
        focusInvalid: true,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_fel2_project_scope: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project_scope-fel2').is(':checked') &&
                            removeHtmlTag($('.js-fel2-text-project-scope').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel2_identify_main_equipment: {
                required: {
                    depends: function () {
                        if ($('#checkbox-identify_main_equipment').is(':checked') &&
                            removeHtmlTag($('.js-text-identify_main_equipment').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel2_alternatives_and_analysis: {
                required: {
                    depends: function () {
                        if ($('#checkbox-alternatives_and_analysis').is(':checked') &&
                            removeHtmlTag($('.js-text-alternatives_and_analysis').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
        },
        messages: {
            validate_fel2_project_scope: {
                required: "Since you check Project Scope this field is required"
            },
            validate_fel2_identify_main_equipment: {
                required: "Since you check Identify Main Equipment, Requirement & Regulation this field is required"
            },
            validate_fel2_alternatives_and_analysis: {
                required: "Since you check Alternatives and Analysis of Alternatives this field is required"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            } else if(element.hasClass('js-cost_estimate_fel2')){
                error.insertAfter(element.closest('.js-cost-estimate'))
            } else if(element.hasClass('js-validate-checkbox-count')){
                element.closest('.js-fel2-form').find('.error-msg-checkbox').append(error)
            } else {
                error.insertAfter(element)
            }
        }
    })


    $('.js-checkbox-fel2').each(function () {
        var _this = $(this)
        var _btn_submit_fel2 = $('.js-create-fel2');
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
        tinymce.triggerSave()
        var _this = $(this)
        _this.attr('disabled', 'disabled')
        _this.find('.loader-34').removeClass('d-none')

        var _form = _this.closest('.js-fel3-form');
        var _executive_summary = _form.find('#checkbox-executive_summary_fel3');
        var _problem_statement = _form.find('#checkbox-problem_statement_fel3');
        var _project_scope = _form.find('#checkbox-project_scope_fel3');
        var _alternatives = _form.find('#checkbox-alternatives_best_option_fel3')
        var _project_schedule = _form.find('#checkbox-project_schedule_fel3');
        var _list_of_equipment = _form.find('#checkbox-list_of_equipment_fel3');
        var _hazop = _form.find('#checkbox-hazop');
        var _cost_estimate = _form.find('#checkbox-cost_estimate_fel3');

        var _executive_summary_text = _executive_summary.is(':checked') ? _form.find('.js-fel3-executive_summary_text').val() : '';
        var _problem_statement_text = _problem_statement.is(':checked') ? _form.find('.js-fel3-problem_statement_text').val() : '';
        var _project_scope_text = _project_scope.is(':checked') ? _form.find('.js-fel3-project_scope_text').val() : '';
        var _alternatives_text = _alternatives.is(':checked') ? _form.find('.js-fel3-alternatives_and_best_option_text').val() : '';
        var _project_schedule_text = _project_schedule.is(':checked') ? generateJsonSchedule() : "";
        var _list_of_equipment_text = _list_of_equipment.is(':checked') ? _form.find('.js-fel3-list_of_equipment_text').val() : '';
        var _hazop_text = _hazop.is(':checked') ? _form.find('.js-fel3-hazop_study_text').val() : '';
        var _cost_estimate_text = _cost_estimate.is(':checked') ? _form.find('.js-fel3-cost_estimate_text').val() : '';
        var _project_id = _form.find('.js-project-id').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        var _preliminary_design =  $('.js-fel3-attachment_preliminary_design')[0].files;
        var _utility_infrastructure_facilities_diagram =  $('.js-fel3-attachment_utility_infrastructure_facilities_diagram')[0].files;
        var _hazop_file =  $('.js-fel3-attachment_hazop')[0].files;
        var _moc_document =  $('.js-fel3-attachment_moc_document')[0].files;
        var _cost_estimate_file =  $('.js-fel3-cost_estimate')[0].files;
        var _quotation_of_equipment =  $('.js-fe3-attachment_quotation_of_equipment')[0].files;
        var _project_level_assessment =  $('.js-fel3-attachment_project_level_assessment')[0].files;
        var _fel1 =  $('.js-fel3-attachment_fel1')[0].files;
        var _fel2 =  $('.js-fel3-attachment_fel2 ')[0].files;

        var formData = new FormData()
        formData.append('file_category','FEL 3')
        formData.append('project_id',_project_id)
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        formData.append('project_name',_form.data('name'));
        formData.append('executive_summary',setBooleanNumber(_executive_summary.is(':checked')))
        formData.append('problem_statement',setBooleanNumber(_problem_statement.is(':checked')))
        formData.append('project_scope',setBooleanNumber(_project_scope.is(':checked')))
        formData.append('alternatives_and_best_option',setBooleanNumber(_alternatives.is(':checked')))
        formData.append('project_schedule',setBooleanNumber(_project_schedule.is(':checked')))
        formData.append('list_of_equipment_and_specification',setBooleanNumber(_list_of_equipment.is(':checked')))
        formData.append('hazop_study',setBooleanNumber(_hazop.is(':checked')))
        formData.append('cost_estimate',setBooleanNumber(_cost_estimate.is(':checked')))
        formData.append('executive_summary_text',_executive_summary_text)
        formData.append('problem_statement_text',_problem_statement_text)
        formData.append('project_scope_text',_project_scope_text)
        formData.append('alternatives_and_best_option_text',_alternatives_text)
        formData.append('project_schedule_text',_project_schedule_text)
        formData.append('list_of_equipment_and_specification_text',_list_of_equipment_text)
        formData.append('hazop_study_text',_hazop_text)
        formData.append('cost_estimate_text',_cost_estimate_text)
        formData.append('status',_status)
        formData.append('project_name',_form.data('name'))

        if($('.js-maturity-analysis-type').val() !== null) formData.append('maturity_type',$('.js-maturity-analysis-type').val())

        // attachment
        if(_preliminary_design.length > 0) formData.append('preliminary_design',_preliminary_design[0])
        if(_utility_infrastructure_facilities_diagram.length > 0) formData.append('utility_infrastructure_facilities_diagram',_utility_infrastructure_facilities_diagram[0])
        if(_hazop_file.length > 0) formData.append('hazop',_hazop_file[0])
        if(_moc_document.length > 0) formData.append('moc_document',_moc_document[0])
        if(_cost_estimate_file.length > 0) formData.append('cost_estimate_file',_cost_estimate_file[0])
        if(_quotation_of_equipment.length > 0) formData.append('quotation_of_equipment',_quotation_of_equipment[0])
        if(_project_level_assessment.length > 0) formData.append('project_level_assessment',_project_level_assessment[0])
        if(_fel1.length > 0) formData.append('fel1',_fel1[0])
        if(_fel2.length > 0) formData.append('fel2',_fel2[0])

        if(_form.valid()){
            $.ajax({
                url: _url,
                type: _type,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data)
                    if (data.status === 200) window.location.href = data.url;
                    else {
                        notification('danger', data, 'fa fa-time', data.message)
                        _this.removeAttr('disabled')
                        _this.find('.loader-34').addClass('d-none')
                    }
                }
            })
        } else {
            _this.find('.loader-34').addClass('d-none')
            _this.removeAttr('disabled');
        }
    })

    function generateJsonSchedule(){
        var _schedule = [];
        var _form_schedule = $('.js-table-schedule').find('.js-table-row-schedule')

        $.each(_form_schedule, function(){
            var _this = $(this);
            var _desc = _this.find('.js-schedule-desc').val();
            var _start_date = _this.find('.js-schedule-start-date').val();
            var _end_date = _this.find('.js-schedule-end-date').val();
            var _data = {
                "desc": _desc,
                "start_date": _start_date,
                "end_date": _end_date
            };

            _schedule.push(_data);
        })

        var jsonSchedule = JSON.stringify(_schedule);

        return jsonSchedule;
    }

    $(document).on('change', '.js-checkbox-schedule-fel3', function(){
        var _this = $(this);
        var _row_schedule = _this.closest('.js-row-schedule').find('tr');
        if(_this.is(':checked')){
            $('.js-table-schedule').removeClass('d-none');
            if(_row_schedule.length < 1){
                $('.js-table-schedule').find('tbody').append(rowScheduleTemp())
            }
        } else {
            $('.js-table-schedule').addClass('d-none');
            _row_schedule.remove();
        }
    })

    function rowScheduleTemp(){
        var _temp = ' <tr class="js-table-row-schedule" data-idx="0">\n' +
            '              <td class="w-25">\n' +
            '                    <input class="form-control js-schedule-desc" name="schedule_desc[]">\n' +
            '              </td>\n' +
            '              <td>\n' +
            '                     <input class="form-control js-schedule-start-date" type="date" name="schedule_start_date[]">\n' +
            '              </td>\n' +
            '              <td>\n' +
            '                      <input class="form-control js-schedule-end-date" type="date" name="schedule_end_date[]">\n' +
            '              </td>\n' +
            '              <td>\n' +
            '                    <i class="fa fa-trash-o text-danger js-remove-schedule-fel3"></i>\n' +
            '                    <i class="fa fa-plus-circle cursor-pointer js-add-new-schedule-fel3"></i>\n' +
            '               </td>\n' +
            '             </tr>';

        return _temp;
    }


    $(document).on('click', '.js-add-new-schedule-fel3', function(){
        console.log("op")
        var _this = $(this);
        _this.closest('tbody').append(rowScheduleTemp())
    })


    $(document).on('click', '.js-remove-schedule-fel3', function(){
        var _this = $(this)
        if(_this.closest('tbody').find('.js-table-row-schedule').length > 1) _this.closest('tr').remove()
    })


    $('.js-fel3-form').validate({
        ignore: [],
        focusInvalid: true,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_fel3_executive_summary: {
                required: {
                    depends: function () {
                        if ($('#checkbox-executive_summary-fel3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-executive_summary_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_problem_statement: {
                required: {
                    depends: function () {
                        if ($('#checkbox-problem_statement_fel3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-problem_statement_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_project_scope: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project_scope_fel_3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-project_scope_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_alternatives_and_best_option: {
                required: {
                    depends: function () {
                        if ($('#checkbox-alternatives_best_option').is(':checked') &&
                            removeHtmlTag($('.js-fel3-alternatives_and_best_option_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_project_schedule: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project_schedule_fel_3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-project_schedule_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_list_of_equipment: {
                required: {
                    depends: function () {
                        if ($('#checkbox-list_of_equipment_fel3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-list_of_equipment_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_fel3_hazop_study: {
                required: {
                    depends: function () {
                        if ($('#checkbox-hazop').is(':checked') &&
                            removeHtmlTag($('.js-fel3-hazop_study_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            fel3_cost_estimate: {
                required: {
                    depends: function () {
                        return !!($('#checkbox-cost_estimate_fel3').is(':checked') &&
                            removeHtmlTag($('.js-fel3-cost_estimate_text').val()) === '');

                    }
                }
            },
            validate_check_empty_count:{
                required: {
                    depends:function(){
                        var _count = 0;
                        $('.js-checkbox-fel3').each(function(){
                            if($(this).is(':checked')){
                                _count += 1;
                            }
                        })
                        return _count < 1;
                    }
                }
            }
        },
        messages:{
            validate_check_empty_count: {
                required: "Please fill the checkbox form"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            } else if(element.hasClass('js-fel3-cost_estimate_text')){
                error.insertAfter(element.closest('.js-cost-estimate'))
            } else if(element.hasClass('js-validate-checkbox-count')){
                element.closest('.js-fel3-form').find('.error-msg-checkbox').append(error)
            } else {
                error.insertAfter(element)
            }
        }
    })

    $('.js-checkbox-fel3').each(function () {
        var _this = $(this)
        var _btn_submit_fel3 = $('.js-create-fel3');
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

    $('#checkbox-financial_evaluation').on('change',function(){
        var _this = $(this)
        if(_this.is(':checked')){
            _this.closest('tr').find('.js-table-financial-evaluation').removeClass('d-none')
        } else {
            _this.closest('tr').find('.js-table-financial-evaluation').addClass('d-none')
        }
    });

    $('.js-checkbox-business_case').each(function () {
        var _this = $(this)
        var _btn_submit_bc = $('.js-create-bc');
        _this.on('change', function () {
            var __this = $((this))
            checkDisableButton(__this, _btn_submit_bc, false, false)
        })
    })

    var _bc_submit_form = $('.js-create-bc')

    _bc_submit_form.on('click', function (e) {
        e.preventDefault();
        tinymce.triggerSave();
        var _this = $(this)

        // _this.attr('disabled', 'disabled')
        // _this.find('.loader-34').removeClass('d-none')

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
        var _severity = _form.find('.js-set-label-severity').text();
        var _risk_probability = $('.js-risk-probability').val();

        var _cost_estimate = $('.js-cost_estimate_bc').val();
        var _npv = $('.js_bc_npv').val();
        var _payback_period = $('.js_bc_payback_period').val();
        var _irr = $('.js_bc_irr').val();

        var _url = _form.attr('action')
        var _type = _form.attr('method')
        var _status = _this.data('status') ? _this.data('status') : 'draft';

        var _problem_statement_text = $('.js-bc_problem_and_objective').val();
        var _project_alternative_text = $('.js-bc_project_alternative_text').val();
        var _scope_of_work_text = $('.js-bc_scope_of_work').val();
        var _major_equipment_text = $('.js-bc_major_equipment_text').val();
        var _utility_requirement_text = $('.js-bc_utility_requirement_text').val();
        var _permitting_text = $('.js-bc_permitting').val();
        var _social_community_text = $('.js-bc_social_community').val();
        var _additional_information_text = $('.js-bc_additional_information').val();

        var _attachment = $('.js-bc-attachment_file')[0].files
        var _fel3_approved = $('.js-business_case-fel3_approved')[0].files
        var _change_management_request = $('.js-bc-change_management_request')[0].files

        var formData = new FormData();
        formData.append('problem_statement_and_objective_text',_problem_statement_text)
        if (_form.data('method') === 'put') formData.append('_method', 'put')
        if(_attachment.length > 0) formData.append('attachment',_attachment[0])
        if(_fel3_approved.length > 0) formData.append('fel3_approved',_fel3_approved[0])
        if(_change_management_request.length > 0) {
            formData.append('change_management_request',_change_management_request[0])
        }
        formData.append('file_category','Business Case')

        formData.append('project_alternatives_text',_project_alternative_text)
        formData.append('project_scope_of_work_text',_scope_of_work_text)
        formData.append('major_equipment_text',_major_equipment_text)
        formData.append('utility_requirements_text',_utility_requirement_text)
        formData.append('permitting_text',_permitting_text)
        formData.append('social_community_and_government_text',_social_community_text)
        formData.append('additional_information_text',_additional_information_text)
        formData.append('project_name',_form.data('name'));

        formData.append('project_id',_project_id)
        formData.append('problem_statement_and_objective',setBooleanNumber(_problem_and_objective.is(':checked')))
        formData.append('project_alternatives',setBooleanNumber(_project_alternatives.is(':checked')))
        formData.append('project_scope_of_work',setBooleanNumber(_scope_of_work.is(':checked')))
        formData.append('major_equipment',setBooleanNumber(_major_equipment.is(':checked')))
        formData.append('utility_requirements',setBooleanNumber(_utility_requirement.is(':checked')))
        formData.append('permitting',setBooleanNumber(_permitting.is(':checked')))
        formData.append('social_community_and_government',setBooleanNumber(_social_community.is(':checked')))
        formData.append('financial_evaluation',setBooleanNumber(_financial_evaluation.is(':checked')))
        formData.append('risk_assessment',setBooleanNumber(_risk_assessment.is(':checked')))
        formData.append('additional_information',setBooleanNumber(_additional_information.is(':checked')))
        formData.append('people',_risk_people)
        formData.append('environment',_risk_environment)
        formData.append('social_and_human_rights',_risk_human_rights)
        formData.append('reputation',_risk_reputation)
        formData.append('finance',_risk_finance)
        formData.append('probability',_risk_probability)
        formData.append('priority_level',!isNaN(parseInt(_risk_priority)) ? parseInt(_risk_priority) : '')
        formData.append('severity', _severity)
        formData.append('status',_status)
        formData.append('cost_estimate',_cost_estimate)
        formData.append('npv',_npv || 0)
        formData.append('irr',_irr ? parseInt(_irr) : 0)
        formData.append('payback_period',_payback_period ? parseInt(_payback_period) : 0)

        if($('.js-bc-form').valid()){
            _this.find('.loader-34').removeClass('d-none')
            _this.attr('disabled');
            $.ajax({
                url: _url,
                type: _type,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status === 200) window.location.href = data.url;
                    else notification('alert', data, '', '')
                }
            })
        } else {
            _this.find('.loader-34').addClass('d-none')
            _this.removeAttr('disabled');
        }
    })

    $('.js-bc-form').validate({
        ignore: [],
        focusInvalid: false,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids()) return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 100);

        },
        rules: {
            validate_bc_problem_and_objective: {
                required: {
                    depends: function () {
                        if ($('#checkbox-problem_and_objective').is(':checked') &&
                            removeHtmlTag($('.js-bc_problem_and_objective').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_project_alternative: {
                required: {
                    depends: function () {
                        if ($('#checkbox-project_alternative').is(':checked') &&
                            removeHtmlTag($('.js-bc_project_alternative_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_project_scope_of_work: {
                required: {
                    depends: function () {
                        if ($('#checkbox-scope_of_work').is(':checked') &&
                            removeHtmlTag($('.js-bc_scope_of_work').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_utility_requirement: {
                required: {
                    depends: function () {
                        if ($('#checkbox-utility_requirement').is(':checked') &&
                            removeHtmlTag($('.js-bc_utility_requirement_text').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_permitting: {
                required: {
                    depends: function () {
                        if ($('#checkbox-permitting').is(':checked') &&
                            removeHtmlTag($('.js-bc_permitting').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_social_community_and_government: {
                required: {
                    depends: function () {
                        if ($('#checkbox-social_community').is(':checked') &&
                            removeHtmlTag($('.js-bc_social_community').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_bc_additional: {
                required: {
                    depends: function () {
                        if ($('#checkbox-additional_information').is(':checked') &&
                            removeHtmlTag($('.js-bc_additional_information').val()) === '') {
                            return true
                        }
                        return false;
                    }
                }
            },
            validate_check_empty_count:{
                required: {
                    depends:function(){
                        var _count = 0;
                        $('.js-checkbox-business_case').each(function(){
                            if($(this).is(':checked')){
                                _count += 1;
                            }
                        })
                        return _count < 1;
                    }
                }
            }
        },
        messages: {
            validate_check_empty_count: {
                required: "Please fill the checkbox form"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.hasClass('js-hidden-validate')) {
                element.siblings('.js-error-message').html(error)
            } else if(element.hasClass('js-validate-checkbox-count')){
                element.closest('.js-bc-form').find('.error-msg-checkbox').append(error)
            } else {
                error.insertAfter(element)
            }
        }
    })


    $('#checkbox-risk_assessment').on('change', function () {
        var _this = $(this);
        var _parent = _this.closest('tr');
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
            $('.js-set-label-severity').text(setSeverity(_final_impact_score_value))
        })
    })


    var _existing_priority_element = $('.js-set-label-priority-level');
    if (_existing_priority_element.length > 0) {
        setBackgroundPriority(_existing_priority_element.text(), _existing_priority_element)
    }

    function setSeverity(_final_impact_score){
        var _severity = '';
        if(_final_impact_score == 1){
            _severity = "Low"
        } else if (_final_impact_score == 2){
            _severity = "Moderate"
        } else if (_final_impact_score == 3){
            _severity = "Severe"
        } else if (_final_impact_score == 4){
            _severity = "Critical"
        } else if (_final_impact_score == 5){
            _severity = "Very Critical"
        } else {
            _severity = ""
        }

        return _severity;
    }
    function setPriorityLevel(_final_impact_score, _probability) {

        var _risk_matrix = [
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
            var _val = _input.data('default').toString().replace('.',',')
            var _convertVal = currencyFormat(_val)
            _input.val(_convertVal)
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
     */
    var _table_no = 1;
    var _table_attachment = $('.js-bc-attachment_file').length - 1;
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

    $('.js-save-bc').on('click', function (e){
        $(this).find('.loader-34').removeClass('d-none')
        $(this).attr('disabled','disabled')
        e.preventDefault();
        var _form = $('.js-cb-form');
        _form.submit()
    })

    $('.js-create-cb').on('click', function (e) {
        // $(this).find('.loader-34').removeClass('d-none')
        e.preventDefault();
        var _form = $('.js-cb-form');
        _form.find('.js-content-cost-benefit').addClass('d-none');
        _form.find('.js-form-attachment-cb').removeClass('d-none');
        _form.find('.js-create-cb').addClass('d-none');
        // _form.submit()
    })

    $('.js-back-bc').on('click', function (e){
        e.preventDefault();
        var _form = $('.js-cb-form');
        _form.find('.js-content-cost-benefit').removeClass('d-none');
        _form.find('.js-form-attachment-cb').addClass('d-none');
        _form.find('.js-create-cb').removeClass('d-none');
    })

    //!!Alert
    //will refactor soon
    $(document).on('keyup', '.js-cost-benefit', function () {
        var _parent = $(this).closest('tr')
        var _initial_and_sustaining = _parent.find('.js-initial-and-sustaining')
        var _js_additional_revenue = _parent.find('.js-additional-revenue').val()
        var _js_increment_operating = _parent.find('.js-increment-operating-cost').val()
        var _js_cost_saving = _parent.find('.js-cost-savings').val();

        _js_cost_saving = currencyFormat(_js_cost_saving)
        var _js_cost_saving_default = currencyFormat(_js_cost_saving)

        _js_increment_operating = currencyFormat(_js_increment_operating)
        var _js_increment_operating_default = currencyFormat(_js_increment_operating)

        _js_additional_revenue = currencyFormat(_js_additional_revenue)
        var _js_additional_revenue_default = currencyFormat(_js_additional_revenue)


        _js_cost_saving = _js_cost_saving.replace(".","")
        _js_increment_operating = _js_increment_operating.replace(".","")
        _js_increment_operating = _js_increment_operating.replace(".","")
        _js_additional_revenue = _js_additional_revenue.replace(".","")

        _js_cost_saving = _js_cost_saving.replace(",",".")
        _js_increment_operating = _js_increment_operating.replace(",",".")
        _js_increment_operating = _js_increment_operating.replace(",",".")
        _js_additional_revenue = _js_additional_revenue.replace(",",".")

        var _js_cost_saving_val = _js_cost_saving || 0;
        var _js_increment_operating_val = _js_increment_operating || 0;
        var _js_additional_revenue_val = _js_additional_revenue || 0;

        if($(this).hasClass('js-cost-savings')){
            $(this).val(_js_cost_saving_default)
        }
        if($(this).hasClass('js-increment-operating-cost')){
            $(this).val(_js_increment_operating_default)
        }
        if($(this).hasClass('js-additional-revenue')){
            $(this).val(_js_additional_revenue_default)
        }

        var _total = parseFloat(_js_cost_saving_val) + parseFloat(_js_increment_operating_val) + parseFloat(_js_additional_revenue_val)
        _total = _total.toString().replace('.',',')
        _parent.find('.js-net-incremental-benefits').val(_total)
    })

    /**
     * JS Checkbox Capex Investment
     */

    $(document).on('click','.js-checkbox-open-bucket', function(){
        var _this = $(this);
        var _basket = _this.val();

        if(_this.is(':checked')){
            $('.js-modal-loading').modal('show')
            disabledCheckbox(_this.data('id'), true)
            $('.js-hidden-basket').val(_basket);
            renderSubBasket(_basket)
        } else {
            disabledCheckbox(_this.data('id'), false);
            $('.js-button-investment_category').attr('disabled','disabled');
            $('.js-hidden-basket').val('')
            $('.js-hidden-sub-basket').val('')
            $('.js-hidden-sub_basket_categories').val('')
            $('.js-checkbox-sub-basket-item').remove();
            $('.js-checkbox-categories-item').remove();
        }
    });

    $(document).on('click', '.js-checkbox-open-sub-basket', function(){
        var _this = $(this);
        var _subBasket = _this.val();

        disabledSubBasket(_this.data('id'), true)
        if(_this.is(':checked')){
            $('.js-modal-loading').modal('show')
            $('.js-hidden-sub-basket').val(_subBasket);
            renderCategories(_subBasket, false)
        } else {
            disabledSubBasket(_this.data('id'), false)
            $('.js-text-validation-basket').text('* Please select sub basket')
            $('.js-button-investment_category').attr('disabled','disabled');
            $('.js-checkbox-categories-item').remove();
            $('.js-hidden-sub-basket').val('');
            $('.js-hidden-sub_basket_categories').val('');
        }
    })

    function renderSubBasket(_basket, callback){
        if(_basket === null){
            _basket = $('.js-checkbox-open-bucket:checked').val();
        }

        $.ajax({
            url:'/getSubBasketByBasket',
            data: {basket:_basket},
            success:function(data){
                if(data.length < 1){
                    $('.js-button-investment_category').removeAttr('disabled');
                    $('.js-text-validation-basket').text('')
                    $('.js-modal-loading').modal('hide')
                    return false;
                }

                $('.js-text-validation-basket').text('* Please select sub basket')
                var template = $('#js-template-capex-investment').html();
                Mustache.parse(template);
                var data = {
                    "data" : data
                }
                var _temp = Mustache.render(template, data)
                $('.js-checkbox-sub-basket-form').append(_temp);
                $('.js-modal-loading').modal('hide')

                if (typeof callback === 'function') {
                    checkSubBasket()
                    callback(); // Call renderCategories after renderSubBasket completes
                };
            }
        })
    }
    function renderCategories(_subBasket, isEdit){
        if(_subBasket === null){
            _subBasket = $('.js-checkbox-open-sub-basket:checked').val();
        }

        $.ajax({
            url : '/getCategoriesBySubBasket',
            data : {sub_basket:_subBasket},
            success:function(data){
                if(data.length < 1){
                    $('.js-button-investment_category').removeAttr('disabled');
                    $('.js-text-validation-basket').text('')
                    $('.js-modal-loading').modal('hide')
                    return false;
                }

                $('.js-text-validation-basket').text('* Please select category')
                var template = $('#js-template-categories').html();
                Mustache.parse(template);
                var data = {
                    "data" : data
                }
                var _temp = Mustache.render(template, data)
                $('.js-checkbox-categories-form').append(_temp);
                $('.js-modal-loading').modal('hide')

                if(isEdit === true) checkCategories()
            }
        })
    }

    function checkSubBasket(){
        var _val = $('.js-hidden-sub-basket').val();
        var _el = $('.js-checkbox-open-sub-basket[data-id="'+_val+'"]');
        _el.prop('checked', true);
        disabledSubBasket(_val, true);
    }

    function checkCategories(){
        var _val = $('.js-hidden-sub_basket_categories').val();
        var _el = $('.js-checkbox-open-categories[data-id="'+_val+'"]');
        _el.prop('checked', true);
        disableCategories(_val, true);
    }

    $(document).on('click','.js-btn-edit_project', function(){
        disabledCheckbox($('.js-checkbox-open-bucket:checked').data('id'),true)
        renderSubBasket(null,function(){
            renderCategories(null, true)
        })
        validatedCount($(this))
    })

    $(document).on('click','.js-checkbox-open-categories', function(){
        var _this = $(this);
        var _val = _this.val();

        if(_this.is(':checked')){
            $('.js-text-validation-basket').text('')
            $('.js-button-investment_category').removeAttr('disabled');
            disableCategories(_this.data('id'), true)
            $('.js-hidden-sub_basket_categories').val(_val)
        } else {
            $('.js-text-validation-basket').text('* Please select categories')
            disableCategories(_this.data('id'), false)
            $('.js-hidden-sub_basket_categories').val('');
            $('.js-button-investment_category').attr('disabled','disabled');
        }
    })

    function disabledCheckbox(_id, _isChecked){
        $('.js-checkbox-open-bucket').each(function(){
            if(_isChecked){
                if($(this).data('id') != _id){
                    $(this).attr('disabled','disabled')
                }
            } else {
                $(this).removeAttr('disabled')
            }

        })
    }

    function disabledSubBasket(_id, _isChecked){
        $('.js-checkbox-open-sub-basket').each(function() {
            if (_isChecked) {
                if ($(this).data('id') != _id) {
                    $(this).attr('disabled', 'disabled')
                }
            } else {
                $(this).removeAttr('disabled')
            }
        })
    }

    function disableCategories(_id, _isChecked){
        $('.js-checkbox-open-categories').each(function() {
            if (_isChecked) {
                if ($(this).data('id') != _id) {
                    $(this).attr('disabled', 'disabled')
                }
            } else {
                $(this).removeAttr('disabled')
            }
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

    var _project_form = $('.js-project-form')
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

    /**
     * Notification
     */
    function disabledViewNotification(){
        $('.js-read-notification').each(function(){
            $(this).click(false)
        })
    }

    $(document).on('click', '.js-read-notification', function (e) {
        e.preventDefault();
        disabledViewNotification()
        var _this = $(this)
        var _id = _this.data('notif-id')
        $(this).closest('.row').find('.js-loader-notification').removeClass('d-none')
        $.ajax({
            url:'/markNotification',
            method:'post',
            data:{
                id:_id
            },
            success:function(){
                window.location.href=_this.attr('href');
            }
        })
    })

    /**
     * Handle currency format
     */

    $(document).on('keypress keyup blur','.js-currency-format',function(e){
    // $('.js-currency-format').on('keypress keyup blur',function(e){
        var _this = $(this)
        var _val = currencyFormat(_this.val());

        _this.val(_val)
        if(e.which === 44 || e.which === 45) return true
        // if(!_val.match(/[\d,]+\.\d+/)){
        //     console.log('false')
        // }
    })

    function currencyFormat(_value){

        var number_string = _value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            rest = split[0].length % 3,
            currency = split[0].substr(0,rest),
            currency_value = split[0].substr(rest).match(/\d{3}/gi)

            if(currency_value){
                var separator = rest ? '.' : '';
                currency += separator + currency_value.join('.');
            }

            var sign = _value.charAt(0);

            currency = split[1] != undefined ? currency + ',' + split[1] : currency;
            if(sign == '-'){
                return '-' + currency;
            }
            return currency
    }

    /**
     * select risk ranking project list
     */
    $('.js-select-rr-project-list').on('change',function(){
        var _value = $(this).val();
        if(_value != '')window.location.href = '/project/year/'+_value
        else window.location.href = '/project'
    })

    /*
     * budget tool form validation
     */

    function validateBudgetTool(){
        var _criteria_length = $('.js-select-criteria-answer').length;
        var _counter_criteria = 0;
        var _btn_submit_criteria = $('.js-btn-submit-criteria');
        $('.js-select-criteria-answer').each(function(){
            var _this = $(this);
            if(_this.val()){
                _counter_criteria++;
            }
            if(_counter_criteria >= _criteria_length){
                _btn_submit_criteria.removeAttr('disabled')
            } else {
                _btn_submit_criteria.attr('disabled','disabled');
            }
        })
    }

    validateBudgetTool();
    $('.js-select-criteria-answer').on('change',function(){
       validateBudgetTool();
    });
})




