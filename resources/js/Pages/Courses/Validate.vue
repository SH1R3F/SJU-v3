<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    code: '',
});
</script>

<template>
    <Head :title="__('Validate certificate')" />
    <div class="users site-login">
        <div class="container">
            <div class="signing-form">
                <h5>{{ __('Validate certificate') }}</h5>

                <form @submit.prevent="form.post(route('verify-certificate'))">
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="font-weight-bold text-dark text-2">{{ __('Please enter the code on the certificate') }}</label>
                            <input type="text" name="certcode" id="certcode" class="form-control form-control-lg" v-model="form.code" style="direction: ltr" required="" />
                            <p class="text text-danger" v-if="form.errors.code">{{ form.errors.code }}</p>
                        </div>
                    </div>

                    <div class="text-start">
                        <input type="submit" :value="__('Verify')" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script defer>
import { useForm } from '@inertiajs/inertia-vue3';
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() {},
};
</script>
