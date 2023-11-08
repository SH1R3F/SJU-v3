<script setup>
import Pagination from '../Components/Pagination.vue';

const props = defineProps({
    courses: Object,
    locale: String,
});
</script>

<template>
    <Head :title="__('Courses')" />
    <div class="sjupage eventspage">
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
                <h3>{{ __('Courses menu') }}</h3>
            </div>
        </div>
        <!-- News Header -->

        <!-- News Content -->
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <!-- Navigation -->

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <Link
                                :href="route('courses.index', 'upcoming')"
                                class="nav-link"
                                :class="{ active: courses.status === 'upcoming' }"
                                data-bs-toggle="tab"
                                type="button"
                                role="tab"
                                aria-selected="true"
                            >
                                {{ __('Upcoming courses') }}
                            </Link>

                            <Link
                                :href="route('courses.index', 'recent')"
                                class="nav-link"
                                :class="{ active: courses.status === 'recent' }"
                                data-bs-toggle="tab"
                                type="button"
                                role="tab"
                                aria-selected="true"
                            >
                                {{ __('Recent courses') }}
                            </Link>
                        </div>
                    </nav>
                    <!-- Navigation -->

                    <!-- Tab content -->
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <!-- Single Course -->
                                <div class="col-sm-6 col-md-4 event" v-for="course in courses.data">
                                    <div class="date"
                                    :style="`background: ${course.image  ? 'url(' + course.image + ')' : '#007c42'}`"
                                    :src="course.image || '' "
                                    >
                                    </div>

                                    <h6 class="title">
                                        <Link :href="route('courses.register', course.id)">
                                            {{ course.title }}
                                        </Link>
                                        <span>
                                            {{ new Date(course.date_from).getDate() }}
                                            {{ new Date(course.date_from).toLocaleString(locale == 'ar' ? 'ar-EG' : 'default', { month: 'long' }) }}
                                        </span>
                                    </h6>
                                </div>
                                <!-- Single Course -->
                            </div>
                        </div>
                    </div>
                    <!-- Tab content -->

                    <!-- Pagination -->
                    <Pagination :meta="courses.meta" v-if="courses.data.length" />
                    <!-- Pagination -->

                    <div class="text-start" style="min-height: 400px" v-if="!courses.data.length">
                        <p class="alert alert-info lead">{{ __('There are no events...') }}</p>
                    </div>
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
