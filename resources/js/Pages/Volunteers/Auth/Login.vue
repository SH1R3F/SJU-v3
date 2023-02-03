<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    password: '',
});
</script>

<template>
    <Head :title="__('Volunteers login')" />
    <div class="users site-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="signing-form">
                        <h5>{{ __('Volunteers login') }}</h5>
                        <form @submit.prevent="form.post(route('volunteer.login'))">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email" v-model="form.email" :placeholder="__('Email')" required />
                                <p class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</p>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control" id="password" v-model="form.password" :placeholder="__('Password')" required />
                                <Link :href="route('volunteer.password.request')" class="text-muted form-text">{{ __('Forgot your password?') }}</Link>
                                <p class="text text-danger text-sm" v-if="form.errors.password">{{ form.errors.password }}</p>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">{{ __('login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="signing-intro">
                        <div>
                            <i class="fas fa-user-edit"></i>
                            <h4>{{ __('Register new volunteer') }}</h4>
                            <p>{{ __('You can register as a new volunteer through the following link') }}</p>
                            <Link :href="route('volunteer.register')">{{ __('Click here to register') }}</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
export default {
    mounted() {},
};
</script>
