<script></script>
<template>
    <!-- Users menu -->
    <div class="usermenu">
        <div class="userimg">
            <img :src="$page.props.userAuth?.profile_photo || '/img/user.png'" width="196" height="196" />
        </div>

        <h6>{{ $page.props.userAuth?.fullName }}</h6>
        <ul>
            <li :class="{ active: $page.url == '/subscribers/courses' }">
                <Link :href="route('subscriber.courses')">{{ __('Courses') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/subscribers/profile') }">
                <Link :href="route('subscriber.profile.info')">{{ __('My profile') }}</Link>
            </li>
            <li :class="{ active: $page.url.startsWith('/technical-support') }">
                <Link :href="route('support.index')">{{ __('Technical support') }}</Link>
            </li>
            <li>
                <Link as="span" method="POST" :href="route('subscriber.logout')">{{ __('Logout') }}</Link>
            </li>
        </ul>
    </div>
    <!-- Users menu -->
</template>
