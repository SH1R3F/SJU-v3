<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    national_id: '',
    password: '',
});
</script>

<template>
    <Head :title="__('Login')" />
    <div class="members site-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="signing-form">
                        <h5>{{ __('Members login') }}</h5>
                        <form @submit.prevent="form.post(route('member.login'))">
                            <div class="form-group">
                                <label for="nid">{{ __('National ID number') }}</label>
                                <input type="text" v-model="form.national_id" class="form-control" id="nid" :placeholder="__('National ID number')" />
                                <span class="text text-danger text-sm" v-if="form.errors.national_id">{{ form.errors.national_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="pass">{{ __('Password') }}</label>
                                <input type="password" v-model="form.password" class="form-control" id="pass" placeholder="********" />
                                <span class="text text-danger text-sm" v-if="form.errors.password">{{ form.errors.password }}</span>
                                <Link :href="route('member.password.request')" class="text-muted form-text">{{ __('Forgot your password?') }}</Link>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="signing-intro">
                        <div>
                            <i class="fas fa-user-edit"></i>

                            <h4>{{ __('New membership') }}</h4>

                            <p>{{ __('You can register for membership through the following link') }}</p>

                            <Link :href="route('member.register')">{{ __('Click here to register') }}</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
