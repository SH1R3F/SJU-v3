<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    transfers: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const national_id = ref(props.filters.national_id || '');

const appended = ref({
    perPage: perPage.value,
    national_id: national_id.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.members.transfers', props.status), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [national_id.value, perPage.value],
    ([nationalIdVal, pp]) => {
        appended.value.national_id = nationalIdVal;
        appended.value.perPage = pp;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.members.transfers', props.status), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Member transfers')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Member transfers') }}</h5>
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
                                <Link v-if="transfers.can_create" :href="route('admin.members.transfers.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Transfer member') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('member')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'member' }">{{ __('Member') }}</th>
                            <th @click.prevent="sortBy('transfer_from')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'transfer_from' }">{{ __('Branch from') }}</th>
                            <th @click.prevent="sortBy('transfer_to')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'transfer_to' }">{{ __('Branch to') }}</th>
                            <th @click.prevent="sortBy('requester')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'requester' }">{{ __('Requester') }}</th>
                            <th @click.prevent="sortBy('status')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'status' }">{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="transfer in transfers.data" :key="transfer.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="transfer.member.profile_photo || '/img/user-dark.png'" onerror="this.src = '/img/user-dark.png';" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.members.show', transfer.member.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ transfer.member.fullName }}</span>
                                        </Link>
                                        <small class="text-muted">{{ transfer.member.national_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ transfer.branchFrom.name }}
                            </td>
                            <td>
                                {{ transfer.branchTo.name }}
                            </td>
                            <td>
                                {{ transfer.requester.fullName }}
                            </td>
                            <td>
                                {{ transfer.state }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="transfer.status === 0 && ($page.props.authUser.data.role === 'Site admin' || transfer.transfer_from === $page.props.authUser.data.branch_id)"
                                        :href="route('admin.members.transfers.approve', transfer.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="text-success cursor-pointer"
                                        data-bs-placement="top"
                                    >
                                        <i class="ti ti-check ti-sm me-2"></i>
                                    </Link>
                                    <Link
                                        v-if="transfer.status === 0 && ($page.props.authUser.data.role === 'Site admin' || transfer.transfer_from === $page.props.authUser.data.branch_id)"
                                        :href="route('admin.members.transfers.disapprove', transfer.id)"
                                        method="post"
                                        as="span"
                                        preserve-scroll
                                        class="text-danger cursor-pointer"
                                        data-bs-placement="top"
                                    >
                                        <i class="ti ti-x ti-sm me-2"></i>
                                    </Link>
                                    <Link
                                        v-if="transfer.status === 0 && ($page.props.authUser.data.role === 'Site admin' || transfer.transfer_to === $page.props.authUser.data.branch_id)"
                                        :href="route('admin.members.transfers.destroy', transfer.id)"
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
                <Pagination :meta="transfers.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
