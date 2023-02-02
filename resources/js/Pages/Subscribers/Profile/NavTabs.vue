<script></script>
<template>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Subscribers/Profile/Info' }" :href="route('subscriber.profile.info')">{{ __('My information') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Subscribers/Profile/Password' }" :href="route('subscriber.profile.password')">{{ __('Change password') }}</a>
        </li>
    </ul>
    <!-- Nav tabs -->
</template>
