<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    courses: Object,
    filters: Object,
    branches: Object,
    authUser: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const title = ref(props.filters.title || '');
const course_number = ref(props.filters.course_number || '');
const year = ref(props.filters.year || '');
const month = ref(props.filters.month || '');
const branch = ref(props.filters.branch || '');

const appended = ref({
    perPage: perPage.value,
    title: title.value,
    course_number: course_number.value,
    year: year.value,
    month: month.value,
    branch: branch.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.courses.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [title.value, course_number.value, year.value, month.value, branch.value, perPage.value],
    ([title, course_number, year, month, branch, perPage]) => {
        appended.value.title = title;
        appended.value.course_number = course_number;
        appended.value.year = year;
        appended.value.month = month;
        appended.value.branch = branch;
        appended.value.perPage = perPage;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.courses.index'), appended.value, { preserveState: true, replace: true });
};

const copy = (text, msg) => {
    navigator.clipboard.writeText(text);
    toastr.success(msg);
}
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
                    <div class="col-md-6 mb-2" :class="{ 'col-md-12': authUser.data.branch_id }">
                        <input type="text" class="form-control" :placeholder="__('Course title')" v-model="title" />
                    </div>
                    <div class="col-md-6 mb-2" v-if="!authUser.data.branch_id">
                        <select class="form-control" v-model="branch">
                            <option value="">{{ __('Branch') }}</option>
                            <option v-for="branch in branches" :value="branch.id">{{ branch.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Course number')"
                            v-model="course_number" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="`${__('Course date')} (${__('Year')})`"
                            v-model="year" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="`${__('Course date')} (${__('Month')})`"
                            v-model="month" />
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
                        <div
                            class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <a v-if="courses.can_export" :href="route('admin.courses.export', { ...queryParams() })" type="button"
                                    class="dt-button add-new btn btn-label-secondary me-1">
                                    <span>
                                        <i class="ti ti-screen-share me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Export') }}</span>
                                    </span>
                                </a>
                                <Link v-if="courses.can_create" :href="route('admin.courses.create')" type="button"
                                    class="dt-button add-new btn btn-primary me-1">
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
                            <th @click.prevent="sortBy('title')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'title' }">{{ __('Course') }}</th>
                            <th @click.prevent="sortBy('date_from')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'date_from' }" style="white-space: nowrap">
                                {{ __('Course date') }}
                            </th>
                            <th @click.prevent="sortBy('course_type_id')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'course_type_id' }" style="white-space: nowrap">
                                {{ __('Type') }}
                            </th>
                            <th @click.prevent="sortBy('course_category_id')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'course_category_id' }">{{ __('Category') }}</th>
                            <th @click.prevent="sortBy('course_gender_id')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'course_gender_id' }">{{ __('Gender') }}</th>
                            <th @click.prevent="sortBy('course_branch_id')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'course_branch_id' }">{{ __('Branch') }}</th>
                            <th @click.prevent="sortBy('region')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'region' }">{{ __('Region') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer"
                                :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="course in courses.data">
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="course.image || '/img/course.png'"
                                                onerror="this.src = '/img/course.png';" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.courses.show', course.id)"
                                            style="max-width: 250px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis"
                                            class="text-body text-truncate">
                                        <span class="fw-semibold">{{ course.title }}</span>
                                        </Link>
                                        <small class="text-truncate text-muted">{{ course.course_number }}</small>
                                    </div>
                                </div>
                            </td>
                            <td style="white-space: nowrap">
                                {{ course.date_from }}
                            </td>
                            <td style="white-space: nowrap">{{ course.course_type }}</td>
                            <td>{{ course.course_category }}</td>
                            <td>{{ course.course_gender }}</td>
                            <td>{{ course.course_branch }}</td>
                            <td>{{ course.region }}</td>
                            <td>{{ course.state }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="#"
                                        @click.prevent="copy(route('courses.register', course.id), __('Url copied'))"
                                        class="text-body" data-bs-placement="top" :aria-label="__('Copy course link')"
                                        :title="__('Copy course link')">
                                        <i class="ti ti-copy mx-2 ti-sm"></i>
                                    </a>
                                    <Link v-if="course.questionable" :href="route('admin.courses.results', course.id)"
                                        class="text-body" data-bs-placement="top" :aria-label="__('Questionnaire results')"
                                        :title="__('Questionnaire results')">
                                    <i class="ti ti-friends mx-2 ti-sm"></i>
                                    </Link>
                                    <Link v-if="course.viewable" :href="route('admin.courses.show', course.id)"
                                        class="text-body" data-bs-placement="top" :aria-label="__('Show')"
                                        :title="__('Show')">
                                    <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                    <Link v-if="course.editable" :href="route('admin.courses.edit', course.id)"
                                        class="text-body" data-bs-placement="top" :aria-label="__('Edit')"
                                        :title="__('Edit')">
                                    <i class="ti ti-edit mx-2 ti-sm"></i>
                                    </Link>
                                    <Link v-if="course.toggleable" :href="route('admin.courses.toggle', course.id)"
                                        method="post" as="span" preserve-scroll class="cursor-pointer"
                                        data-bs-placement="top" :title="course.status == 2 ? __('Disabled') : ''"
                                        :class="{ 'text-success': course.status == 1, 'text-body': course.status != 1 }">
                                    <i class="ti ti-sm me-2"
                                        :class="{ 'ti-toggle-right': course.status == 1, 'ti-toggle-left': course.status != 1 }"></i>
                                    </Link>
                                    <Link v-if="course.deleteable" :href="route('admin.courses.destroy', course.id)"
                                        method="DELETE" as="span" class="text-body" data-bs-placement="top"
                                        :aria-label="__('Delete')" :title="__('Delete')">
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
