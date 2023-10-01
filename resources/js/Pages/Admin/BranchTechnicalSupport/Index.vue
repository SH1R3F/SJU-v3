<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    tickets: Object,
    filters: Object
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);

const appended = ref({
    perPage: perPage.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.branch-issues.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [perPage.value],
    ([pp]) => {
        appended.value.perPage = pp;
        filterReq();
    }
);
const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.branch-issues.index'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Technical support')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Tickets List Table -->
        <div class="card">
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
                                <a :href="route('admin.branch-issues.create')" type="button" class="dt-button add-new btn btn-success me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('New ticket') }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('title')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'title' }">{{ __('Ticket title') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th @click.prevent="sortBy('updated_at')" class="cursor-pointer text-truncate" :class="{ 'link-primary': filters.order == 'updated_at' }">{{ __('Last update') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ticket in tickets.data">
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
                                    <Link :href="route('admin.branch-issues.show', ticket.id)" class="text-body" data-bs-placement="top" :aria-label="__('Show')" :title="__('Show')">
                                        <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        :href="route('admin.branch-issues.destroy', ticket.id)"
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
