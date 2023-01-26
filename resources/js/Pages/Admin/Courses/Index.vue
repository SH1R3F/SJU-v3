<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    courses: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const title = ref(props.filters.title || '');
const course_number = ref(props.filters.course_number || '');
const year = ref(props.filters.year || '');
const month = ref(props.filters.month || '');
const region = ref(props.filters.region || '');

const appended = ref({
    perPage: perPage.value,
    title: title.value,
    course_number: course_number.value,
    year: year.value,
    month: month.value,
    region: region.value,
});

const filterReq = debounce(() => Inertia.get(route('admin.courses.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [title.value, course_number.value, year.value, month.value, region.value, perPage.value],
    ([title, course_number, year, month, region, perPage]) => {
        appended.value.title = title;
        appended.value.course_number = course_number;
        appended.value.year = year;
        appended.value.month = month;
        appended.value.region = region;
        appended.value.perPage = perPage;
        filterReq();
    }
);
</script>

<template>
    <Head :title="__('Courses')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Courses') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Course title')" v-model="title" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Region')" v-model="region" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Course number')" v-model="course_number" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="`${__('Course date')} (${__('Year')})`" v-model="year" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="`${__('Course date')} (${__('Month')})`" v-model="month" />
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <div class="row me-2 py-3 text-center">
                    <div class="col-md-2 mb-1">
                        <div class="me-3">
                            <div class="dataTables_length">
                                <label>
                                    <select class="form-select" v-model="perPage">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="courses.can_create" :href="route('admin.courses.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create course') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th class="cell-fit">{{ __('Course') }}</th>
                            <th>{{ __('Course date') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Gender') }}</th>
                            <th>{{ __('Location') }}</th>
                            <th>{{ __('Region') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="course in courses.data">
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="course.image || '/img/course.png'" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.courses.show', 1)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ course.title }}</span>
                                        </Link>
                                        <small class="text-truncate text-muted">{{ course.course_number }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ course.date_from }}</td>
                            <td>{{ course.type }}</td>
                            <td>{{ course.category }}</td>
                            <td>{{ course.gender }}</td>
                            <td>{{ course.location }}</td>
                            <td>{{ course.region }}</td>
                            <td>{{ course.status }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="ticket.viewable"
                                        :href="route('admin.courses.show', ticket.id)"
                                        class="text-body"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        :aria-label="__('Show')"
                                        :data-bs-original-title="__('Show')"
                                    >
                                        <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="ticket.editable"
                                        :href="route('admin.courses.edit', ticket.id)"
                                        class="text-body"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        :aria-label="__('Edit')"
                                        :data-bs-original-title="__('Edit')"
                                    >
                                        <i class="ti ti-edit mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="course.toggleable"
                                        :href="route('admin.courses.toggle', course.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        data-bs-toggle="tooltip"
                                        :data-bs-original-title="course.status == 2 ? __('Disabled') : ''"
                                        :class="{ 'text-success': course.status == 1, 'text-body': course.status == 2 }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': course.status == 1, 'ti-toggle-left': course.status == 2 }"></i>
                                    </Link>
                                    <Link
                                        v-if="ticket.deleteable"
                                        :href="route('admin.courses.destroy', ticket.id)"
                                        method="DELETE"
                                        as="span"
                                        data-bs-toggle="tooltip"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Delete')"
                                        :data-bs-original-title="__('Delete')"
                                    >
                                        <i class="ti ti-trash mx-2 ti-sm cursor-pointer"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="courses.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
