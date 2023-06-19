<script></script>
<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item mx-2">
                        <Link :href="route('home')" class="nav-link">{{ __('Home') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('articles.index')" class="nav-link">{{ __('News') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.show', 'about-us')" class="nav-link">{{ __('About us') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.show', 'honor-code')" class="nav-link">{{ __('Honor code') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.show', 'membership')" class="nav-link">{{ __('Membership') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.show', 'regulations')" class="nav-link">{{ __('Regulations') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.show', 'press')" class="nav-link">{{ __('Press in KSA') }}</Link>
                    </li>
                    <li class="nav-item mx-2">
                        <Link href="#" class="nav-link">{{ __('Radio & TV') }}</Link>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <Link href="#" class="nav-link">{{ __('Partnership') }}</Link>
                    </li> -->
                    <li class="nav-item mx-2">
                        <Link :href="route('pages.training-bag')" class="nav-link">{{ __('Training bag') }}</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</template>
