<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    volunteers: Object,
    filters: Object,
    status: String,
    branches: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');
const national_id = ref(props.filters.national_id || '');
const mobile = ref(props.filters.mobile || '');
const branch = ref(props.filters.branch || '');
const field = ref(props.filters.field || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    national_id: national_id.value,
    mobile: mobile.value,
    branch: branch.value,
    field: field.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.volunteers.index', props.status), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, national_id.value, mobile.value, branch.value, field.value, perPage.value],
    ([name, national_id, mobile, branch, field, pp]) => {
        appended.value.name = name;
        appended.value.national_id = national_id;
        appended.value.mobile = mobile;
        appended.value.branch = branch;
        appended.value.field = field;
        appended.value.perPage = pp;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.volunteers.index', props.status), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Volunteers management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Active volunteers') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="number" class="form-control" :placeholder="__('National ID')" v-model="national_id" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Mobile')" v-model="mobile" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <select class="form-control" v-model="branch">
                            <option value="">{{ __('Branch') }}</option>
                            <option v-for="branch in branches" :value="branch.id">{{ branch.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <select class="form-control" v-model="field">
                            <option value="">{{ __('Volunteering fields') }}</option>
                            <option value="التصوير الفوتوغرافي">{{ __('Photography') }}</option>
                            <option value="تصوير الفيديو">{{ __('Videography') }}</option>
                            <option value="التصوير السينمائي">{{ __('Cinematography') }}</option>
                            <option value="التحرير - المنصات الإعلامية -التوثيق">{{ __('Editing - media platforms - documentation') }}</option>
                            <option value="التغطيات">{{ __('Coverages') }}</option>
                            <option value="التقديم">{{ __('Presentation') }}</option>
                            <option value="صناعة المحتوى الرقمي">{{ __('Digital content industry') }}</option>
                            <option value="المونتاج">{{ __('Montage') }}</option>
                            <option value="السوشل ميديا">{{ __('Social media') }}</option>
                            <option value="التسويق الاعلامي">{{ __('Media marketing') }}</option>
                            <option value="إدارة التحرير">{{ __('Editorial management') }}</option>
                            <option value="قيادة التحرير الميداني">{{ __('Field Editing Command') }}</option>
                            <option value="إدارة الملتقيات والندوات">{{ __('Management of meetings and seminars') }}</option>
                            <option value="التدريب الاعلامي">{{ __('Media training') }}</option>
                        </select>
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
                                <a
                                    v-if="volunteers.can_export"
                                    :href="route('admin.volunteers.export', { status: status, ...queryParams() })"
                                    class="dt-button buttons-collection btn btn-label-secondary me-1"
                                    type="button"
                                >
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('Export') }}
                                    </span>
                                </a>
                                <Link v-if="volunteers.can_create" :href="route('admin.volunteers.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create volunteer') }}</span>
                                    </span>
                                </Link>
                                <Link v-if="volunteers.can_notify" :href="route('admin.volunteers.notify')" type="button" class="dt-button btn btn-light me-1">
                                    <span>
                                        <i class="ti ti-bell-ringing me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Notify') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('name')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'name' }">{{ __('User') }}</th>
                            <th @click.prevent="sortBy('email')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'email' }">{{ __('Email') }}</th>
                            <th @click.prevent="sortBy('mobile')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'mobile' }">{{ __('Mobile') }}</th>
                            <th @click.prevent="sortBy('courses')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'courses' }">{{ __('Courses') }}</th>
                            <th @click.prevent="sortBy('branch_id')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'branch_id' }">{{ __('Branch') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="volunteer in volunteers.data" :key="volunteer.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="volunteer.profile_photo || '/img/user-dark.png'" alt="Avatar" onerror="this.src = '/img/user-dark.png';" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.volunteers.show', volunteer.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ volunteer.fullName }}</span>
                                        </Link>
                                        <small class="text-muted">{{ volunteer.country }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ volunteer.email }}
                            </td>
                            <td dir="ltr">
                                {{ volunteer.phone_number }}
                            </td>
                            <td>
                                {{ volunteer.courses_count }}
                            </td>
                            <td>
                                {{ volunteer.branch_name }}
                            </td>
                            <td>
                                {{ volunteer.state }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="volunteer.toggleable"
                                        :href="route('admin.volunteers.toggle', volunteer.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        :title="volunteer.status == 1 ? __('Enabled') : __('Disabled')"
                                        :class="{ 'text-success': volunteer.status == 1, 'text-body': volunteer.status != 1 }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': volunteer.status == 1, 'ti-toggle-left': volunteer.status != 1 }"></i>
                                    </Link>
                                    <Link v-if="volunteer.viewable" :href="route('admin.volunteers.show', volunteer.id)" class="text-body"><i class="ti ti-eye ti-sm me-2"></i></Link>
                                    <Link v-if="volunteer.editable" :href="route('admin.volunteers.edit', volunteer.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link
                                        v-if="volunteer.deleteable"
                                        :href="route('admin.volunteers.destroy', volunteer.id)"
                                        preserve-scroll
                                        as="span"
                                        method="delete"
                                        class="text-body cursor-pointer"
                                    >
                                        <i class="ti ti-trash ti-sm me-2"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="volunteers.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
