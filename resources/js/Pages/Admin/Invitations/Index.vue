<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    invitations: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const search = ref(props.filters.search || '');

const appended = ref({
    perPage: perPage.value,
    search: search.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.invitations.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [search.value, perPage.value],
    ([search, perPage]) => {
        appended.value.search = search;
        appended.value.perPage = perPage;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.invitations.index'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Invitations')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Invitations') }}</h5>
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
                                <Link v-if="true" :href="route('admin.invitations.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create invitation') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('name')" :class="{ 'link-primary': filters.order == 'name' }" class="cursor-pointer cell-fit">{{ __('Invitation') }}</th>
                            <th @click.prevent="sortBy('status')" :class="{ 'link-primary': filters.order == 'status' }" class="cursor-pointer cell-fit">{{ __('Status') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="invitation in invitations.data">
                            <td>
                                <span style="display: inline-block; width: 400px; max-width: 100%; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis">
                                    {{ invitation.name }}
                                </span>
                            </td>
                            <td>{{ invitation.status ? __('Enabled') : __('Disabled') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="invitation.viewable"
                                        :href="route('admin.invitations.show', invitation.id)"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Show')"
                                        :title="__('Show')"
                                    >
                                        <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="invitation.editable"
                                        :href="route('admin.invitations.edit', invitation.id)"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Edit')"
                                        :title="__('Edit')"
                                    >
                                        <i class="ti ti-edit mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="invitation.toggleable"
                                        :href="route('admin.invitations.toggle', invitation.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="cursor-pointer"
                                        data-bs-placement="top"
                                        :title="invitation.status ? __('Disable') : __('Enable')"
                                        :class="{ 'text-success': invitation.status, 'text-body': !invitation.status }"
                                    >
                                        <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': invitation.status, 'ti-toggle-left': !invitation.status }"></i>
                                    </Link>
                                    <Link
                                        v-if="invitation.deleteable"
                                        :href="route('admin.invitations.destroy', invitation.id)"
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
                <Pagination :meta="invitations.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
