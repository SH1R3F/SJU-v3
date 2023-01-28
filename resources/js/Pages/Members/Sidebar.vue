<script></script>
<template>
    <!-- Users menu -->
    <div class="usermenu">
        <div class="userimg">
            <img :src="$page.props.userAuth?.profile_photo || '/img/user.png'" width="196" height="196" />
            <Link :href="route('member.profile.photo')" class="profile-image-button bg-color-dark">
                <i class="fas fa-camera text-light"></i>
            </Link>
        </div>

        <h6>{{ $page.props.userAuth?.fullName }}</h6>
        <ul>
            <li :class="{ active: $page.url == '/members' }">
                <Link :href="route('member.home')">{{ __('Home') }}</Link>
            </li>
            <li :class="{ active: $page.url == '/members/courses' }">
                <Link :href="route('member.courses')">{{ __('Courses') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/members/subscription') }">
                <Link :href="route('member.subscription')">{{ __('Membership ') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/members/profile') }">
                <Link :href="route('member.profile.info')">{{ __('My profile') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/technical-support') }">
                <Link :href="route('support.index')">{{ __('Technical support') }}</Link>
            </li>
            <li>
                <Link as="span" method="POST" :href="route('member.logout')">{{ __('Logout') }}</Link>
            </li>
        </ul>
    </div>
    <!-- Users menu -->
</template>
