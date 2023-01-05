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
        <component is="script" defer v-if="$page.props.flash.message"> toastr.success('{{ $page.props.flash.message }}') </component>
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
