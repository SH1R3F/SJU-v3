<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
});

const form = useForm({
    password: undefined,
    password_confirmation: undefined,
});
</script>

<template>
    <Head :title="__('Login info')" />
    <div class="container my-4">
        <tab-list active="login" />

        <!-- Page content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                <form class="form-horizontal form-bordered" @submit.prevent="form.post(route('member.register.step6'))">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('National id number') }}</label>
                        <div class="col-lg-4">
                            <h4>{{ member.national_id }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Password') }}</label>
                        <div class="col-lg-4">
                            <input type="password" autocomplete="off" v-model="form.password" class="form-control form-control-lg" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.password">{{ form.errors.password }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Password confirmation') }}</label>

                        <div class="col-lg-4">
                            <input type="password" autocomplete="off" v-model="form.password_confirmation" class="form-control form-control-lg" style="direction: ltr" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">{{ __('Next') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Page content -->
    </div>
</template>
