<script setup>
defineProps({
    articles: Object,
});
</script>
<template>
    <div class="section media-center">
        <div class="container">
            <div class="row">
                <h2 class="col-10">{{ __('Media center') }}</h2>
                <Link :href="route('articles.index')" class="col-2 text-end">{{ __('More') }}</Link>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 mb-3" v-for="article in articles">
                    <div class="post" :style="`background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('${article.image || '/img/article.png'}')`">
                        <div class="category">
                            <Link :href="route('articles.index', article.category.id)">
                                {{ article.category.title }}
                            </Link>
                        </div>
                        <div class="desc">
                            <Link as="h5" :href="route('articles.show', article.id)">{{ article.title }}</Link>
                            <span>{{ arabic_date(article.news_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
