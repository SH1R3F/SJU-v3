<script setup>
import Sidebar from '../Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import NavTabs from './NavTabs.vue';

const form = useForm({
    password: '',
    new_password: '',
    new_password_confirmation: '',
});
</script>

<template>
    <Head :title="__('Change password')" />
    <div class="users">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <!-- page content -->
                    <div class="registration-form">
                        <nav-tabs />

                        <!-- Tab content -->
                        <div class="tab-content text-start" id="myTabContent">
                            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                                <form
                                    @submit.prevent="
                                        form.post(route('volunteer.profile.password'), {
                                            onSuccess() {
                                                form.reset();
                                            },
                                        })
                                    "
                                >
                                    <div class="form-group row">
                                        <label class="col-lg-3">{{ __('Old password') }}</label>
                                        <div class="col-lg-6">
                                            <input type="password" autocomplete="off" v-model="form.password" class="form-control" style="direction: ltr" placeholder="********" />
                                            <p class="text text-danger text-sm" v-if="form.errors.password">{{ form.errors.password }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3">{{ __('New password') }}</label>
                                        <div class="col-lg-6">
                                            <input type="password" autocomplete="off" v-model="form.new_password" class="form-control" style="direction: ltr" placeholder="********" />
                                            <p class="text text-danger text-sm" v-if="form.errors.new_password">{{ form.errors.new_password }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3">{{ __('Password confirmation') }}</label>
                                        <div class="col-lg-6">
                                            <input type="password" autocomplete="off" v-model="form.new_password_confirmation" class="form-control" style="direction: ltr" placeholder="********" />
                                            <p class="text text-danger text-sm" v-if="form.errors.new_password_confirmation">{{ form.errors.new_password_confirmation }}</p>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">{{ __('Change password') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Tab content -->
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
