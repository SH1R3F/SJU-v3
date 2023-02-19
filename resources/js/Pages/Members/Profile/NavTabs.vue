<script></script>
<template>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Info' }" :href="route('member.profile.info')">{{ __('My information') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Experiences' }" :href="route('member.profile.experiences')">{{ __('Experiences & Fields') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Photo' }" :href="route('member.profile.photo')">{{ __('Profile picture') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Password' }" :href="route('member.profile.password')">{{ __('Change password') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Id' }" :href="route('member.profile.id')">{{ __('ID photo') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Statement' }" :href="route('member.profile.statement')">{{ __('Employment statement') }}</a>
        </li>

        <li class="nav-item" v-if="$page.props.userAuth?.subscription?.type == 3">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/Contract' }" :href="route('member.profile.contract')">{{ __('Job contract') }}</a>
        </li>

        <li class="nav-item" v-if="$page.props.userAuth?.newspaper_type == 2">
            <a class="nav-link" :class="{ active: $page.component == 'Members/Profile/License' }" :href="route('member.profile.license')">{{ __('Newspaper license') }}</a>
        </li>
    </ul>
    <!-- Nav tabs -->
</template>
