<script setup>
import Studio from '../Components/Studio.vue';

defineProps({
    media: Object,
    photos: Object,
    videos: Object,
});
</script>

<template>
    <Head :title="__('Studio')" />
    <div class="sjupage allnews">
        <div class="section page-header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('home')">{{ __('Home') }}</Link>
                        </li>
                    </ul>
                </nav>

                <h3>{{ __('Studio') }}</h3>
            </div>
        </div>

        <!-- Studio -->
        <Studio :media="media" :photos="photos" :videos="videos" />
        <!-- Studio -->
        </div>
</template>


<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() { },
};
</script>
