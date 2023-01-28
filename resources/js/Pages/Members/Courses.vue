<script setup>
import Sidebar from './Sidebar.vue';

const props = defineProps({
    userAuth: Object,
    upcoming: Object,
    registered: Object,
});
</script>

<template>
    <Head :title="__('Courses')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <!-- New courses -->
                    <div class="page-content account events text-start">
                        <h5>{{ __('Upcoming courses') }}</h5>

                        <table class="table table-hover mycustom-table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Course title') }}</th>
                                    <th>{{ __('Course date') }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(course, i) in upcoming.data" :key="i">
                                    <td>{{ i + 1 }}</td>

                                    <td>
                                        <Link :href="route('courses.register', course.id)" class="title">
                                            {{ course.title }}
                                        </Link>
                                    </td>

                                    <td>{{ course.date_from }}</td>

                                    <td>
                                        <a v-if="new Date(course.date_from) >= new Date() && course.zoom" :href="course.zoom" target="_blank" class="mb-2" data-toggle="tooltip" data-placement="top">
                                            <img src="/img/zoom-icon.png" style="height: 18px" />
                                        </a>
                                        <a v-else class="mb-2" data-toggle="tooltip" data-placement="top"><i class="fa fa-sync"></i></a>

                                        <a
                                            v-if="new Date(course.date_from) >= new Date() && course.youtube"
                                            :href="course.youtube"
                                            target="_blank"
                                            class="mb-2"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                        >
                                            <img src="/img/youtube-icon.png" style="height: 18px" />
                                        </a>
                                    </td>

                                    <td>
                                        <Link v-if="course.status == 1" :href="route('courses.register', course.id)" class="btn btn-sm btn-success">{{ __('Register for the course') }}</Link>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary badge-lg h3 mb-2"> {{ course.state }}</span>
                                    </td>
                                </tr>

                                <tr v-if="!upcoming.data.length">
                                    <td colspan="10">{{ __('There are no events...') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- New courses -->

                    <!-- Registered courses -->

                    <div class="page-content account events text-start mt-5">
                        <h5>{{ __('Registered courses') }}</h5>

                        <table class="table table-hover mycustom-table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Course title') }}</th>
                                    <th>{{ __('Course date') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(course, i) in registered.data" :key="i">
                                    <td>{{ i + 1 }}</td>

                                    <td>
                                        <Link :href="route('courses.register', course.id)" class="title">
                                            {{ course.title }}
                                        </Link>
                                    </td>

                                    <td>{{ course.date_from }}</td>

                                    <td>
                                        <a v-if="new Date(course.date_from) >= new Date() && course.zoom" :href="course.zoom" target="_blank" class="mb-2" data-toggle="tooltip" data-placement="top">
                                            <img src="/img/zoom-icon.png" style="height: 18px" />
                                        </a>
                                        <a v-else class="mb-2" data-toggle="tooltip" data-placement="top"><i class="fa fa-sync"></i></a>

                                        <a
                                            v-if="new Date(course.date_from) >= new Date() && course.youtube"
                                            :href="course.youtube"
                                            target="_blank"
                                            class="mb-2"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                        >
                                            <img src="/img/youtube-icon.png" style="height: 18px" />
                                        </a>
                                    </td>

                                    <td>
                                        <a
                                            v-if="course.pivot?.attendance && course.template_id"
                                            :href="route('courses.certificate', course.id)"
                                            class="mb-2"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            :title="__('Certificate')"
                                            :data-original-title="__('Certificate')"
                                        >
                                            <i class="fa fa-address-card" style="color: green"></i>
                                        </a>

                                        <Link v-else class="mb-2" style="cursor: default" data-toggle="tooltip" data-placement="top" :data-original-title="__('Didn\'t attend course')">
                                            <i class="fa fa-user-times" style="color: orange"></i>
                                        </Link>
                                    </td>
                                </tr>

                                <tr v-if="!registered.data.length">
                                    <td colspan="10">{{ __('There are no events...') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Registered courses -->
                </div>
            </div>
        </div>
    </div>
</template>
