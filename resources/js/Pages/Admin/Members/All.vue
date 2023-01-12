<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';

const props = defineProps({
    members: Object,
    filters: Object,
});

console.log(props);

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const search = ref(props.filters.search);
const role = ref(props.filters.role || '');
const branch = ref(props.filters.branch || '');

watch(perPage, (val) => {
    Inertia.get(route('admin.members.index'), { perPage: val, search: search.value, role: role.value, branch: branch.value }, { preserveState: true, replace: true });
});
watch(search, (val) => {
    Inertia.get(route('admin.members.index'), { search: val, perPage: perPage.value, role: role.value, branch: branch.value }, { preserveState: true, replace: true });
});
watch(role, (val) => {
    Inertia.get(route('admin.members.index'), { role: val, perPage: perPage.value, search: search.value, branch: branch.value }, { preserveState: true, replace: true });
});
watch(branch, (val) => {
    Inertia.get(route('admin.members.index'), { branch: val, role: role.value, perPage: perPage.value, search: search.value }, { preserveState: true, replace: true });
});
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
                                <span>{{ __('Site admin') }}</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">12</h4>
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
                                    <h4 class="mb-0 me-2">22</h4>
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
                                    <h4 class="mb-0 me-2">13</h4>
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
                <h5 class="card-title mb-3">{{ __('All members') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 user_role">
                        <select id="UserRole" class="form-select text-capitalize" v-model="role">
                            <option value="">{{ __('Select role') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 user_plan">
                        <select id="UserBranch" class="form-select text-capitalize" v-model="branch">
                            <option value="">{{ __('Select branch') }}</option>
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
                                <Link v-if="true" :href="route('admin.admins.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create moderator') }}</span>
                                    </span>
                                </Link>
                                <Link v-if="true" :href="route('admin.admins.notify')" type="button" class="dt-button btn btn-light me-1">
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
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Membership number') }}</th>
                            <th>{{ __('Mobile') }}</th>
                            <th>{{ __('Membership type') }}</th>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Membership Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in members.data" :key="member.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="member.profile_photo || '/img/user-dark.png'" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="app-user-view-account.html" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ member.fullName }}</span>
                                        </a>
                                        <small class="text-muted">{{ member.national_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ 'membership-number' }}
                            </td>
                            <td dir="ltr">
                                {{ member.phone_number }}
                            </td>
                            <td>
                                {{ member.subscription.type }}
                            </td>
                            <td>
                                {{ member.branch.name }}
                            </td>
                            <td>
                                {{ member.subscription.status }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="member.toggleable"
                                        :href="route('admin.members.toggle', member.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        data-bs-toggle="tooltip"
                                        :data-bs-original-title="member.status == -1 ? __('Disabled') : __('Enabled')"
                                        :class="{ 'text-success': member.status != -1, 'text-body': member.status == -1 }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': member.active != -1, 'ti-toggle-left': member.active == -1 }"></i>
                                    </Link>
                                    <Link v-if="member.viewable" :href="route('admin.members.show', member.id)" class="text-body"><i class="ti ti-eye ti-sm me-2"></i></Link>
                                    <Link v-if="member.editable" :href="route('admin.members.edit', member.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link v-if="member.deleteable" :href="route('admin.members.destroy', member.id)" preserve-scroll as="span" method="delete" class="text-body cursor-pointer">
                                        <i class="ti ti-trash ti-sm me-2"></i>
                                    </Link>
                                    <!-- Disapprove -->
                                    <Link
                                        v-if="member.toggleable"
                                        :href="route('admin.members.toggle', member.id)"
                                        data-bs-placement="top"
                                        data-bs-toggle="tooltip"
                                        :data-bs-original-title="__('Disapprove')"
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
