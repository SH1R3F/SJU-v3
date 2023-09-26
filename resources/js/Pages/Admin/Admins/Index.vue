<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';

const props = defineProps({
    admins: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const search = ref(props.filters.search);
const role = ref(props.filters.role || '');
const branch = ref(props.filters.branch || '');

watch(perPage, (val) => {
    Inertia.get(
        route('admin.admins.index'),
        { perPage: val, search: search.value, role: role.value, branch: branch.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});
watch(search, (val) => {
    Inertia.get(
        route('admin.admins.index'),
        { search: val, perPage: perPage.value, role: role.value, branch: branch.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});
watch(role, (val) => {
    Inertia.get(
        route('admin.admins.index'),
        { role: val, perPage: perPage.value, search: search.value, branch: branch.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});
watch(branch, (val) => {
    Inertia.get(
        route('admin.admins.index'),
        { branch: val, role: role.value, perPage: perPage.value, search: search.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});

const sortBy = (column) => {
    Inertia.get(
        route('admin.admins.index'),
        { order: column, dir: props.filters.dir == 'desc' ? 'asc' : 'desc', branch: branch.value, role: role.value, perPage: perPage.value, search: search.value },
        { preserveState: true, replace: true }
    );
};
</script>

<template>
    <Head :title="__('Moderators management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>{{ __('Site admin') }}</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ admins.roles[0].users_count }}</h4>
                                </div>
                                <span>{{ __('Total Users') }}</span>
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
                                <span>{{ __('Branch manager') }}</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ admins.roles[1].users_count }}</h4>
                                </div>
                                <span>{{ __('Total Users') }}</span>
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
                                <span>{{ __('News editor') }}</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ admins.roles[2].users_count }}</h4>
                                </div>
                                <span>{{ __('Total Users') }}</span>
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
                <h5 class="card-title mb-3">{{ __('Moderators management') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 user_role">
                        <select id="UserRole" class="form-select text-capitalize" v-model="role">
                            <option value="">{{ __('Select role') }}</option>
                            <option v-for="role in admins.roles" :value="role.id">{{ __(role.name) }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 user_plan">
                        <select id="UserBranch" class="form-select text-capitalize" v-model="branch">
                            <option value="">{{ __('Select branch') }}</option>
                            <option v-for="branch in admins.branches" :value="branch.id">{{ __(branch.name) }}</option>
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
                            <div class="dataTables_filter">
                                <label>
                                    <input type="search" class="form-control" :placeholder="__('Search...')" v-model="search" />
                                </label>
                            </div>
                            <div class="dt-buttons">
                                <a :href="route('admin.admins.export')" target="_blank" class="dt-button buttons-collection btn btn-label-secondary me-1" type="button">
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('Export') }}
                                    </span>
                                </a>
                                <Link v-if="admins.can_create" :href="route('admin.admins.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create moderator') }}</span>
                                    </span>
                                </Link>
                                <Link v-if="admins.can_notify" :href="route('admin.admins.notify')" type="button" class="dt-button btn btn-light me-1">
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
                            <th @click.prevent="sortBy('username')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'username' }">{{ __('Username') }}</th>
                            <th @click.prevent="sortBy('mobile')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'mobile' }">{{ __('Mobile') }}</th>
                            <th @click.prevent="sortBy('role')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'role' }">{{ __('Role') }}</th>
                            <th @click.prevent="sortBy('branch_id')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'branch_id' }">{{ __('Branch') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="admin in admins.data" :key="admin.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img src="/img/admin.png" alt="Avatar" class="rounded-circle" /></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-body text-truncate"
                                            ><span class="fw-semibold">{{ admin.fullName }}</span></a
                                        ><small class="text-muted">{{ admin.email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ admin.username }}</span>
                            </td>
                            <td>
                                {{ admin.mobile }}
                            </td>
                            <td>
                                {{ __(admin.role) }}
                            </td>
                            <td>
                                {{ __(admin.branch?.name) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="admin.toggleable"
                                        :href="route('admin.admins.toggle', admin.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        :title="admin.active ? __('Enabled') : __('Disabled')"
                                        :class="{ 'text-success': admin.active, 'text-body': !admin.active }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': admin.active, 'ti-toggle-left': !admin.active }"></i>
                                    </Link>
                                    <Link v-if="admin.editable" :href="route('admin.admins.edit', admin.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link
                                        v-if="admin.deleteable"
                                        :href="route('admin.admins.destroy', admin.id)"
                                        preserve-scroll
                                        as="span"
                                        method="delete"
                                        class="text-body delete-record cursor-pointer"
                                    >
                                        <i class="ti ti-trash ti-sm mx-2"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="admins.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
