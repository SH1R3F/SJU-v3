<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    members: Object,
    branches: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');
const national_id = ref(props.filters.national_id || '');
const membership_number = ref(props.filters.membership_number || '');
const mobile = ref(props.filters.mobile || '');
const type = ref(props.filters.type || '');
const branch = ref(props.filters.branch || '');
const year = ref(props.filters.year || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    national_id: national_id.value,
    membership_number: membership_number.value,
    mobile: mobile.value,
    type: type.value,
    branch: branch.value,
    year: year.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.members.admin-acceptance'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, national_id.value, membership_number.value, mobile.value, type.value, branch.value, year.value, perPage.value],
    ([nameVal, nidVal, memNum, mob, t, b, y, pp]) => {
        appended.value.name = nameVal;
        appended.value.national_id = nidVal;
        appended.value.membership_number = memNum;
        appended.value.mobile = mob;
        appended.value.type = t;
        appended.value.branch = b;
        appended.value.year = y;
        appended.value.perPage = pp;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.members.admin-acceptance'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Members management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ members.fulltime }}</h4>
                                </div>
                                <span>{{ __('Full-time members') }}</span>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ members.parttime }}</h4>
                                </div>
                                <span>{{ __('Part-time members') }}</span>
                            </div>
                            <span class="badge bg-label-success rounded p-2">
                                <i class="ti ti-user-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ members.affiliate }}</h4>
                                </div>
                                <span>{{ __('Affiliate members') }}</span>
                            </div>
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="ti ti-user-exclamation ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Members waiting admin approval') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-12 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('National ID number')" v-model="national_id" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Membership number')" v-model="membership_number" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Mobile')" v-model="mobile" />
                    </div>
                    <div class="col-md-4 mb-2">
                        <select class="form-select text-capitalize" v-model="type">
                            <option value="">{{ __('Membership type') }}</option>
                            <option value="1">{{ __('Full-time member') }}</option>
                            <option value="2">{{ __('Part-time member') }}</option>
                            <option value="3">{{ __('Affiliate member') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <select class="form-select text-capitalize" v-model="branch">
                            <option value="">{{ __('Membership branch') }}</option>
                            <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Year')" v-model="year" />
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
                                    v-if="members.can_export"
                                    :href="route('admin.members.export', { page: 'admin-acceptance', ...queryParams() })"
                                    class="dt-button buttons-collection btn btn-label-secondary me-1"
                                    type="button"
                                >
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('Excel') }}
                                    </span>
                                </a>
                                <a
                                    v-if="members.can_export"
                                    :href="route('admin.members.export.pdf', { page: 'admin-acceptance', ...queryParams() })"
                                    class="dt-button buttons-collection btn btn-label-secondary me-1"
                                    type="button"
                                >
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('PDF') }}
                                    </span>
                                </a>
                                <Link v-if="members.can_create" :href="route('admin.members.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create member') }}</span>
                                    </span>
                                </Link>
                                <Link v-if="members.can_notify" :href="route('admin.members.notify')" type="button" class="dt-button btn btn-light me-1">
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
                            <th @click.prevent="sortBy('membership_number')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'membership_number' }">{{ __('Membership number') }}</th>
                            <th @click.prevent="sortBy('mobile')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'mobile' }">{{ __('Mobile') }}</th>
                            <th @click.prevent="sortBy('type')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'type' }">{{ __('Membership type') }}</th>
                            <th @click.prevent="sortBy('branch_id')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'branch_id' }">{{ __('Branch') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Membership Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in members.data" :key="member.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="member.profile_photo || '/img/user-dark.png'" onerror="this.src = '/img/user-dark.png';" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.members.show', member.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ member.fullName }}</span>
                                        </Link>
                                        <small class="text-muted">{{ member.national_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ member.membership_number }}
                            </td>
                            <td dir="ltr">
                                {{ member.phone_number }}
                            </td>
                            <td>
                                {{ member.subscription?.type }}
                            </td>
                            <td>
                                {{ member.branch.name }}
                            </td>
                            <td>
                                {{ member.membership_status }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Accept -->
                                    <Link
                                        v-if="member.acceptable"
                                        :href="route('admin.members.accept', member.id)"
                                        method="post"
                                        data-bs-placement="top"
                                        :title="__('Accept')"
                                        preserve-scroll
                                        as="span"
                                        class="text-body cursor-pointer"
                                    >
                                        <i class="ti ti-check ti-sm me-2"></i>
                                    </Link>
                                    <Link v-if="member.viewable" :href="route('admin.members.show', member.id)" class="text-body"><i class="ti ti-eye ti-sm me-2"></i></Link>
                                    <Link v-if="member.editable" :href="route('admin.members.edit', member.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link v-if="member.deleteable" :href="route('admin.members.destroy', member.id)" preserve-scroll as="span" method="delete" class="text-body cursor-pointer">
                                        <i class="ti ti-trash ti-sm me-2"></i>
                                    </Link>
                                    <!-- Disapprove -->
                                    <Link
                                        v-if="member.disapproveable"
                                        :href="route('admin.members.disapprove', member.id)"
                                        method="post"
                                        data-bs-placement="top"
                                        :title="__('Disapprove')"
                                        preserve-scroll
                                        as="span"
                                        class="text-body cursor-pointer"
                                    >
                                        <i class="ti ti-x ti-sm me-2"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="members.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
