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
    if($('.check-notification').length > 0){
        notification('','Project Successfully Updated','')
    }

    /**
     * Handle Show Hide Project Edit Form
     */
    $('.js-btn-edit_project').on('click',function(){
        $('.js-form-project-edit').removeClass('d-none');
        $('.js-form-project-detail').addClass('d-none');
        $(this).addClass('d-none');
        $('.js-title-form').removeClass('d-none')
        $('.js-title-detail').addClass('d-none')
        $('.js-btn-view_project').removeClass('d-none')
    })

    $('.js-btn-view_project').on('click',function(){
        $('.js-form-project-edit').addClass('d-none');
        $('.js-form-project-detail').removeClass('d-none');
        $(this).addClass('d-none');
        $('.js-title-form').addClass('d-none')
        $('.js-title-detail').removeClass('d-none')
        $('.js-btn-edit_project').removeClass('d-none')
    })

})


