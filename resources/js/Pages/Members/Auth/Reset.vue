<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    email: props.email,
    password: '',
    password_confirmation: '',
    token: props.token,
});
</script>

<template>
    <Head :title="__('Change password')" />
    <div class="users site-login">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="signing-form">
                        <h5>{{ __('Change password') }}</h5>
                        <form @submit.prevent="form.post(route('member.password.change'))">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="font-weight-bold text-dark text-2">{{ __('Email') }}</label>
                                    <input type="email" v-model="form.email" id="email" class="form-control form-control-lg" style="direction: ltr" required />
                                    <p class="text text-sm text-danger" v-if="form.errors.email">{{ form.errors.email }}</p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="font-weight-bold text-dark text-2">{{ __('Password') }}</label>
                                    <input type="password" v-model="form.password" id="password" class="form-control form-control-lg" style="direction: ltr" required />
                                    <p class="text text-sm text-danger" v-if="form.errors.password">{{ form.errors.password }}</p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="font-weight-bold text-dark text-2">{{ __('Password confirmation') }}</label>
                                    <input type="password" v-model="form.password_confirmation" id="password_repeat" class="form-control form-control-lg" style="direction: ltr" required="" />
                                    <p class="text text-sm text-danger" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="submit" :value="__('Change')" class="btn btn-success btn-modern float-right" />
                                </div>
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
