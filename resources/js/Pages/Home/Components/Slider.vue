<script setup>
const props = defineProps({
    ads: Object,
    articles: Object,
});
</script>
<template>
    <!-- Ads slider -->
    <div id="AdsSlider" class="carousel slide carousel-fade section news-slider" data-mdb-ride="carousel" v-if="ads.data.length">
        <div class="container">
            <div class="carousel-inner">
                <div class="carousel-item slider" v-for="(ad, i) in ads.data" :key="ad.id" :class="{ active: i == 0 }" style="background: transparent">
                    <div class="row">
                        <a :href="ad.link" :target="ad.target">
                            <img :src="ad.path || '/img/article.png'" :alt="ad.title" style="height: auto; max-height: 90vh; object-fit: fill; width: 100%; object-position: center" />
                        </a>
                        <div v-if="!ad.only_image" class="description" style="position: absolute; bottom: 0; left: 0; background: #007c42d6; z-index: 99999; text-align: center">
                            <h3>{{ ad.title }}</h3>
                            <a v-if="ad.link" :href="ad.link" :target="ad.target">{{ __('Details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ads slider -->

    <!-- Articles slider -->
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade section news-slider" data-mdb-ride="carousel" v-if="articles.data.length">
        <div class="container">
            <div class="carousel-inner">
                <div class="carousel-item slider" v-for="(article, i) in articles.data" :key="article.id" :class="{ active: i == 0 }">
                    <div class="row">
                        <div class="col-lg-8 order-lg-last">
                            <img :src="article.image || '/img/article.png'" :alt="article.title" />
                        </div>
                        <div class="col-lg-4 order-lg-first description">
                            <h3>{{ article.title }}</h3>
                            <p>{{ article.summary }}</p>
                            <Link :href="route('articles.show', article.id)">{{ __('Details') }}</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Articles slider -->
</template>
