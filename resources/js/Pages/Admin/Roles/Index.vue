<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    roles: Object,
});

const addForm = useForm({
    name: '',
    permissions: {},
});

const editForm = useForm({
    id: null,
    name: '',
    permissions: {},
});

const editRole = (role) => {
    editForm.id = role.id;
    editForm.name = role.name;
    editForm.permissions = Object.keys(role.permissions).length ? role.permissions : {};
};
</script>

<template>
    <Head :title="__('Roles List')" />
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-semibold mb-4">{{ __('Roles List') }}</h4>
        <p class="mb-4">
            {{ __('A role provided access to predefined menus and features so that depending on the assigned role an administrator can have access to what the user needs.') }}
        </p>
        <!-- Role cards -->
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6" v-for="role in roles.data" :key="role.id">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-normal mb-2">{{ __('Total :count users', { count: role.users_count }) }}</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li
                                    v-for="admin in role.admins"
                                    :key="admin.id"
                                    data-bs-toggle="tooltip"
                                    data-popup="tooltip-custom"
                                    data-bs-placement="top"
                                    :title="admin.fullName"
                                    class="avatar avatar-sm pull-up"
                                >
                                    <img class="rounded-circle" src="/img/admin.png" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1">{{ __(role.name) }}</h4>
                                <a
                                    v-if="role.can.edit"
                                    @click="editRole(role)"
                                    data-bs-target="#editRoleModal"
                                    data-bs-toggle="modal"
                                    class="role-add-modal mb-2 text-nowrap add-new-role text-primary cursor-pointer"
                                >
                                    {{ __('Edit') }}
                                </a>
                            </div>
                            <Link v-if="role.can.delete" :href="route('admin.roles.destroy', role.id)" method="DELETE" as="span" class="text-muted cursor-pointer"
                                ><i class="ti ti-trash ti-sm"></i
                            ></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" v-if="roles.can_create">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="/assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-2 text-nowrap add-new-role">
                                    {{ __('Add New Role') }}
                                </button>
                                <p class="mb-0 mt-1">{{ __('Add role, if it does not exist') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->

        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" ref="addFormClose" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2">{{ __('Add new role') }}</h3>
                        </div>
                        <!-- Add role form -->
                        <form
                            class="row g-3"
                            @submit.prevent="
                                addForm.post(route('admin.roles.store'), {
                                    onSuccess: () => {
                                        addForm.reset();
                                        this.$refs.addFormClose.click();
                                    },
                                })
                            "
                        >
                            <div class="col-12 mb-4">
                                <label class="form-label" for="modalRoleName">{{ __('Role Name') }}</label>
                                <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" :placeholder="__('Enter a role name')" v-model="addForm.name" />
                                <span class="text fs-6 text-danger" v-if="addForm.errors.name">{{ addForm.errors.name }}</span>
                            </div>
                            <div class="col-12">
                                <h5>{{ __('Role Permissions') }}</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-semibold" colspan="2">
                                                    {{ __('Access') }}
                                                    <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Roles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="listRole" v-model="addForm.permissions['viewAny-role']" />
                                                            <label class="form-check-label" for="listRole"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createRole" v-model="addForm.permissions['create-role']" />
                                                            <label class="form-check-label" for="createRole"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateRole" v-model="addForm.permissions['update-role']" />
                                                            <label class="form-check-label" for="updateRole"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="deleteRole" v-model="addForm.permissions['delete-role']" />
                                                            <label class="form-check-label" for="deleteRole"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Admins management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="listAdmin" v-model="addForm.permissions['viewAny-admin']" />
                                                            <label class="form-check-label" for="listAdmin"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createAdmin" v-model="addForm.permissions['create-admin']" />
                                                            <label class="form-check-label" for="createAdmin"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateAdmin" v-model="addForm.permissions['update-admin']" />
                                                            <label class="form-check-label" for="updateAdmin"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="deleteAdmin" v-model="addForm.permissions['delete-admin']" />
                                                            <label class="form-check-label" for="deleteAdmin"> {{ __('Delete') }} </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="notifyAdmin" v-model="addForm.permissions['notify-admin']" />
                                                            <label class="form-check-label" for="notifyAdmin"> {{ __('Notify') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->
                                            <tr>
                                                <td rowspan="3" class="text-nowrap fw-semibold">{{ __('Members management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="allMembers" v-model="addForm.permissions['viewAny-member']" />
                                                            <label class="form-check-label" for="allMembers"> {{ __('Members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="branchMembers" v-model="addForm.permissions['branch-member']" />
                                                            <label class="form-check-label" for="branchMembers"> {{ __('Branch approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="acceptanceMembers" v-model="addForm.permissions['acceptance-member']" />
                                                            <label class="form-check-label" for="acceptanceMembers"> {{ __('Admin approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="refusedMembers" v-model="addForm.permissions['refused-member']" />
                                                            <label class="form-check-label" for="refusedMembers"> {{ __('Refused members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="invoices" v-model="addForm.permissions['manage-invoice']" />
                                                            <label class="form-check-label" for="invoices"> {{ __('Invoices') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="exportMembers" v-model="addForm.permissions['export-member']" />
                                                            <label class="form-check-label" for="exportMembers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="showMember" v-model="addForm.permissions['view-member']" />
                                                            <label class="form-check-label" for="showMember"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createMember" v-model="addForm.permissions['create-member']" />
                                                            <label class="form-check-label" for="createMember"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateMember" v-model="addForm.permissions['update-member']" />
                                                            <label class="form-check-label" for="updateMember"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="deleteMember" v-model="addForm.permissions['delete-member']" />
                                                            <label class="form-check-label" for="deleteMember"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="notifyMembers" v-model="addForm.permissions['notify-member']" />
                                                            <label class="form-check-label" for="notifyMembers"> {{ __('Notify') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="toggleMember" v-model="addForm.permissions['toggle-member']" />
                                                            <label class="form-check-label" for="toggleMember"> {{ __('Disable / Enable') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="acceptMember" v-model="addForm.permissions['accept-member']" />
                                                            <label class="form-check-label" for="acceptMember"> {{ __('Admin accept') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="approveMember" v-model="addForm.permissions['approve-member']" />
                                                            <label class="form-check-label" for="approveMember"> {{ __('Branch approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="disapproveMember" v-model="addForm.permissions['disapprove-member']" />
                                                            <label class="form-check-label" for="disapproveMember"> {{ __('Disapprove / Unrefuse') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="refuseMember" v-model="addForm.permissions['refuse-member']" />
                                                            <label class="form-check-label" for="refuseMember"> {{ __('Refuse') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->
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
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->

        <!-- Edit Role Modal -->
        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-edit-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" ref="editFormClose" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2">{{ __('Edit role') }}</h3>
                        </div>
                        <!-- Edit role form -->
                        <form
                            class="row g-3"
                            @submit.prevent="
                                editForm.put(route('admin.roles.update', editForm.id), {
                                    onSuccess: () => {
                                        this.$refs.editFormClose.click();
                                    },
                                })
                            "
                        >
                            <div class="col-12 mb-4">
                                <label class="form-label" for="modalRoleName">{{ __('Role Name') }}</label>
                                <input
                                    type="text"
                                    id="modalRoleName"
                                    name="modalRoleName"
                                    class="form-control"
                                    :placeholder="__('Enter a role name')"
                                    v-model="editForm.name"
                                    :disabled="editForm.id <= 3"
                                />
                                <span class="text text-danger" v-if="editForm.errors.name">{{ editForm.errors.name }}</span>
                            </div>
                            <div class="col-12">
                                <h5>{{ __('Role Permissions') }}</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-semibold" colspan="2">
                                                    {{ __('Access') }}
                                                    <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Roles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistRole" v-model="editForm.permissions['viewAny-role']" />
                                                            <label class="form-check-label" for="editlistRole"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateRole" v-model="editForm.permissions['create-role']" />
                                                            <label class="form-check-label" for="editcreateRole"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateRole" v-model="editForm.permissions['update-role']" />
                                                            <label class="form-check-label" for="editupdateRole"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteRole" v-model="editForm.permissions['delete-role']" />
                                                            <label class="form-check-label" for="editdeleteRole"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Admins management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistAdmin" v-model="editForm.permissions['viewAny-admin']" />
                                                            <label class="form-check-label" for="editlistAdmin"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateAdmin" v-model="editForm.permissions['create-admin']" />
                                                            <label class="form-check-label" for="editcreateAdmin"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateAdmin" v-model="editForm.permissions['update-admin']" />
                                                            <label class="form-check-label" for="editupdateAdmin"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteAdmin" v-model="editForm.permissions['delete-admin']" />
                                                            <label class="form-check-label" for="editdeleteAdmin"> {{ __('Delete') }} </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="editnotifyAdmin" v-model="editForm.permissions['notify-admin']" />
                                                            <label class="form-check-label" for="editnotifyAdmin"> {{ __('Notify') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->
                                            <tr>
                                                <td rowspan="3" class="text-nowrap fw-semibold">{{ __('Members management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editallMembers" v-model="editForm.permissions['viewAny-member']" />
                                                            <label class="form-check-label" for="editallMembers"> {{ __('Members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editbranchMembers" v-model="editForm.permissions['branch-member']" />
                                                            <label class="form-check-label" for="editbranchMembers"> {{ __('Branch approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editacceptanceMembers" v-model="editForm.permissions['acceptance-member']" />
                                                            <label class="form-check-label" for="editacceptanceMembers"> {{ __('Admin approval') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editrefusedMembers" v-model="editForm.permissions['refused-member']" />
                                                            <label class="form-check-label" for="editrefusedMembers"> {{ __('Refused members') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editInvoices" v-model="editForm.permissions['manage-invoice']" />
                                                            <label class="form-check-label" for="editInvoices"> {{ __('Invoices') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editexportMembers" v-model="editForm.permissions['export-member']" />
                                                            <label class="form-check-label" for="editexportMembers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editshowMember" v-model="editForm.permissions['view-member']" />
                                                            <label class="form-check-label" for="editshowMember"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateMember" v-model="editForm.permissions['create-member']" />
                                                            <label class="form-check-label" for="editcreateMember"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateMember" v-model="editForm.permissions['update-member']" />
                                                            <label class="form-check-label" for="editupdateMember"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteMember" v-model="editForm.permissions['delete-member']" />
                                                            <label class="form-check-label" for="editdeleteMember"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editnotifyMembers" v-model="editForm.permissions['notify-member']" />
                                                            <label class="form-check-label" for="editnotifyMembers"> {{ __('Notify') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="edittoggleMember" v-model="editForm.permissions['toggle-member']" />
                                                            <label class="form-check-label" for="edittoggleMember"> {{ __('Disable / Enable') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editacceptMember" v-model="editForm.permissions['accept-member']" />
                                                            <label class="form-check-label" for="editacceptMember"> {{ __('Admin accept') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editapproveMember" v-model="editForm.permissions['approve-member']" />
                                                            <label class="form-check-label" for="editapproveMember"> {{ __('Branch approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdisapproveMember" v-model="editForm.permissions['disapprove-member']" />
                                                            <label class="form-check-label" for="editdisapproveMember"> {{ __('Disapprove / Unrefuse') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editrefuseMember" v-model="editForm.permissions['refuse-member']" />
                                                            <label class="form-check-label" for="editrefuseMember"> {{ __('Refuse') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Members permission -->
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
                        <!--/ Edit role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit Role Modal -->
    </div>
</template>
