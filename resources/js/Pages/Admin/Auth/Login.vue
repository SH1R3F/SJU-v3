<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    username: '',
    password: '',
    remember: false,
});
</script>

<script>
export default {
    layout: null,
};
</script>

<template>
    <Head>
        <title>{{ __('Login') }}</title>
        <link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />
    </Head>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-1 pt-2">{{ __('Welcome to Journalists association') }} 👋</h4>

                        <form class="mb-3" @submit.prevent="form.post(route('admin.login'))">
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="username" name="username" :placeholder="__('Enter your username')" v-model="form.username" autofocus />
                                <span class="text text-danger fs-6" v-if="form.errors.username">{{ form.errors.username }}</span>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        aria-describedby="password"
                                        :placeholder="__('Enter your password')"
                                        v-model="form.password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" v-model="form.remember" />
                                    <label class="form-check-label" for="remember-me"> {{ __('Remember Me') }} </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Sign in') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
</template>
