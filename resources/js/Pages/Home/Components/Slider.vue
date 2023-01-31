<script setup>
const props = defineProps({
    articles: Object,
});
</script>
<template>
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
</template>
