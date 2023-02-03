<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
});
</script>

<template>
    <Head :title="__('Forgot your password?')" />
    <div class="users site-login">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="signing-form">
                        <h5>{{ __('Forgot your password?') }}</h5>
                        <form @submit.prevent="form.post(route('subscriber.password.email'))">
                            <div class="form-row mb-3">
                                <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Email') }}</label>
                                <div class="col-lg-6">
                                    <input type="email" name="email" v-model="form.email" class="form-control form-control-lg" style="direction: ltr" required />
                                    <p class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <input type="submit" :value="__('Send')" class="btn btn-success" />
                                <Link :href="route('subscriber.login')" class="btn btn-default">{{ __('Login') }}</Link>
                            </div>
                        </form>
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
