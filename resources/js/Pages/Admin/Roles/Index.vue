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
            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
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
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-role">
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
