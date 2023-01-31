<script setup>
import Pagination from '../Components/Pagination.vue';
const props = defineProps({
    categories: Object,
    category_id: String,
    articles: Object,
    locale: String,
});
</script>

<template>
    <Head :title="__('Articles')" />
    <div class="sjupage allnews">
        <!-- News Header -->
        <div class="section page-header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('home')">{{ __('Home') }}</Link>
                        </li>
                    </ul>
                </nav>

                <h3>{{ __('News menu') }}</h3>
            </div>
        </div>
        <!-- News Header -->

        <!-- News Content -->

        <div class="page-content">
            <div class="container">
                <!-- Navigation -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <Link :href="route('articles.index')" class="nav-link" :class="{ active: category_id == 0 }" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">
                            {{ __('All') }}
                        </Link>

                        <Link
                            v-for="category in categories.data"
                            :key="category.id"
                            :href="route('articles.index', category.id)"
                            class="nav-link"
                            :class="{ active: category_id == category.id }"
                            data-bs-toggle="tab"
                            type="button"
                            role="tab"
                            aria-selected="false"
                        >
                            {{ category.title }}
                        </Link>
                    </div>
                </nav>
                <!-- Navigation -->

                <template v-if="articles.data.length">
                    <!-- Tab content -->
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-4" v-for="article in articles.data" :key="article.id">
                                    <!-- Single post -->
                                    <div class="post" :style="`background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('${article.image || '/img/article.png'}')`">
                                        <div class="category">
                                            <Link :href="route('articles.index', article.category.id)">
                                                {{ article.category.title }}
                                            </Link>
                                        </div>

                                        <div class="desc">
                                            <Link :href="route('articles.show', article.id)" class="h5 text-light d-block">
                                                {{ article.title }}
                                            </Link>

                                            <span>
                                                {{ arabic_date(article.news_date) }}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single post -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab content -->

                    <!-- Pagination -->
                    <Pagination :meta="articles.meta" />
                    <!-- Pagination -->
                </template>

                <div class="text-start" style="min-height: 400px" v-if="!articles.data.length">
                    <p class="alert alert-info lead">{{ __('No news found...') }}</p>
                </div>
            </div>
        </div>
        <!-- News Content -->
    </div>
</template>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() {},
};
</script>
