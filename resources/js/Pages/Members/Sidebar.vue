<template>
    <!-- Users menu -->
    <div class="usermenu">
        <div class="userimg">
            <img src="/img/user.png" width="196" height="196" />
            <a href="#" class="profile-image-button bg-color-dark">
                <i class="fas fa-camera text-light"></i>
            </a>
        </div>

        <h6>{{ $page.props.userAuth?.name }}</h6>
        <ul>
            <li class="active">
                <a href="#">{{ __('Home') }}</a>
            </li>
            <li>
                <a href="#">{{ __('Events') }}</a>
            </li>
            <li>
                <a href="#">{{ __('Membership ') }}</a>
            </li>
            <li>
                <a href="#">{{ __('My profile') }}</a>
            </li>
            <li>
                <a href="#">{{ __('Technical support') }}</a>
            </li>
            <li>
                <a href="#">{{ __('Logout') }}</a>
            </li>
        </ul>
    </div>
    <!-- Users menu -->
</template>
