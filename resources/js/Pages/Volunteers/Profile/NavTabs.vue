<script></script>
<template>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Volunteers/Profile/Info' }" :href="route('volunteer.profile.info')">{{ __('My information') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Volunteers/Profile/Password' }" :href="route('volunteer.profile.password')">{{ __('Change password') }}</a>
        </li>
    </ul>
    <!-- Nav tabs -->
</template>
