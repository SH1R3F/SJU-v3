<script setup>
defineProps({
    active: String,
});
</script>

<template>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: active === 'nid' }" id="nid-tab" :href="route('member.register')">
                <span class="badge badge-secondary rounded-circle" :class="{ 'badge-success': ['contact', 'types', 'info', 'login', 'review'].includes(active) }">1</span>
                {{ __('Registration') }}
            </Link>
        </li>

        <li class="nav-item">
            <Link class="nav-link" :class="{ active: active === 'contact' }" id="contact-tab" :href="route('member.register.step2')">
                <span class="badge badge-secondary rounded-circle" :class="{ 'badge-success': ['types', 'info', 'login', 'review'].includes(active) }">2</span>
                {{ __('Contact info') }}
            </Link>
        </li>

        <li class="nav-item">
            <Link class="nav-link" :class="{ active: active === 'types' }" id="types-tab" :href="route('member.register.step3')">
                <span class="badge badge-secondary rounded-circle" :class="{ 'badge-success': ['info', 'login', 'review'].includes(active) }">3</span>
                {{ __('Membership types') }}
            </Link>
        </li>

        <li class="nav-item">
            <Link class="nav-link" :class="{ active: active === 'info' }" id="info-tab" :href="route('member.register.step4')">
                <span class="badge badge-secondary rounded-circle" :class="{ 'badge-success': ['login', 'review'].includes(active) }">4</span>
                {{ __('Member info') }}
            </Link>
        </li>

        <li class="nav-item">
            <Link class="nav-link" :class="{ active: active === 'login' }" id="login-tab" :href="route('member.register.step5')">
                <span class="badge badge-secondary rounded-circle" :class="{ 'badge-success': active == 'review' }">5</span>
                {{ __('Login info') }}
            </Link>
        </li>

        <li class="nav-item">
            <a class="nav-link" :class="{ active: active === 'review' }" id="review-tab" :href="route('member.register.step6')">
                <span class="badge badge-secondary rounded-circle">6</span>
                {{ __('Review') }}
            </a>
        </li>
    </ul>
</template>
