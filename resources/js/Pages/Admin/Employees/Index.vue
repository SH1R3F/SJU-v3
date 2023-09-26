<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';

const props = defineProps({
    employees: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const search = ref(props.filters.search);
const branch = ref(props.filters.branch || '');

watch(perPage, (val) => {
    Inertia.get(
        route('admin.employees.index'),
        { perPage: val, search: search.value, branch: branch.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});
watch(search, (val) => {
    Inertia.get(
        route('admin.employees.index'),
        { search: val, perPage: perPage.value, branch: branch.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});
watch(branch, (val) => {
    Inertia.get(
        route('admin.employees.index'),
        { branch: val, perPage: perPage.value, search: search.value, order: props.filters.order, dir: props.filters.dir },
        { preserveState: true, replace: true }
    );
});

const sortBy = (column) => {
    Inertia.get(
        route('admin.employees.index'),
        { order: column, dir: props.filters.dir == 'desc' ? 'asc' : 'desc', branch: branch.value, perPage: perPage.value, search: search.value },
        { preserveState: true, replace: true }
    );
};
</script>

<template>
    <Head :title="__('Employees management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Employees management') }}</h5>
                <div v-if="$page.props.authUser.data.role === 'Site admin'" class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-12 user_plan">
                        <select id="UserBranch" class="form-select text-capitalize" v-model="branch">
                            <option value="">{{ __('Select branch') }}</option>
                            <option v-for="branch in employees.branches" :value="branch.id">{{ __(branch.name) }}</option>
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
                                <Link v-if="employees.can_create" :href="route('admin.employees.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create employee') }}</span>
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
                            <th v-if="$page.props.authUser.data.role === 'Site admin'" @click.prevent="sortBy('branch_id')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'branch_id' }">{{ __('Branch') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees.data" :key="employee.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img src="/img/admin.png" alt="Avatar" class="rounded-circle" /></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="app-user-view-account.html" class="text-body text-truncate"
                                            ><span class="fw-semibold">{{ employee.fullName }}</span></a
                                        ><small class="text-muted">{{ employee.email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ employee.username }}</span>
                            </td>
                            <td>
                                {{ employee.mobile }}
                            </td>
                            <td v-if="$page.props.authUser.data.role === 'Site admin'">
                                {{ __(employee.branch?.name) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="employee.toggleable"
                                        :href="route('admin.employees.toggle', employee.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        :title="employee.active ? __('Enabled') : __('Disabled')"
                                        :class="{ 'text-success': employee.active, 'text-body': !employee.active }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': employee.active, 'ti-toggle-left': !employee.active }"></i>
                                    </Link>
                                    <Link v-if="employee.editable" :href="route('admin.employees.edit', employee.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link
                                        v-if="employee.deleteable"
                                        :href="route('admin.employees.destroy', employee.id)"
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
                <Pagination :meta="employees.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
