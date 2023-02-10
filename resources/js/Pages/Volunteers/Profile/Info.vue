<script setup>
import Sidebar from '../Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import NavTabs from './NavTabs.vue';

const props = defineProps({
    userAuth: Object,
    countries: Object,
    qualifications: Object,
    cities: Object,
    branches: Object,
    nationalities: Object,
});

const form = useForm({
    country: props.userAuth?.country,
    nationality: props.userAuth?.nationality,
    gender: props.userAuth?.gender,
    city: props.userAuth?.city,
    branch_id: props.userAuth?.branch_id,
    qualification: props.userAuth?.qualification,
    mobile: props.userAuth?.mobile,
    mobile_key: props.userAuth?.mobile_key,
});
</script>

<template>
    <Head :title="__('My information')" />
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
                        <div class="tab-content text-start pt-4" id="myTabContent">
                            <form class="form-horizontal form-bordered" @submit.prevent="form.post(route('volunteer.profile.info'))">
                                <!-- Full name fields -->
                                <div class="form-row">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label for="fname">{{ __('First name') }}</label>
                                        <h4>{{ userAuth.fname_ar }}</h4>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3">
                                        <label for="sname">{{ __('Second name') }}</label>
                                        <h4>{{ userAuth.sname_ar }}</h4>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3">
                                        <label for="tname">{{ __('Third name') }}</label>
                                        <h4>{{ userAuth.tname_ar }}</h4>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3">
                                        <label for="lname">{{ __('Last name') }}</label>
                                        <h4>{{ userAuth.lname_ar }}</h4>
                                    </div>
                                </div>
                                <!-- Full name fields -->

                                <!-- Gender -->
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label pt-2 col-form-label">{{ __('Gender') }}</label>
                                    <div class="col-lg-6">
                                        <div class="radio-inline">
                                            <div class="radio-custom radio-success d-inline mx-3 my-2">
                                                <input type="radio" id="male" v-model="form.gender" value="male" />
                                                <label for="male" class="px-2">{{ __('Male') }}</label>
                                            </div>
                                            <div class="radio-custom radio-success d-inline mx-3 my-2">
                                                <input type="radio" id="female" v-model="form.gender" value="female" />
                                                <label for="female" class="px-2">{{ __('Female') }}</label>
                                            </div>
                                        </div>
                                        <p class="text text-danger text-sm" v-if="form.errors.gender">{{ form.errors.gender }}</p>
                                    </div>
                                </div>
                                <!-- Gender -->

                                <!-- Country -->
                                <div class="form-group row">
                                    <label for="country" class="col-sm-3 col-form-label">{{ __('Place of residence') }}</label>
                                    <div class="col-sm-5">
                                        <select id="country" class="form-control m-select2-no" v-model="form.country" :data-placeholder="__('Place of residence')">
                                            <option value="">{{ __('Choose') }}</option>
                                            <option v-for="(key, country) in countries" :key="key" :value="country">{{ country }}</option>
                                        </select>
                                        <p class="text text-danger text-sm" v-if="form.errors.country">{{ form.errors.country }}</p>
                                    </div>
                                </div>
                                <!-- Country -->

                                <!-- city -->
                                <div class="form-group row" v-if="form.country == 'المملكة العربية السعودية'">
                                    <label for="city" class="col-sm-3 col-form-label">{{ __('City') }}</label>

                                    <div class="col-sm-5">
                                        <select id="city" class="form-control m-select2-no" v-model="form.city" :data-placeholder="__('City')">
                                            <option value="">{{ __('Choose') }}</option>
                                            <option v-for="(city, i) in cities" :key="i" :value="i">{{ city }}</option>
                                        </select>
                                        <p class="text text-danger text-sm" v-if="form.errors.city">{{ form.errors.city }}</p>
                                    </div>
                                </div>
                                <!-- city -->

                                <!-- Nationality -->
                                <div class="form-group row">
                                    <label for="nationality" class="col-sm-3 col-form-label">{{ __('Nationality') }}</label>
                                    <div class="col-sm-5">
                                        <select id="nationality" class="form-control m-select2-no" v-model="form.nationality" :data-placeholder="__('Nationality')">
                                            <option value="">{{ __('Choose') }}</option>
                                            <option v-for="(key, nationality) in nationalities" :key="key" :value="nationality">{{ nationality }}</option>
                                        </select>
                                        <p class="text text-danger text-sm" v-if="form.errors.nationality">{{ form.errors.nationality }}</p>
                                    </div>
                                </div>
                                <!-- Nationality -->

                                <!-- Email address -->
                                <div class="form-group row">
                                    <label for="user_email" class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-lg-5">
                                        <h5>{{ userAuth.email }}</h5>
                                    </div>
                                </div>
                                <!-- Email address -->

                                <!-- Academic Qualification -->
                                <div class="form-group row">
                                    <label for="qualification" class="col-sm-3 col-form-label">{{ __('The last academic qualification') }}</label>
                                    <div class="col-sm-5">
                                        <select id="qualification" v-model="form.qualification" class="form-control m-select2-no" :data-placeholder="__('The last academic qualification')">
                                            <option value="">{{ __('Choose') }}</option>
                                            <option v-for="(qualification, key) in qualifications" :key="key" :value="key">{{ qualification }}</option>
                                        </select>
                                        <p class="text text-danger text-sm" v-if="form.errors.qualification">{{ form.errors.qualification }}</p>
                                    </div>
                                </div>
                                <!-- Academic Qualification -->

                                <!-- Mobile number -->
                                <div class="form-group row">
                                    <label for="user_mobile" class="col-sm-3 col-form-label">{{ __('Mobile number') }}</label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <input
                                                id="user_mobile"
                                                type="number"
                                                v-model="form.mobile"
                                                class="form-control mycustom-input-group-input onlyNum"
                                                autocomplete="off"
                                                style="direction: ltr; border-left: 0px; padding-left: 10px"
                                                :placeholder="__('Mobile number')"
                                            />
                                            <span class="input-group-prepend">
                                                <select v-model="form.mobile_key" class="form-control" id="user_counter_code" style="direction: rtl; width: 80px; height: calc(2.08rem + 2px)">
                                                    <option v-for="(mobile_key, country) in countries" :key="mobile_key" :value="mobile_key">{{ mobile_key }}</option>
                                                </select>
                                            </span>
                                        </div>
                                        <p class="text text-danger text-sm" v-if="form.errors.mobile_key || form.errors.mobile">{{ form.errors.mobile_key || form.errors.mobile }}</p>
                                    </div>
                                </div>
                                <!-- Mobile number -->

                                <!-- Branch -->
                                <div class="form-group row">
                                    <label for="branch" class="col-sm-3 col-form-label">{{ __('Branch') }}</label>
                                    <div class="col-sm-5">
                                        <select id="branch" class="form-control m-select2-no" v-model="form.branch_id" :data-placeholder="__('Branch')">
                                            <option value="">{{ __('Choose') }}</option>
                                            <option v-for="(branch, key) in branches" :key="key" :value="branch.id">{{ branch.name }}</option>
                                        </select>
                                        <p class="text text-danger text-sm" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</p>
                                    </div>
                                </div>
                                <!-- Branch -->

                                <div class="text-end">
                                    <input type="submit" class="btn btn-success" :value="__('Save')" />
                                </div>
                            </form>
                        </div>
                        <!-- Tab content -->
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
