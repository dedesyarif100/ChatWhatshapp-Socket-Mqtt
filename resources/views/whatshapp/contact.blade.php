@foreach ($users as $user)
@if (Auth::user()->name !== $user->name)
    <input type="hidden" name="userbyid" id="userbyid" value="{{ $user->id }}">
    <div class="row sideBar-body chat-user" id="select_user" data-id="{{ $user->id }}" data-email="{{ $user->email }}">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
            <div class="avatar-icon">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ 'https://ui-avatars.com/api/?name='.$user->name }}" alt="Avatar" class="avatar-img rounded-circle">
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-xs-9 sideBar-main">
            <div class="row">
                <div class="col-sm-8 col-xs-8 sideBar-name">
                    <span class="name-meta" id="user">{{ $user->name }}</span>
                </div>
                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                    <span class="time-meta pull-right">{{ now()->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
