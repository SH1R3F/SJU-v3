<script setup>
import Aside from './Aside.vue';
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';
</script>
<template>
    <Head>
        <title>{{ __('Dashboard') }}</title>
    </Head>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <Aside />
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <Navbar />
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <slot />
                    <!-- / Content -->

                    <!-- Footer -->
                    <Footer />
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
</template>

<!-- Flash messages -->
<script defer>
export default {
    created() {
        if (this.$page.props.flash.message) {
            toastr.success(this.$page.props.flash.message);
        }
    },
    updated() {
        if (this.$page.props.flash.message) {
            toastr.success(this.$page.props.flash.message);
        }
    },
};
</script>
