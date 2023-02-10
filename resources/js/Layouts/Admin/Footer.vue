<script></script>
<template>
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
            <div class="footer-container d-flex align-items-center justify-content-end py-1 flex-md-row flex-column">
                <div>
                    {{ __('All rights reserved') }}
                    <a class="text text-link" :href="route('home')">
                        {{ __('Saudi Journalists association') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>
