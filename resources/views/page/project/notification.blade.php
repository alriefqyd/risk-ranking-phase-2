@if(Session::has('alert-success'))
    <div class="check-notification" data-msg="{{Session::get('alert-success') ?: 'Your Data Was Saved'}}"></div>
@endif

@if(session::has('alert-error-download'))
    <div class="check-notification" data-status="error" data-template="danger" data-msg="{{Session::get('alert-error-download') ?: 'Error'}}"></div>
@endif
