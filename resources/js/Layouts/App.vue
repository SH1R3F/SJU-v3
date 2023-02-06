<script setup>
import Minibar from './Minibar.vue';
import Header from './Header.vue';
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';
</script>

<template>
    <Head>
        <title>{{ __('Home') }}</title>
        <!-- Flash messages -->
        <component is="script" defer v-if="route()?.params?.verified == 1"> toastr.success('{{ __('Email has been verified successfully') }}') </component>
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
<script defer>
export default {
    updated() {
        if (this.$page.props.flash.message) {
            toastr.success(this.$page.props.flash.message);
        }
        if (this.$page.props.flash.error) {
            toastr.success(this.$page.props.flash.error);
        }
    },
};
</script>
