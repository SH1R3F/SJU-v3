<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    subscribers: Object,
    filters: Object,
    status: String,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');
const mobile = ref(props.filters.mobile || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    mobile: mobile.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.subscribers.index', props.status), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, mobile.value, perPage.value],
    ([nameVal, mobile, pp]) => {
        appended.value.name = nameVal;
        appended.value.mobile = mobile;
        appended.value.perPage = pp;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.subscribers.index', props.status), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Subscribers management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Active subscribers') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Mobile')" v-model="mobile" />
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
                                    v-if="subscribers.can_export"
                                    :href="route('admin.subscribers.export', { status: status, ...queryParams() })"
                                    class="dt-button buttons-collection btn btn-label-secondary me-1"
                                    type="button"
                                >
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('Export') }}
                                    </span>
                                </a>
                                <Link v-if="subscribers.can_create" :href="route('admin.subscribers.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create subscriber') }}</span>
                                    </span>
                                </Link>
                                <Link v-if="subscribers.can_notify" :href="route('admin.subscribers.notify')" type="button" class="dt-button btn btn-light me-1">
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
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="subscriber in subscribers.data" :key="subscriber.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="subscriber.profile_photo || '/img/user-dark.png'" onerror="this.src = '/img/user-dark.png';" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.subscribers.show', subscriber.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ subscriber.fullName }}</span>
                                        </Link>
                                        <small class="text-muted">{{ subscriber.country }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ subscriber.email }}
                            </td>
                            <td dir="ltr">
                                {{ subscriber.phone_number }}
                            </td>
                            <td>
                                {{ subscriber.courses_count }}
                            </td>
                            <td>
                                {{ subscriber.state }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="subscriber.toggleable"
                                        :href="route('admin.subscribers.toggle', subscriber.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        :title="subscriber.status == 1 ? __('Enabled') : __('Disabled')"
                                        :class="{ 'text-success': subscriber.status == 1, 'text-body': subscriber.status != 1 }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': subscriber.status == 1, 'ti-toggle-left': subscriber.status != 1 }"></i>
                                    </Link>
                                    <Link v-if="subscriber.viewable" :href="route('admin.subscribers.show', subscriber.id)" class="text-body"><i class="ti ti-eye ti-sm me-2"></i></Link>
                                    <Link v-if="subscriber.editable" :href="route('admin.subscribers.edit', subscriber.id)" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></Link>
                                    <Link
                                        v-if="subscriber.deleteable"
                                        :href="route('admin.subscribers.destroy', subscriber.id)"
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
                <Pagination :meta="subscribers.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
