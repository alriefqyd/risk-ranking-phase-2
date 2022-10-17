function notification(type,message,icon){
    var notify = $.notify('<i class="fa fa-bell-o"></i><strong>Loading...</strong>', {
        type: 'theme',
        allow_dismiss: true,
        delay: 2000,
        showProgressbar: true,
        timer: 300
    });

    setTimeout(function() {
        notify.update('message', '<i class="fa fa-check"></i><strong>Success |</strong> '+ message);
    }, 1000);
}

