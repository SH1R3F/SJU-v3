<script setup>
import Pagination from '../Components/Pagination.vue';
const props = defineProps({
    bags: Object,
    locale: String,
});
</script>

<template>
    <Head :title="__('Training bag')" />
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

                <h3>{{ __('Training bag') }}</h3>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <template v-if="bags.data.length">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-4" v-for="bag in bags.data" :key="bag.id">

                                    <div class="card text-center h-100">
                                        <div class="card-body">
                                            <Link :href="bag.path" as="h5" style="height: 50px" class="card-title">{{
                                                bag.name }}</Link>
                                            <a :href="bag.path" class="btn btn-success btn-sm mt-2 ripple-surface">
                                                {{ __('View') }}
                                            </a>
                                        </div>
                                        <p class="card-text mb-2">
                                            <small class="text-muted">{{ arabic_date(bag.created_at) }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Pagination :meta="bags.meta" />
                </template>

                <div class="text-start" style="min-height: 400px" v-if="!bags.data.length">
                    <p class="alert alert-info lead">{{ __('No records found...') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() { },
};
</script>
