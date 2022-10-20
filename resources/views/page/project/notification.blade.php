@if(Session::has('alert-success'))
    <div class="check-notification" data-msg="{{Session::get('alert-success') ?: 'Your Data Was Saved'}}"></div>
@endif
