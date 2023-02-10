<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    invoices: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');
const national_id = ref(props.filters.national_id || '');
const membership_number = ref(props.filters.membership_number || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    national_id: national_id.value,
    membership_number: membership_number.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.invoices.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, national_id.value, membership_number.value, perPage.value],
    ([nameVal, nidVal, memNum, pp]) => {
        appended.value.name = nameVal;
        appended.value.national_id = nidVal;
        appended.value.membership_number = memNum;
        appended.value.perPage = pp;
        filterReq();
    }
);
const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.invoices.index'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Subscriptions invoices')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Invoices') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-12 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('National ID number')" v-model="national_id" />
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Membership number')" v-model="membership_number" />
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
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('name')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'name' }">{{ __('User') }}</th>
                            <th @click.prevent="sortBy('membership_number')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'membership_number' }">{{ __('Membership number') }}</th>
                            <th @click.prevent="sortBy('amount')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'amount' }">{{ __('Amount') }}</th>
                            <th class="text-truncate cursor-pointer" @click.prevent="sortBy('created_at')" :class="{ 'link-primary': filters.order == 'created_at' }">{{ __('Date') }}</th>
                            <th @click.prevent="sortBy('type')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'type' }">{{ __('Membership type') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="invoice in invoices.data">
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="invoice.member.profile_photo || '/img/user-dark.png'" onerror="this.src = '/img/user-dark.png';" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.members.show', invoice.member.id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ invoice.member.fullName }}</span>
                                        </Link>
                                        <small class="text-truncate text-muted">{{ invoice.member.national_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ invoice.member.membership_number }}</td>
                            <td>{{ invoice.amount }}</td>
                            <td>{{ invoice.created_at }}</td>
                            <td>
                                <span
                                    class="badge"
                                    :class="{
                                        'bg-label-success': invoice.member.subscription.num == 1,
                                        'bg-label-secondary': invoice.member.subscription.num == 2,
                                        'bg-label-warning': invoice.member.subscription.num == 3,
                                    }"
                                    text-capitalized=""
                                >
                                    {{ invoice.member.subscription?.type }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link :href="route('admin.invoices.show', invoice.id)" class="text-body" data-bs-placement="top" :aria-label="__('Show')" :title="__('Show')">
                                        <i class="ti ti-eye mx-2 ti-sm"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="invoices.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
