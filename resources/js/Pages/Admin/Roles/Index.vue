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
                                    v-for="admin in role.admins.slice(0, 4)"
                                    :key="admin.id"
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
                                <img
                                    src="/assets/img/illustrations/auth-reset-password-illustration-light.png"
                                    class="img-fluid mt-sm-4 mt-md-0"
                                    style="object-fit: cover"
                                    alt="add-new-roles"
                                    width="120"
                                />
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
                                        $refs.addFormClose.click();
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
                                                    <i class="ti ti-info-circle" data-bs-placement="top"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Site options') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="manageOptions" v-model="addForm.permissions['manage-site-options']" />
                                                            <label class="form-check-label" for="manageOptions"> {{ __('Manage') }} </label>
                                                        </div>
                                                    </div>
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
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Employees management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="listEmployee" v-model="addForm.permissions['viewAny-employee']" />
                                                            <label class="form-check-label" for="listEmployee"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createEmployee" v-model="addForm.permissions['create-employee']" />
                                                            <label class="form-check-label" for="createEmployee"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateEmployee" v-model="addForm.permissions['update-employee']" />
                                                            <label class="form-check-label" for="updateEmployee"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="deleteEmployee" v-model="addForm.permissions['delete-employee']" />
                                                            <label class="form-check-label" for="deleteEmployee"> {{ __('Delete') }} </label>
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
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="transactions" v-model="addForm.permissions['manage-transaction']" />
                                                            <label class="form-check-label" for="transactions"> {{ __('Payment attempts') }} </label>
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
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="setPaid" v-model="addForm.permissions['pay-member']" />
                                                            <label class="form-check-label" for="setPaid"> {{ __('Set paid') }} </label>
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

                                            <!-- Subscribers permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Subscribers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="viewAnySubscriber" v-model="addForm.permissions['viewAny-subscriber']" />
                                                            <label class="form-check-label" for="viewAnySubscriber"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="exportSubscribers" v-model="addForm.permissions['export-subscriber']" />
                                                            <label class="form-check-label" for="exportSubscribers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="showSubscriber" v-model="addForm.permissions['view-subscriber']" />
                                                            <label class="form-check-label" for="showSubscriber"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createSubscriber" v-model="addForm.permissions['create-subscriber']" />
                                                            <label class="form-check-label" for="createSubscriber"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateSubscriber" v-model="addForm.permissions['update-subscriber']" />
                                                            <label class="form-check-label" for="updateSubscriber"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="deleteSubscriber" v-model="addForm.permissions['delete-subscriber']" />
                                                            <label class="form-check-label" for="deleteSubscriber"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Subscribers permission -->

                                            <!-- Volunteers permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Volunteers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="viewAnyVolunteer" v-model="addForm.permissions['viewAny-volunteer']" />
                                                            <label class="form-check-label" for="viewAnyVolunteer"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="exportVolunteers" v-model="addForm.permissions['export-volunteer']" />
                                                            <label class="form-check-label" for="exportVolunteers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="showVolunteer" v-model="addForm.permissions['view-volunteer']" />
                                                            <label class="form-check-label" for="showVolunteer"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="createVolunteer" v-model="addForm.permissions['create-volunteer']" />
                                                            <label class="form-check-label" for="createVolunteer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="updateVolunteer" v-model="addForm.permissions['update-volunteer']" />
                                                            <label class="form-check-label" for="updateVolunteer"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="deleteVolunteer" v-model="addForm.permissions['delete-volunteer']" />
                                                            <label class="form-check-label" for="deleteVolunteer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Volunteers permission -->

                                            <!-- Courses permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Courses management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistCourse" v-model="addForm.permissions['viewAny-course']" />
                                                            <label class="form-check-label" for="addlistCourse"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateCourse" v-model="addForm.permissions['create-course']" />
                                                            <label class="form-check-label" for="addcreateCourse"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateCourse" v-model="addForm.permissions['update-course']" />
                                                            <label class="form-check-label" for="addupdateCourse"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteCourse" v-model="addForm.permissions['delete-course']" />
                                                            <label class="form-check-label" for="adddeleteCourse"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Courses permission -->

                                            <!-- Templates permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Templates management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistTemplate" v-model="addForm.permissions['viewAny-template']" />
                                                            <label class="form-check-label" for="addlistTemplate"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateTemplate" v-model="addForm.permissions['create-template']" />
                                                            <label class="form-check-label" for="addcreateTemplate"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateTemplate" v-model="addForm.permissions['update-template']" />
                                                            <label class="form-check-label" for="addupdateTemplate"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteTemplate" v-model="addForm.permissions['delete-template']" />
                                                            <label class="form-check-label" for="adddeleteTemplate"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Templates permission -->

                                            <!-- Questionnaires permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Questionnaires management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistQuestionnaire" v-model="addForm.permissions['viewAny-questionnaire']" />
                                                            <label class="form-check-label" for="addlistQuestionnaire"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addviewQuestionnaire" v-model="addForm.permissions['view-questionnaire']" />
                                                            <label class="form-check-label" for="addviewQuestionnaire"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateQuestionnaire" v-model="addForm.permissions['create-questionnaire']" />
                                                            <label class="form-check-label" for="addcreateQuestionnaire"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateQuestionnaire" v-model="addForm.permissions['update-questionnaire']" />
                                                            <label class="form-check-label" for="addupdateQuestionnaire"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteQuestionnaire" v-model="addForm.permissions['delete-questionnaire']" />
                                                            <label class="form-check-label" for="adddeleteQuestionnaire"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Questionnaires permission -->

                                            <!-- Pages permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Pages management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistPage" v-model="addForm.permissions['viewAny-page']" />
                                                            <label class="form-check-label" for="addlistPage"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreatePage" v-model="addForm.permissions['create-page']" />
                                                            <label class="form-check-label" for="addcreatePage"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdatePage" v-model="addForm.permissions['update-page']" />
                                                            <label class="form-check-label" for="addupdatePage"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeletePage" v-model="addForm.permissions['delete-page']" />
                                                            <label class="form-check-label" for="adddeletePage"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Pages permission -->

                                            <!-- Articles permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Articles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistArticle" v-model="addForm.permissions['viewAny-article']" />
                                                            <label class="form-check-label" for="addlistArticle"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addviewArticle" v-model="addForm.permissions['view-article']" />
                                                            <label class="form-check-label" for="addviewArticle"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateArticle" v-model="addForm.permissions['create-article']" />
                                                            <label class="form-check-label" for="addcreateArticle"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateArticle" v-model="addForm.permissions['update-article']" />
                                                            <label class="form-check-label" for="addupdateArticle"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteArticle" v-model="addForm.permissions['delete-article']" />
                                                            <label class="form-check-label" for="adddeleteArticle"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Articles permission -->

                                            <!-- Ads permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Ads management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistAd" v-model="addForm.permissions['viewAny-ad']" />
                                                            <label class="form-check-label" for="addlistAd"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateAd" v-model="addForm.permissions['create-ad']" />
                                                            <label class="form-check-label" for="addcreateAd"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateAd" v-model="addForm.permissions['update-ad']" />
                                                            <label class="form-check-label" for="addupdateAd"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteAd" v-model="addForm.permissions['delete-ad']" />
                                                            <label class="form-check-label" for="adddeleteAd"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Ads permission -->

                                            <!-- Urls permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Urls management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistUrl" v-model="addForm.permissions['viewAny-url']" />
                                                            <label class="form-check-label" for="addlistUrl"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateUrl" v-model="addForm.permissions['create-url']" />
                                                            <label class="form-check-label" for="addcreateUrl"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateUrl" v-model="addForm.permissions['update-url']" />
                                                            <label class="form-check-label" for="addupdateUrl"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteUrl" v-model="addForm.permissions['delete-url']" />
                                                            <label class="form-check-label" for="adddeleteUrl"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Urls permission -->

                                            <!-- Studio permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Studio management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistMedia" v-model="addForm.permissions['viewAny-media']" />
                                                            <label class="form-check-label" for="addlistMedia"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateMedia" v-model="addForm.permissions['create-media']" />
                                                            <label class="form-check-label" for="addcreateMedia"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteMedia" v-model="addForm.permissions['delete-media']" />
                                                            <label class="form-check-label" for="adddeleteMedia"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Studio permission -->

                                            <!-- Technical support -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Technical support') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistSupportmanager" v-model="addForm.permissions['managers-ticket']" />
                                                            <label class="form-check-label" for="addlistSupportmanager"> {{ __('List managers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistSupportmember" v-model="addForm.permissions['members-ticket']" />
                                                            <label class="form-check-label" for="addlistSupportmember"> {{ __('List members tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistSupportsubscriber" v-model="addForm.permissions['subscribers-ticket']" />
                                                            <label class="form-check-label" for="addlistSupportsubscriber"> {{ __('List subscribers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistSupportvolunteer" v-model="addForm.permissions['volunteers-ticket']" />
                                                            <label class="form-check-label" for="addlistSupportvolunteer"> {{ __('List volunteers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addViewTicket" v-model="addForm.permissions['view-ticket']" />
                                                            <label class="form-check-label" for="addViewTicket"> {{ __('View ticket') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteTicket" v-model="addForm.permissions['delete-ticket']" />
                                                            <label class="form-check-label" for="adddeleteTicket"> {{ __('Delete ticket') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Technical support -->

                                            <!-- Invitations permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Invitations management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistInvitation" v-model="addForm.permissions['viewAny-invitation']" />
                                                            <label class="form-check-label" for="addlistInvitation"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addviewInvitation" v-model="addForm.permissions['view-invitation']" />
                                                            <label class="form-check-label" for="addviewInvitation"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateInvitation" v-model="addForm.permissions['create-invitation']" />
                                                            <label class="form-check-label" for="addcreateInvitation"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateInvitation" v-model="addForm.permissions['update-invitation']" />
                                                            <label class="form-check-label" for="addupdateInvitation"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteInvitation" v-model="addForm.permissions['delete-invitation']" />
                                                            <label class="form-check-label" for="adddeleteInvitation"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Invitations permission -->

                                            <!-- Training bags permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Training bag') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistFile" v-model="addForm.permissions['viewAny-file']" />
                                                            <label class="form-check-label" for="addlistFile"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateFile" v-model="addForm.permissions['create-file']" />
                                                            <label class="form-check-label" for="addcreateFile"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteFile" v-model="addForm.permissions['delete-file']" />
                                                            <label class="form-check-label" for="adddeleteFile"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Training bags permission -->

                                            <!-- Member transfers permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Member transfers') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistTransfer" v-model="addForm.permissions['viewAny-transfer']" />
                                                            <label class="form-check-label" for="addlistTransfer"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateTransfer" v-model="addForm.permissions['create-transfer']" />
                                                            <label class="form-check-label" for="addcreateTransfer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateTransfer" v-model="addForm.permissions['update-transfer']" />
                                                            <label class="form-check-label" for="addupdateTransfer"> {{ __('Approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteTransfer" v-model="addForm.permissions['delete-transfer']" />
                                                            <label class="form-check-label" for="adddeleteTransfer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Member transfers permission -->

                                            <!-- Competitions permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Competitions') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistCompetition" v-model="addForm.permissions['viewAny-competition']" />
                                                            <label class="form-check-label" for="addlistCompetition"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateCompetition" v-model="addForm.permissions['create-competition']" />
                                                            <label class="form-check-label" for="addcreateCompetition"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addupdateCompetition" v-model="addForm.permissions['update-competition']" />
                                                            <label class="form-check-label" for="addupdateCompetition"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteCompetition" v-model="addForm.permissions['delete-competition']" />
                                                            <label class="form-check-label" for="adddeleteCompetition"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Competitions permission -->


                                            <!-- Elections permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Candidates management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addlistCandidate" v-model="addForm.permissions['viewAny-candidate']" />
                                                            <label class="form-check-label" for="addlistCandidate"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="addcreateCandidate" v-model="addForm.permissions['create-candidate']" />
                                                            <label class="form-check-label" for="addcreateCandidate"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="adddeleteCandidate" v-model="addForm.permissions['delete-candidate']" />
                                                            <label class="form-check-label" for="adddeleteCandidate"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Elections permission -->

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
                                        $refs.editFormClose.click();
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
                                                    <i class="ti ti-info-circle" data-bs-placement="top"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Site options') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="manageOptions" v-model="editForm.permissions['manage-site-options']" />
                                                            <label class="form-check-label" for="manageOptions"> {{ __('Manage') }} </label>
                                                        </div>
                                                    </div>
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
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Employees management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistEmployee" v-model="editForm.permissions['viewAny-employee']" />
                                                            <label class="form-check-label" for="editlistEmployee"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateEmployee" v-model="editForm.permissions['create-employee']" />
                                                            <label class="form-check-label" for="editcreateEmployee"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateEmployee" v-model="editForm.permissions['update-employee']" />
                                                            <label class="form-check-label" for="editupdateEmployee"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteEmployee" v-model="editForm.permissions['delete-employee']" />
                                                            <label class="form-check-label" for="editdeleteEmployee"> {{ __('Delete') }} </label>
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
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editTransactions" v-model="editForm.permissions['manage-transaction']" />
                                                            <label class="form-check-label" for="editTransactions"> {{ __('Payment attempts') }} </label>
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
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editSetPaid" v-model="editForm.permissions['pay-member']" />
                                                            <label class="form-check-label" for="editSetPaid"> {{ __('Set paid') }} </label>
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

                                            <!-- Subscribers permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Subscribers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editSubscribers" v-model="editForm.permissions['viewAny-subscriber']" />
                                                            <label class="form-check-label" for="editSubscribers"> {{ __('Subscribers') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editexportSubscribers" v-model="editForm.permissions['export-subscriber']" />
                                                            <label class="form-check-label" for="editexportSubscribers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editshowSubscriber" v-model="editForm.permissions['view-subscriber']" />
                                                            <label class="form-check-label" for="editshowSubscriber"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateSubscriber" v-model="editForm.permissions['create-subscriber']" />
                                                            <label class="form-check-label" for="editcreateSubscriber"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateSubscriber" v-model="editForm.permissions['update-subscriber']" />
                                                            <label class="form-check-label" for="editupdateSubscriber"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteSubscriber" v-model="editForm.permissions['delete-subscriber']" />
                                                            <label class="form-check-label" for="editdeleteSubscriber"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Subscribers permission -->

                                            <!-- Volunteers permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Volunteers management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editVolunteers" v-model="editForm.permissions['viewAny-volunteer']" />
                                                            <label class="form-check-label" for="editVolunteers"> {{ __('Volunteers') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editexportVolunteers" v-model="editForm.permissions['export-volunteer']" />
                                                            <label class="form-check-label" for="editexportVolunteers"> {{ __('Export') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editshowVolunteer" v-model="editForm.permissions['view-volunteer']" />
                                                            <label class="form-check-label" for="editshowVolunteer"> {{ __('Show') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateVolunteer" v-model="editForm.permissions['create-volunteer']" />
                                                            <label class="form-check-label" for="editcreateVolunteer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateVolunteer" v-model="editForm.permissions['update-volunteer']" />
                                                            <label class="form-check-label" for="editupdateVolunteer"> {{ __('Update') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteVolunteer" v-model="editForm.permissions['delete-volunteer']" />
                                                            <label class="form-check-label" for="editdeleteVolunteer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Volunteers permission -->

                                            <!-- Courses permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Courses management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistCourse" v-model="editForm.permissions['viewAny-course']" />
                                                            <label class="form-check-label" for="editlistCourse"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateCourse" v-model="editForm.permissions['create-course']" />
                                                            <label class="form-check-label" for="editcreateCourse"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateCourse" v-model="editForm.permissions['update-course']" />
                                                            <label class="form-check-label" for="editupdateCourse"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteCourse" v-model="editForm.permissions['delete-course']" />
                                                            <label class="form-check-label" for="editdeleteCourse"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Courses permission -->

                                            <!-- Templates permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Templates management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistTemplate" v-model="editForm.permissions['viewAny-template']" />
                                                            <label class="form-check-label" for="editlistTemplate"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateTemplate" v-model="editForm.permissions['create-template']" />
                                                            <label class="form-check-label" for="editcreateTemplate"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateTemplate" v-model="editForm.permissions['update-template']" />
                                                            <label class="form-check-label" for="editupdateTemplate"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTemplate" v-model="editForm.permissions['delete-template']" />
                                                            <label class="form-check-label" for="editdeleteTemplate"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Templates permission -->

                                            <!-- Questionnaires permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Questionnaires management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistQuestionnaire" v-model="editForm.permissions['viewAny-questionnaire']" />
                                                            <label class="form-check-label" for="editlistQuestionnaire"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editviewQuestionnaire" v-model="editForm.permissions['view-questionnaire']" />
                                                            <label class="form-check-label" for="editviewQuestionnaire"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateQuestionnaire" v-model="editForm.permissions['create-questionnaire']" />
                                                            <label class="form-check-label" for="editcreateQuestionnaire"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateQuestionnaire" v-model="editForm.permissions['update-questionnaire']" />
                                                            <label class="form-check-label" for="editupdateQuestionnaire"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteQuestionnaire" v-model="editForm.permissions['delete-questionnaire']" />
                                                            <label class="form-check-label" for="editdeleteQuestionnaire"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Questionnaires permission -->

                                            <!-- Pages permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Pages management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistPage" v-model="editForm.permissions['viewAny-page']" />
                                                            <label class="form-check-label" for="editlistPage"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreatePage" v-model="editForm.permissions['create-page']" />
                                                            <label class="form-check-label" for="editcreatePage"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdatePage" v-model="editForm.permissions['update-page']" />
                                                            <label class="form-check-label" for="editupdatePage"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeletePage" v-model="editForm.permissions['delete-page']" />
                                                            <label class="form-check-label" for="editdeletePage"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Pages permission -->

                                            <!-- Articles permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Articles management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistArticle" v-model="editForm.permissions['viewAny-article']" />
                                                            <label class="form-check-label" for="editlistArticle"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editviewArticle" v-model="editForm.permissions['view-article']" />
                                                            <label class="form-check-label" for="editviewArticle"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateArticle" v-model="editForm.permissions['create-article']" />
                                                            <label class="form-check-label" for="editcreateArticle"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateArticle" v-model="editForm.permissions['update-article']" />
                                                            <label class="form-check-label" for="editupdateArticle"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteArticle" v-model="editForm.permissions['delete-article']" />
                                                            <label class="form-check-label" for="editdeleteArticle"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Articles permission -->

                                            <!-- Ads permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Ads management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistAd" v-model="editForm.permissions['viewAny-ad']" />
                                                            <label class="form-check-label" for="editlistAd"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateAd" v-model="editForm.permissions['create-ad']" />
                                                            <label class="form-check-label" for="editcreateAd"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateAd" v-model="editForm.permissions['update-ad']" />
                                                            <label class="form-check-label" for="editupdateAd"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteAd" v-model="editForm.permissions['delete-ad']" />
                                                            <label class="form-check-label" for="editdeleteAd"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Ads permission -->

                                            <!-- Urls permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Urls management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistUrl" v-model="editForm.permissions['viewAny-url']" />
                                                            <label class="form-check-label" for="editlistUrl"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateUrl" v-model="editForm.permissions['create-url']" />
                                                            <label class="form-check-label" for="editcreateUrl"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateUrl" v-model="editForm.permissions['update-url']" />
                                                            <label class="form-check-label" for="editupdateUrl"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteUrl" v-model="editForm.permissions['delete-url']" />
                                                            <label class="form-check-label" for="editdeleteUrl"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Urls permission -->

                                            <!-- Studio permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Studio management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistMedia" v-model="editForm.permissions['viewAny-media']" />
                                                            <label class="form-check-label" for="editlistMedia"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateMedia" v-model="editForm.permissions['create-media']" />
                                                            <label class="form-check-label" for="editcreateMedia"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteMedia" v-model="editForm.permissions['delete-media']" />
                                                            <label class="form-check-label" for="editdeleteMedia"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Studio permission -->

                                            <!-- Technical support -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Technical support') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2" v-if="editForm.name !== 'Branch manager'">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportmanager" v-model="editForm.permissions['managers-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportmanager"> {{ __('List managers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportmember" v-model="editForm.permissions['members-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportmember"> {{ __('List members tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportsubscriber" v-model="editForm.permissions['subscribers-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportsubscriber"> {{ __('List subscribers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="checkbox" id="editlistSupportvolunteer" v-model="editForm.permissions['volunteers-ticket']" />
                                                            <label class="form-check-label" for="editlistSupportvolunteer"> {{ __('List volunteers tickets') }} </label>
                                                        </div>
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="checkbox" id="editViewTicket" v-model="editForm.permissions['view-ticket']" />
                                                            <label class="form-check-label" for="editViewTicket"> {{ __('View ticket') }} </label>
                                                        </div>
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTicket" v-model="editForm.permissions['delete-ticket']" />
                                                            <label class="form-check-label" for="editdeleteTicket"> {{ __('Delete ticket') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Technical support -->

                                            <!-- Invitations permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Invitations management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistInvitation" v-model="editForm.permissions['viewAny-invitation']" />
                                                            <label class="form-check-label" for="editlistInvitation"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editviewInvitation" v-model="editForm.permissions['view-invitation']" />
                                                            <label class="form-check-label" for="editviewInvitation"> {{ __('View') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateInvitation" v-model="editForm.permissions['create-invitation']" />
                                                            <label class="form-check-label" for="editcreateInvitation"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateInvitation" v-model="editForm.permissions['update-invitation']" />
                                                            <label class="form-check-label" for="editupdateInvitation"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteInvitation" v-model="editForm.permissions['delete-invitation']" />
                                                            <label class="form-check-label" for="editdeleteInvitation"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Invitations permission -->

                                            <!-- Training bag permission -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Training bag') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistFile" v-model="editForm.permissions['viewAny-file']" />
                                                            <label class="form-check-label" for="editlistFile"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateFile" v-model="editForm.permissions['create-file']" />
                                                            <label class="form-check-label" for="editcreateFile"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteFile" v-model="editForm.permissions['delete-file']" />
                                                            <label class="form-check-label" for="editdeleteFile"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Training bag permission -->

                                            <!-- Member transfers -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Member transfers') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistTransfer" v-model="editForm.permissions['viewAny-transfer']" />
                                                            <label class="form-check-label" for="editlistTransfer"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateTransfer" v-model="editForm.permissions['create-transfer']" />
                                                            <label class="form-check-label" for="editcreateTransfer"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateTransfer" v-model="editForm.permissions['update-transfer']" />
                                                            <label class="form-check-label" for="editupdateTransfer"> {{ __('Approve') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteTransfer" v-model="editForm.permissions['delete-transfer']" />
                                                            <label class="form-check-label" for="editdeleteTransfer"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Member transfers -->

                                            <!-- Competitions -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Competitions') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistCompetition" v-model="editForm.permissions['viewAny-competition']" />
                                                            <label class="form-check-label" for="editlistCompetition"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateCompetition" v-model="editForm.permissions['create-competition']" />
                                                            <label class="form-check-label" for="editcreateCompetition"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editupdateCompetition" v-model="editForm.permissions['update-competition']" />
                                                            <label class="form-check-label" for="editupdateCompetition"> {{ __('Edit') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteCompetition" v-model="editForm.permissions['delete-competition']" />
                                                            <label class="form-check-label" for="editdeleteCompetition"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Competitions -->

                                            <!-- Candidates -->
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ __('Candidates management') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editlistCandidate" v-model="editForm.permissions['viewAny-candidate']" />
                                                            <label class="form-check-label" for="editlistCandidate"> {{ __('List') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editcreateCandidate" v-model="editForm.permissions['create-candidate']" />
                                                            <label class="form-check-label" for="editcreateCandidate"> {{ __('Create') }} </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="editdeleteCandidate" v-model="editForm.permissions['delete-candidate']" />
                                                            <label class="form-check-label" for="editdeleteCandidate"> {{ __('Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Candidates -->
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
