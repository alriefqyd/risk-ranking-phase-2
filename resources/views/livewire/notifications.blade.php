<li wire:poll.visible.5s wire:ignore.self class="onhover-dropdown-custom">
    @if(sizeof($notifications) >= 1)
        <div class="notification-box js-notification-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="dot-animated"></span>
        </div>
    @else
        <div class="js-notification-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
            </svg>
        </div>
    @endif
    <ul wire:ignore.self class="notification-dropdown custom-notification overflow-auto d-none">
        <li style="width: 100%">
            <p class="f-w-700 mb-0">You have {{$numOfNotification}} Notifications<span class="pull-right badge badge-primary badge-pill">{{$numOfNotification}}</span></p>
        </li>
        @foreach($notifications as $notification)
            <li class="noti-danger">
                <div class="media"><span class="notification-bg bg-light-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
                    <div class="media-body">
                        <p>
                            {{$notification?->data['note'] ?
                                'There is note for your '.$notification?->data['project_name'].' project' : ''}}
                        </p><span>
                            {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                        </span>
                        <div class="row">
                            <div class="col-md-8">
                                <a class="js-read-notification" data-project-id={{$notification->data['project_id']}} data-notif-id="{{$notification?->id}}" href="/project/{{$notification->data['project_id']}}">view <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="col-md-4 js-loader-notification d-none">
                                <div class="loader-box" style="height: 10px">
                                    <div class="loader-3" style="width: 20px; height: 20px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</li>
