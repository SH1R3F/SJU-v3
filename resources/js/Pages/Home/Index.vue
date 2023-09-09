<script setup>
import Slider from './Components/Slider.vue';
import AboutUs from './Components/AboutUs.vue';
import MediaCenter from './Components/MediaCenter.vue';
import Studio from './Components/Studio.vue';
import RegulationsAndEvents from './Components/RegulationsAndEvents.vue';
import Membership from './Components/Membership.vue';
import Statistics from './Components/Statistics.vue';
import FollowUs from './Components/FollowUs.vue';

const props = defineProps({
    courses: Object,
    articles: Object,
    ads: Object,
    media: Object,
    photos: Object,
    videos: Object,
    locale: String,
    stats: Object,
});
</script>

<template>
    <div class="homepage">
        <!-- News Slid
er -->
        <Slider :articles="articles" :ads="ads" />
        <!-- News Slider -->
        <!-- About the organization -->
        <about-us />
        <!-- About the organization -->

        <!-- Media center -->
        <media-center :articles="articles.data.slice(0, 3)" />
        <!-- Media center -->

        <!-- Studio -->
        <Studio :media="media" :photos="photos" :videos="videos" />
        <!-- Studio -->

        <!-- Regulations and Events -->
        <regulations-and-events :locale="locale" :courses="courses.data" />
        <!-- Regulations and Events -->

        <!-- Membership -->
        <Membership />
        <!-- Membership -->

        <!-- Statistics -->
        <Statistics :stats="stats" />
        <!-- Statistics -->

        <!-- Follow us -->
        <follow-us />
        <!-- Follow us -->

        <!--
        POP UP AD MODAL

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">              
              <div class="modal-body">
                 <img src="https://www7.0zz0.com/2022/09/22/14/810690393.jpg" style="width: 100%;"/>
              </div>
            </div>
          </div>
        </div> 
        -->
    </div>
</template>

<style>
.modal-dialog {
    max-width: 100% !important;
}
</style>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() {},
};
</script>
