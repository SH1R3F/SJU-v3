<script></script>
<template>
    <!-- Users menu -->
    <div class="usermenu">
        <div class="userimg">
            <img :src="$page.props.userAuth?.profile_photo || '/img/user.png'" width="196" height="196" />
        </div>

        <h6>{{ $page.props.userAuth?.fullName }}</h6>
        <ul>
            <li :class="{ active: $page.url == '/volunteers/courses' }">
                <Link :href="route('volunteer.courses')">{{ __('Courses') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/volunteers/profile') }">
                <Link :href="route('volunteer.profile.info')">{{ __('My profile') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/technical-support') }">
                <Link :href="route('support.index')">{{ __('Technical support') }}</Link>
            </li>
            <li>
                <Link as="span" method="POST" :href="route('volunteer.logout')">{{ __('Logout') }}</Link>
            </li>
        </ul>
    </div>
    <!-- Users menu -->
</template>
