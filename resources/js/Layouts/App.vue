<script setup>
import Minibar from './Minibar.vue';
import Header from './Header.vue';
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';

const props = defineProps({
    flash: Object,
});
if (props.flash.message) {
    this.toastr.success(this.$page.props.flash.message);
}
if (props.flash.error) {
    this.toastr.error(this.$page.props.flash.error);
}
console.log(props);
</script>

<template>
    <Head>
        <title>{{ __('Home') }}</title>
        <!-- Flash messages -->
        <component is="script" defer v-if="route()?.params?.verified == 1"> this.toastr.success('{{ __('Email has been verified successfully') }}') </component>
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
