@extends('layouts.default')

@section('container-style', 'container container-small')
@section('content')
    <div class="row marketing wz-main-container-full">
        <div class="col-3">
            <nav class="nav flex-column">
                <a class="nav-link {{ $op == 'basic' ? 'active':'' }}" href="{{ wzRoute('user:basic') }}">@lang('common.user_info')</a>
                <a class="nav-link {{ $op == 'password' ? 'active':'' }}" href="{{ wzRoute('user:password') }}">@lang('common.change_password')</a>
                <a class="nav-link {{ $op == 'notification' ? 'active':'' }}" href="{{ wzRoute('user:notifications') }}">
                    通知
                    @if(userHasNotifications())
                        <span class="badge">{{ userNotificationCount() }}</span>
                    @endif
                </a>
                <a class="nav-link {{ $op == 'templates' ? 'active':'' }}" href="{{ wzRoute('user:templates') }}">
                    模板管理
                </a>
            </nav>
        </div>
        <div class="col-9">
            @include('components.error', ['error' => $errors ?? null])
            @yield('user-content')
        </div>
    </div>

@endsection
