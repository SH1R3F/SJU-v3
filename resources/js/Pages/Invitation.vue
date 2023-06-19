<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    invitation: Object,
});

const form = useForm({
    name: '',
    email: '',
});
</script>

<template>
    <Head>
        <title>{{ __('Invitation') }}</title>
    </Head>
    <img alt="هيئة الصحفيين السعوديين" src="/img/navs-top.png" class="w-100" style="height: 90px" />
    <div style="min-height: calc(100vh - 180px)" class="d-flex align-items-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto text-center">
                    <img alt="هيئة الصحفيين السعوديين" src="/img/logo.png" class="w-100" style="max-width: 200px" />
                </div>
                <div class="mx-auto col-12 col-md-6 text-center">
                    <div>
                        <h3 class="my-3">{{ invitation.welcome_message }} ( {{ invitation.name }} )</h3>
                        <div class="col-sm-12 mx-auto">
                            <form @submit.prevent="form.post(route('invitate.store', invitation.id))">
                                <div class="form-group">
                                    <input type="text" v-model="form.name" class="form-control text-center btn-lg"
                                        placeholder="الاسم" autofocus required />
                                    <p class="text text-danger text-sm" v-if="form.errors.name">{{ form.errors.name }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="email" v-model="form.email" class="form-control text-center btn-lg"
                                        placeholder="البريد الإلكتروني" autofocus required />
                                    <p class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</p>
                                </div>
                                <button type="submit" class="btn btn-success btn-block btn-lg"
                                    :disabled="form.processing">تحميل</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="height: 90px">
        <img alt="هيئة الصحفيين السعوديين" src="/img/navs-buttom.png" class="w-100 h-100" />
    </footer>
</template>

<script>
export default {
    layout: null,
};
</script>
