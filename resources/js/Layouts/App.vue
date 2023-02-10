<script setup>
import Minibar from './Minibar.vue';
import Header from './Header.vue';
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';
import { toast, updateGlobalOptions } from 'vue3-toastify';
import { onUpdated } from 'vue';

const props = defineProps({
    flash: Object,
    locale: String,
});

updateGlobalOptions({
    rtl: props.locale == 'ar',
    position: toast.POSITION.TOP_LEFT,
    theme: 'colored',
    hideProgressBar: true,
    closeButton: false,
});

if (props.flash.message) {
    toast.success(props.flash.message);
}
if (props.flash.error) {
    toast.error(props.flash.error);
}

onUpdated(function () {
    if (props.flash.message) {
        toast.success(props.flash.message);
    }
    if (props.flash.error) {
        toast.error(props.flash.error);
    }
});
</script>

<template>
    <Head>
        <title>{{ __('Home') }}</title>
        <!-- Flash messages -->
        <component is="script" defer v-if="route()?.params?.verified == 1"> this.toastr.success('{{ __('Email has been verified successfully') }}') </component>
        <component is="script" defer v-if="route()?.params?.branch == 0"> this.toastr.error('{{ __('Complete your profile and add your branch') }}') </component>
    </Head>

    <!-- Mini bar -->
    <Minibar />
    <!-- Mini bar -->

    <!-- Header -->
    <Header />
    <!-- Header -->

    <!-- Navbar -->
    <Navbar />
    <!-- Navbar -->
    <slot />

    <!-- Footer -->
    <Footer />
    <!-- Footer -->
</template>
<!-- Flash messages -->
