<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { useForm } from '@inertiajs/inertia-vue3';

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

const editForm = useForm({
    id: null,
    permissions: {},
});

const editPermissions = (employee) => {
    console.log(employee.permissions);
    editForm.id = employee.id;
    editForm.permissions = Object.keys(employee.permissions).length ? employee.permissions : {};
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
                                        <a href="#" class="text-body text-truncate"
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
                                    <a
                                        v-if="employee.editable"
                                        @click="editPermissions(employee)"
                                        data-bs-target="#editRoleModal"
                                        data-bs-toggle="modal"
                                        class="role-add-modal add-new-role text-body cursor-pointer"
                                    >
                                        <i class="ti ti-key ti-sm mx-2"></i>
                                    </a>
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

        <!-- Edit permissions -->
        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-edit-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" ref="editFormClose" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2">{{ __('Edit permissions') }}</h3>
                        </div>
                        <!-- Edit permissions form -->
                        <form
                            class="row g-3"
                            @submit.prevent="
                                editForm.post(route('admin.employees.permissions', editForm.id), {
                                    onSuccess: () => {
                                        $refs.editFormClose.click();
                                    },
                                })
                            "
                        >
                            <div class="col-12">
                                <h5>{{ __('Permissions') }}</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-semibold" colspan="2">
                                                    {{ __('Access') }}
                                                    <i class="ti ti-info-circle" data-bs-placement="top"></i>
                                                </td>
                                            </tr>
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['manage-site-options'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Site options') }}</td>
                                                <td>
                                                    <div class="d-flex" v-if="Object.keys($page.props.authUser.data.permissions).includes('manage-site-options')">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="manageOptions" v-model="editForm.permissions['manage-site-options']" />
                                                            <label class="form-check-label" for="manageOptions"> {{ __('Manage') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-role', 'create-role', 'update-role', 'delete-role'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Roles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-role')">
                                                            <input class="form-check-input" type="checkbox" id="editlistRole" v-model="editForm.permissions['viewAny-role']" />
                                                            <label class="form-check-label" for="editlistRole"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-role')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateRole" v-model="editForm.permissions['create-role']" />
                                                            <label class="form-check-label" for="editcreateRole"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-role')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateRole" v-model="editForm.permissions['update-role']" />
                                                            <label class="form-check-label" for="editupdateRole"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-role')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteRole" v-model="editForm.permissions['delete-role']" />
                                                            <label class="form-check-label" for="editdeleteRole"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-admin', 'create-admin', 'update-admin', 'delete-admin', 'notify-admin'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Admins management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-admin')">
                                                            <input class="form-check-input" type="checkbox" id="editlistAdmin" v-model="editForm.permissions['viewAny-admin']" />
                                                            <label class="form-check-label" for="editlistAdmin"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-admin')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateAdmin" v-model="editForm.permissions['create-admin']" />
                                                            <label class="form-check-label" for="editcreateAdmin"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-admin')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateAdmin" v-model="editForm.permissions['update-admin']" />
                                                            <label class="form-check-label" for="editupdateAdmin"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-admin')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteAdmin" v-model="editForm.permissions['delete-admin']" />
                                                            <label class="form-check-label" for="editdeleteAdmin"> {{ __('Delete') }} </label>
                                                        </div>
                                                        <div class="form-check" v-if="Object.keys($page.props.authUser.data.permissions).includes('notify-admin')">
                                                            <input class="form-check-input" type="checkbox" id="editnotifyAdmin" v-model="editForm.permissions['notify-admin']" />
                                                            <label class="form-check-label" for="editnotifyAdmin"> {{ __('Notify') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-employee', 'create-employee', 'update-employee', 'delete-employee'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Employees management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-employee')">
                                                            <input class="form-check-input" type="checkbox" id="editlistEmployee" v-model="editForm.permissions['viewAny-employee']" />
                                                            <label class="form-check-label" for="editlistEmployee"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-employee')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateEmployee" v-model="editForm.permissions['create-employee']" />
                                                            <label class="form-check-label" for="editcreateEmployee"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-employee')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateEmployee" v-model="editForm.permissions['update-employee']" />
                                                            <label class="form-check-label" for="editupdateEmployee"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-employee')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteEmployee" v-model="editForm.permissions['delete-employee']" />
                                                            <label class="form-check-label" for="editdeleteEmployee"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-member', 'branch-member', 'acceptance-member', 'refused-member', 'manage-invoice', 'manage-transaction'].includes(permission))">
                                                <td rowspan="3" class="text-nowrap fw-semibold">{{ __('Members management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-member')">
                                                            <input class="form-check-input" type="checkbox" id="editallMembers" v-model="editForm.permissions['viewAny-member']" />
                                                            <label class="form-check-label" for="editallMembers"> {{ __('Members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('branch-member')">
                                                            <input class="form-check-input" type="checkbox" id="editbranchMembers" v-model="editForm.permissions['branch-member']" />
                                                            <label class="form-check-label" for="editbranchMembers"> {{ __('Branch approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('acceptance-member')">
                                                            <input class="form-check-input" type="checkbox" id="editacceptanceMembers" v-model="editForm.permissions['acceptance-member']" />
                                                            <label class="form-check-label" for="editacceptanceMembers"> {{ __('Admin approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('refused-member')">
                                                            <input class="form-check-input" type="checkbox" id="editrefusedMembers" v-model="editForm.permissions['refused-member']" />
                                                            <label class="form-check-label" for="editrefusedMembers"> {{ __('Refused members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('manage-invoice')">
                                                            <input class="form-check-input" type="checkbox" id="editInvoices" v-model="editForm.permissions['manage-invoice']" />
                                                            <label class="form-check-label" for="editInvoices"> {{ __('Invoices') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('manage-transaction')">
                                                            <input class="form-check-input" type="checkbox" id="editTransactions" v-model="editForm.permissions['manage-transaction']" />
                                                            <label class="form-check-label" for="editTransactions"> {{ __('Payment attempts') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['export-member', 'view-member', 'create-member', 'update-member', 'delete-member', 'pay-member'].includes(permission))">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('export-member')">
                                                            <input class="form-check-input" type="checkbox" id="editexportMembers" v-model="editForm.permissions['export-member']" />
                                                            <label class="form-check-label" for="editexportMembers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-member')">
                                                            <input class="form-check-input" type="checkbox" id="editshowMember" v-model="editForm.permissions['view-member']" />
                                                            <label class="form-check-label" for="editshowMember"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-member')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateMember" v-model="editForm.permissions['create-member']" />
                                                            <label class="form-check-label" for="editcreateMember"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-member')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateMember" v-model="editForm.permissions['update-member']" />
                                                            <label class="form-check-label" for="editupdateMember"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-member')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteMember" v-model="editForm.permissions['delete-member']" />
                                                            <label class="form-check-label" for="editdeleteMember"> {{ __('Delete') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('pay-member')">
                                                            <input class="form-check-input" type="checkbox" id="editSetPaid" v-model="editForm.permissions['pay-member']" />
                                                            <label class="form-check-label" for="editSetPaid"> {{ __('Set paid') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['notify-member', 'toggle-member', 'accept-member', 'approve-member', 'disapprove-member', 'refuse-member'].includes(permission))">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('notify-member')">
                                                            <input class="form-check-input" type="checkbox" id="editnotifyMembers" v-model="editForm.permissions['notify-member']" />
                                                            <label class="form-check-label" for="editnotifyMembers"> {{ __('Notify') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('toggle-member')">
                                                            <input class="form-check-input" type="checkbox" id="edittoggleMember" v-model="editForm.permissions['toggle-member']" />
                                                            <label class="form-check-label" for="edittoggleMember"> {{ __('Disable / Enable') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('accept-member')">
                                                            <input class="form-check-input" type="checkbox" id="editacceptMember" v-model="editForm.permissions['accept-member']" />
                                                            <label class="form-check-label" for="editacceptMember"> {{ __('Admin accept') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('approve-member')">
                                                            <input class="form-check-input" type="checkbox" id="editapproveMember" v-model="editForm.permissions['approve-member']" />
                                                            <label class="form-check-label" for="editapproveMember"> {{ __('Branch approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('disapprove-member')">
                                                            <input class="form-check-input" type="checkbox" id="editdisapproveMember" v-model="editForm.permissions['disapprove-member']" />
                                                            <label class="form-check-label" for="editdisapproveMember"> {{ __('Disapprove / Unrefuse') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('refuse-member')">
                                                            <input class="form-check-input" type="checkbox" id="editrefuseMember" v-model="editForm.permissions['refuse-member']" />
                                                            <label class="form-check-label" for="editrefuseMember"> {{ __('Refuse') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->

                                            <!-- Subscribers permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-subscriber', 'export-subscriber', 'view-subscriber', 'create-subscriber', 'update-subscriber', 'delete-subscriber'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Subscribers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editSubscribers" v-model="editForm.permissions['viewAny-subscriber']" />
                                                            <label class="form-check-label" for="editSubscribers"> {{ __('Subscribers') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('export-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editexportSubscribers" v-model="editForm.permissions['export-subscriber']" />
                                                            <label class="form-check-label" for="editexportSubscribers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editshowSubscriber" v-model="editForm.permissions['view-subscriber']" />
                                                            <label class="form-check-label" for="editshowSubscriber"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateSubscriber" v-model="editForm.permissions['create-subscriber']" />
                                                            <label class="form-check-label" for="editcreateSubscriber"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateSubscriber" v-model="editForm.permissions['update-subscriber']" />
                                                            <label class="form-check-label" for="editupdateSubscriber"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-subscriber')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteSubscriber" v-model="editForm.permissions['delete-subscriber']" />
                                                            <label class="form-check-label" for="editdeleteSubscriber"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Subscribers permission -->

                                            <!-- Volunteers permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-volunteer', 'export-volunteer', 'view-volunteer', 'create-volunteer', 'update-volunteer', 'delete-volunteer'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Volunteers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editVolunteers" v-model="editForm.permissions['viewAny-volunteer']" />
                                                            <label class="form-check-label" for="editVolunteers"> {{ __('Volunteers') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('export-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editexportVolunteers" v-model="editForm.permissions['export-volunteer']" />
                                                            <label class="form-check-label" for="editexportVolunteers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editshowVolunteer" v-model="editForm.permissions['view-volunteer']" />
                                                            <label class="form-check-label" for="editshowVolunteer"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateVolunteer" v-model="editForm.permissions['create-volunteer']" />
                                                            <label class="form-check-label" for="editcreateVolunteer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateVolunteer" v-model="editForm.permissions['update-volunteer']" />
                                                            <label class="form-check-label" for="editupdateVolunteer"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-volunteer')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteVolunteer" v-model="editForm.permissions['delete-volunteer']" />
                                                            <label class="form-check-label" for="editdeleteVolunteer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Volunteers permission -->

                                            <!-- Courses permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-course', 'create-course', 'update-course', 'delete-course'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Courses management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-course')">
                                                            <input class="form-check-input" type="checkbox" id="editlistCourse" v-model="editForm.permissions['viewAny-course']" />
                                                            <label class="form-check-label" for="editlistCourse"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-course')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateCourse" v-model="editForm.permissions['create-course']" />
                                                            <label class="form-check-label" for="editcreateCourse"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-course')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateCourse" v-model="editForm.permissions['update-course']" />
                                                            <label class="form-check-label" for="editupdateCourse"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-course')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteCourse" v-model="editForm.permissions['delete-course']" />
                                                            <label class="form-check-label" for="editdeleteCourse"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Courses permission -->

                                            <!-- Templates permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-template', 'create-template', 'update-template', 'delete-template'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Templates management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-template')">
                                                            <input class="form-check-input" type="checkbox" id="editlistTemplate" v-model="editForm.permissions['viewAny-template']" />
                                                            <label class="form-check-label" for="editlistTemplate"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-template')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateTemplate" v-model="editForm.permissions['create-template']" />
                                                            <label class="form-check-label" for="editcreateTemplate"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-template')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateTemplate" v-model="editForm.permissions['update-template']" />
                                                            <label class="form-check-label" for="editupdateTemplate"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-template')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTemplate" v-model="editForm.permissions['delete-template']" />
                                                            <label class="form-check-label" for="editdeleteTemplate"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Templates permission -->

                                            <!-- Questionnaires permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-questionnaire', 'view-questionnaire', 'create-questionnaire', 'update-questionnaire', 'delete-questionnaire'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Questionnaires management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-questionnaire')">
                                                            <input class="form-check-input" type="checkbox" id="editlistQuestionnaire" v-model="editForm.permissions['viewAny-questionnaire']" />
                                                            <label class="form-check-label" for="editlistQuestionnaire"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-questionnaire')">
                                                            <input class="form-check-input" type="checkbox" id="editviewQuestionnaire" v-model="editForm.permissions['view-questionnaire']" />
                                                            <label class="form-check-label" for="editviewQuestionnaire"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-questionnaire')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateQuestionnaire" v-model="editForm.permissions['create-questionnaire']" />
                                                            <label class="form-check-label" for="editcreateQuestionnaire"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-questionnaire')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateQuestionnaire" v-model="editForm.permissions['update-questionnaire']" />
                                                            <label class="form-check-label" for="editupdateQuestionnaire"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-questionnaire')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteQuestionnaire" v-model="editForm.permissions['delete-questionnaire']" />
                                                            <label class="form-check-label" for="editdeleteQuestionnaire"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Questionnaires permission -->

                                            <!-- Pages permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-page', 'create-page', 'update-page', 'delete-page'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Pages management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-page')">
                                                            <input class="form-check-input" type="checkbox" id="editlistPage" v-model="editForm.permissions['viewAny-page']" />
                                                            <label class="form-check-label" for="editlistPage"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-page')">
                                                            <input class="form-check-input" type="checkbox" id="editcreatePage" v-model="editForm.permissions['create-page']" />
                                                            <label class="form-check-label" for="editcreatePage"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-page')">
                                                            <input class="form-check-input" type="checkbox" id="editupdatePage" v-model="editForm.permissions['update-page']" />
                                                            <label class="form-check-label" for="editupdatePage"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-page')">
                                                            <input class="form-check-input" type="checkbox" id="editdeletePage" v-model="editForm.permissions['delete-page']" />
                                                            <label class="form-check-label" for="editdeletePage"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Pages permission -->

                                            <!-- Articles permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-article', 'view-article', 'create-article', 'update-article', 'delete-article'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Articles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-article')">
                                                            <input class="form-check-input" type="checkbox" id="editlistArticle" v-model="editForm.permissions['viewAny-article']" />
                                                            <label class="form-check-label" for="editlistArticle"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-article')">
                                                            <input class="form-check-input" type="checkbox" id="editviewArticle" v-model="editForm.permissions['view-article']" />
                                                            <label class="form-check-label" for="editviewArticle"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-article')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateArticle" v-model="editForm.permissions['create-article']" />
                                                            <label class="form-check-label" for="editcreateArticle"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-article')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateArticle" v-model="editForm.permissions['update-article']" />
                                                            <label class="form-check-label" for="editupdateArticle"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-article')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteArticle" v-model="editForm.permissions['delete-article']" />
                                                            <label class="form-check-label" for="editdeleteArticle"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Articles permission -->

                                            <!-- Ads permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-ad', 'create-ad', 'update-ad', 'delete-ad'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Ads management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-ad')">
                                                            <input class="form-check-input" type="checkbox" id="editlistAd" v-model="editForm.permissions['viewAny-ad']" />
                                                            <label class="form-check-label" for="editlistAd"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-ad')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateAd" v-model="editForm.permissions['create-ad']" />
                                                            <label class="form-check-label" for="editcreateAd"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-ad')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateAd" v-model="editForm.permissions['update-ad']" />
                                                            <label class="form-check-label" for="editupdateAd"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-ad')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteAd" v-model="editForm.permissions['delete-ad']" />
                                                            <label class="form-check-label" for="editdeleteAd"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Ads permission -->

                                            <!-- Urls permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-url', 'create-url', 'update-url', 'delete-url'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Urls management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-url')">
                                                            <input class="form-check-input" type="checkbox" id="editlistUrl" v-model="editForm.permissions['viewAny-url']" />
                                                            <label class="form-check-label" for="editlistUrl"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-url')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateUrl" v-model="editForm.permissions['create-url']" />
                                                            <label class="form-check-label" for="editcreateUrl"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-url')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateUrl" v-model="editForm.permissions['update-url']" />
                                                            <label class="form-check-label" for="editupdateUrl"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-url')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteUrl" v-model="editForm.permissions['delete-url']" />
                                                            <label class="form-check-label" for="editdeleteUrl"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Urls permission -->

                                            <!-- Studio permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-media', 'create-media', 'delete-media'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Studio management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-media')">
                                                            <input class="form-check-input" type="checkbox" id="editlistMedia" v-model="editForm.permissions['viewAny-media']" />
                                                            <label class="form-check-label" for="editlistMedia"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-media')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateMedia" v-model="editForm.permissions['create-media']" />
                                                            <label class="form-check-label" for="editcreateMedia"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-media')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteMedia" v-model="editForm.permissions['delete-media']" />
                                                            <label class="form-check-label" for="editdeleteMedia"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Studio permission -->

                                            <!-- Technical support -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['members-ticket', 'subscribers-ticket', 'volunteers-ticket', 'view-ticket', 'delete-ticket'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Technical support') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('members-ticket')">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportmember" v-model="editForm.permissions['members-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportmember"> {{ __('List members tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('subscribers-ticket')">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportsubscriber" v-model="editForm.permissions['subscribers-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportsubscriber"> {{ __('List subscribers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('volunteers-ticket')">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportvolunteer" v-model="editForm.permissions['volunteers-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportvolunteer"> {{ __('List volunteers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-ticket')">
                                                            <input class="form-check-input" type="checkbox" id="editViewTicket" v-model="editForm.permissions['view-ticket']" />
                                                            <label class="form-check-label" for="editViewTicket"> {{ __('View ticket') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-ticket')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTicket" v-model="editForm.permissions['delete-ticket']" />
                                                            <label class="form-check-label" for="editdeleteTicket"> {{ __('Delete ticket') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Technical support -->

                                            <!-- Invitations permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-invitation', 'view-invitation', 'create-invitation', 'update-invitation', 'delete-invitation'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Invitations management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-invitation')">
                                                            <input class="form-check-input" type="checkbox" id="editlistInvitation" v-model="editForm.permissions['viewAny-invitation']" />
                                                            <label class="form-check-label" for="editlistInvitation"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('view-invitation')">
                                                            <input class="form-check-input" type="checkbox" id="editviewInvitation" v-model="editForm.permissions['view-invitation']" />
                                                            <label class="form-check-label" for="editviewInvitation"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-invitation')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateInvitation" v-model="editForm.permissions['create-invitation']" />
                                                            <label class="form-check-label" for="editcreateInvitation"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-invitation')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateInvitation" v-model="editForm.permissions['update-invitation']" />
                                                            <label class="form-check-label" for="editupdateInvitation"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-invitation')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteInvitation" v-model="editForm.permissions['delete-invitation']" />
                                                            <label class="form-check-label" for="editdeleteInvitation"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Invitations permission -->

                                            <!-- Training bag permission -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-file', 'create-file', 'delete-file'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Training bag') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-file')">
                                                            <input class="form-check-input" type="checkbox" id="editlistFile" v-model="editForm.permissions['viewAny-file']" />
                                                            <label class="form-check-label" for="editlistFile"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-file')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateFile" v-model="editForm.permissions['create-file']" />
                                                            <label class="form-check-label" for="editcreateFile"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-file')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteFile" v-model="editForm.permissions['delete-file']" />
                                                            <label class="form-check-label" for="editdeleteFile"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Training bag permission -->

                                            <!-- Member transfers -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-transfer', 'create-transfer', 'update-transfer', 'delete-transfer'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Member transfers') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-transfer')">
                                                            <input class="form-check-input" type="checkbox" id="editlistTransfer" v-model="editForm.permissions['viewAny-transfer']" />
                                                            <label class="form-check-label" for="editlistTransfer"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-transfer')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateTransfer" v-model="editForm.permissions['create-transfer']" />
                                                            <label class="form-check-label" for="editcreateTransfer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-transfer')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateTransfer" v-model="editForm.permissions['update-transfer']" />
                                                            <label class="form-check-label" for="editupdateTransfer"> {{ __('Approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-transfer')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTransfer" v-model="editForm.permissions['delete-transfer']" />
                                                            <label class="form-check-label" for="editdeleteTransfer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Member transfers -->

                                            <!-- Competitions -->
                                            <tr v-if="Object.keys($page.props.authUser.data.permissions).some(permission => ['viewAny-competition', 'create-competition', 'update-competition', 'delete-competition'].includes(permission))">
                                                <td class="text-nowrap fw-semibold">{{ __('Competitions') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('viewAny-competition')">
                                                            <input class="form-check-input" type="checkbox" id="editlistCompetition" v-model="editForm.permissions['viewAny-competition']" />
                                                            <label class="form-check-label" for="editlistCompetition"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('create-competition')">
                                                            <input class="form-check-input" type="checkbox" id="editcreateCompetition" v-model="editForm.permissions['create-competition']" />
                                                            <label class="form-check-label" for="editcreateCompetition"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('update-competition')">
                                                            <input class="form-check-input" type="checkbox" id="editupdateCompetition" v-model="editForm.permissions['update-competition']" />
                                                            <label class="form-check-label" for="editupdateCompetition"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3" v-if="Object.keys($page.props.authUser.data.permissions).includes('delete-competition')">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteCompetition" v-model="editForm.permissions['delete-competition']" />
                                                            <label class="form-check-label" for="editdeleteCompetition"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Competitions -->

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Save') }}</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">{{ __('Cancel') }}</button>
                            </div>
                        </form>
                        <!--/ Edit permissions form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit permissions -->
    </div>
    <!-- / Content -->
</template>
