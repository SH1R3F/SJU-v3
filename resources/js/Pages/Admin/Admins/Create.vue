<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    roles: Object,
    branches: Object,
});

const form = useForm({
    fname: '',
    lname: '',
    username: '',
    email: '',
    mobile: '',
    branch_id: '',
    role: '',
    password: '',
    password_confirmation: '',
});
</script>

<template>
    <Head :title="__('Create moderator')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-3 col-lg-5 col-md-5">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="/img/admin.png" height="100" width="100" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ `${form.fname} ${form.lname}` }}</h4>
                                    <span class="badge bg-label-secondary mt-1">{{ __(roles.data.find((r) => r.name === form.role)?.name) }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Details') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-1">{{ __('Username') }}:</span>
                                    <span>{{ form.username }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">{{ __('Email') }}:</span>
                                    <span>{{ form.email }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">{{ __('Branch') }}:</span>
                                    <span>{{ branches.data.find((b) => b.id === form.branch_id)?.name }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">{{ __('Mobile') }}:</span>
                                    <span>{{ form.mobile }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-9 col-lg-7 col-md-7">
                <!-- User information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create moderator') }}</h5>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="form.post(route('admin.admins.store'))">
                            <!-- Full name -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="fname">{{ __('First name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname" v-model="form.fname" :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname">{{ form.errors.fname }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="lname">{{ __('Last name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname" v-model="form.lname" :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname">{{ form.errors.lname }}</span>
                                </div>
                            </div>
                            <!-- Full name -->

                            <!-- Username and mobile -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="username">{{ __('Username') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="username" v-model="form.username" :placeholder="__('Username')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.username">{{ form.errors.username }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="mobile">{{ __('Mobile') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="mobile" v-model="form.mobile" :placeholder="__('Mobile')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.mobile">{{ form.errors.mobile }}</span>
                                </div>
                            </div>
                            <!-- Username and mobile -->

                            <!-- Email -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="email" id="email" v-model="form.email" :placeholder="__('Email')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                                </div>
                            </div>
                            <!-- Email -->

                            <!-- Role and branch -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="role" class="form-label">{{ __('Role') }}</label>
                                    <div class="position-relative">
                                        <select v-model="form.role" id="role" class="select2 form-select" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                            <option v-for="role in roles.data" :key="role.id" :value="role.name">{{ __(role.name) }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.role">{{ form.errors.role }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="branch" class="form-label">{{ __('Branch') }}</label>
                                    <div class="position-relative">
                                        <select v-model="form.branch_id" id="branch" class="select2 form-select" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                            <option v-for="branch in branches.data" :key="branch.id" :value="branch.id">{{ __(branch.name) }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</span>
                                </div>
                            </div>
                            <!-- Role and branch -->

                            <!-- Password -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            v-model="form.password"
                                            class="form-control"
                                            type="password"
                                            id="password"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                                </div>

                                <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">{{ __('Password confirmation') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            v-model="form.password_confirmation"
                                            class="form-control"
                                            type="password"
                                            name="confirmPassword"
                                            id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Password -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.admins.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- User information -->
            </div>
            <!--/ User Content -->
        </div>

        <!-- /Modals -->
    </div>
    <!-- / Content -->
</template>
