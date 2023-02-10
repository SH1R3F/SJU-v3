<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    tickets: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const title = ref(props.filters.title || '');
const name = ref(props.filters.name || '');
const status = ref(props.filters.status || '');
const mobile = ref(props.filters.mobile || '');
const email = ref(props.filters.email || '');

const appended = ref({
    perPage: perPage.value,
    title: title.value,
    name: name.value,
    status: status.value,
    mobile: mobile.value,
    email: email.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.tickets.subscribers'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [title.value, name.value, status.value, mobile.value, email.value, perPage.value],
    ([titleVal, nameVal, stat, mobVal, emailVal, pp]) => {
        appended.value.title = titleVal;
        appended.value.name = nameVal;
        appended.value.status = stat;
        appended.value.mobile = mobVal;
        appended.value.email = emailVal;
        appended.value.perPage = pp;
        filterReq();
    }
);
const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.tickets.subscribers'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Technical support')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Subscribers tickets') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-12 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Ticket title')" v-model="title" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <select class="form-control" v-model="status">
                            <option value="">{{ __('Choose') }}</option>
                            <option value="0">{{ __('Open') }}</option>
                            <option value="1">{{ __('Closed') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Mobile')" v-model="mobile" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Email')" v-model="email" />
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
                                <a :href="route('admin.tickets.export', 'subscribers')" type="button" class="dt-button add-new btn btn-label-secondary me-1">
                                    <span>
                                        <i class="ti ti-screen-share me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Export') }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('subscriber')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'subscriber' }">{{ __('User') }}</th>
                            <th @click.prevent="sortBy('subscriber_mobile')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'subscriber_mobile' }">{{ __('Mobile') }}</th>
                            <th @click.prevent="sortBy('title')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'title' }">{{ __('Ticket title') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th @click.prevent="sortBy('updated_at')" class="cursor-pointer text-truncate" :class="{ 'link-primary': filters.order == 'updated_at' }">{{ __('Last update') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ticket in tickets.data">
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="ticket.supportable.profile_photo || '/img/user-dark.png'" onerror="this.src = '/img/user-dark.png';" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.subscribers.show', ticket.supportable.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ ticket.supportable.fullName }}</span>
                                        </Link>
                                        <small class="text-truncate text-muted">{{ ticket.supportable.email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ ticket.supportable.mobile }}</td>
                            <td>{{ ticket.title }}</td>
                            <td>
                                <span
                                    class="badge"
                                    :class="{
                                        'bg-label-success': ticket.status,
                                        'bg-label-secondary': !ticket.status,
                                    }"
                                    text-capitalized=""
                                >
                                    {{ ticket.status ? __('Closed') : __('Open') }}
                                </span>
                            </td>
                            <td>{{ ticket.updated_at }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link v-if="ticket.viewable" :href="route('admin.tickets.show', ticket.id)" class="text-body" data-bs-placement="top" :aria-label="__('Show')" :title="__('Show')">
                                        <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="ticket.deleteable"
                                        :href="route('admin.tickets.destroy', ticket.id)"
                                        method="DELETE"
                                        as="span"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Delete')"
                                        :title="__('Delete')"
                                    >
                                        <i class="ti ti-trash mx-2 ti-sm cursor-pointer"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="tickets.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
