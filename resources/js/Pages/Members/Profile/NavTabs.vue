<script setup>
defineProps({
    active: String,
});
</script>

<template>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'info' }" :href="route('member.profile.info')">{{ __('My information') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'experiences' }" :href="route('member.profile.experiences')">{{ __('Experiences & Fields') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'photo' }" :href="route('member.profile.photo')">{{ __('Profile picture') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'password' }" :href="route('member.profile.password')">{{ __('Change password') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'id' }" :href="route('member.profile.id')">{{ __('ID photo') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active == 'statement' }" :href="route('member.profile.statement')">{{ __('Employment statement') }}</a>
        </li>

        <li class="nav-item" v-if="$page.props.userAuth?.subscription?.type == 3">
            <a class="nav-link" id="contract-tab" href="#">{{ __('Job contract') }}</a>
        </li>

        <li class="nav-item" v-if="$page.props.userAuth?.newspaper_type == 2">
            <a class="nav-link" id="license-tab" href="#">{{ __('Newspaper license') }}</a>
        </li>
    </ul>
    <!-- Nav tabs -->
</template>
