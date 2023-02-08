<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    countries: Object,
    cities: Object,
    nationalities: Object,
    qualifications: Object,
    sources: Object,
});

const form = useForm({
    fname_ar: '',
    sname_ar: '',
    tname_ar: '',
    lname_ar: '',
    gender: '',
    country: '',
    city: '',
    nationality: '',
    qualification: '',
    hearabout: '',
    mobile: '',
    mobile_key: '966',
    email: '',
    password: '',
    password_confirmation: '',
    agreement: false,
});

const onlyArabic = (e) => {
    const pattern = /[a-z]+/i;

    if (pattern.test(e.target.value)) {
        e.target.value = e.target.value.slice(0, -1);
    } else {
        form[e.target.name] = e.target.value;
    }
};
</script>

<template>
    <Head :title="__('Register a new subscriber')" />
    <div class="users site-login">
        <div class="container my-4">
            <div class="signing-form">
                <h5>{{ __('Register a new subscriber') }}</h5>

                <form @submit.prevent="form.post(route('subscriber.register'))">
                    <!-- Full name fields -->
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label for="fname_ar">{{ __('First name') }}</label>
                            <input type="text" class="form-control" id="fname_ar" name="fname_ar" @input="onlyArabic" v-model="form.fname_ar" :placeholder="__('First name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.fname_ar">{{ form.errors.fname_ar }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="sname_ar">{{ __('Second name') }}</label>
                            <input type="text" class="form-control" id="sname_ar" name="sname_ar" @input="onlyArabic" v-model="form.sname_ar" :placeholder="__('Second name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.sname_ar">{{ form.errors.sname_ar }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="tname_ar">{{ __('Third name') }}</label>
                            <input type="text" class="form-control" id="tname_ar" name="tname_ar" @input="onlyArabic" v-model="form.tname_ar" :placeholder="__('Third name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.tname_ar">{{ form.errors.tname_ar }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="lname_ar">{{ __('Last name') }}</label>
                            <input type="text" class="form-control" id="lname_ar" name="lname_ar" @input="onlyArabic" v-model="form.lname_ar" :placeholder="__('Last name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.lname_ar">{{ form.errors.lname_ar }}</p>
                        </div>
                    </div>
                    <!-- Full name fields -->

                    <!-- Gender -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Gender') }}</label>

                        <div class="col-lg-5">
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
                        <label for="nat" class="col-sm-3 col-form-label">{{ __('Nationality') }}</label>
                        <div class="col-sm-5">
                            <select id="nat" class="form-control m-select2-no" v-model="form.nationality" :data-placeholder="__('Nationality')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(nationality, key) in nationalities" :key="key" :value="key">{{ nationality }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.nationality">{{ form.errors.nationality }}</p>
                        </div>
                    </div>
                    <!-- Nationality -->

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

                    <!-- How do you know us -->
                    <div class="form-group row">
                        <label for="hearabout" class="col-sm-3 col-form-label">{{ __('How did you get to know the authority?') }}</label>

                        <div class="col-sm-5">
                            <select id="hearabout" class="form-control m-select2-no" v-model="form.hearabout" :data-placeholder="__('How did you get to know the authority?')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(source, key) in sources" :key="key" :value="key">{{ source }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.hearabout">{{ form.errors.hearabout }}</p>
                        </div>
                    </div>
                    <!-- How do you know us -->

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

                    <!-- Email address -->
                    <div class="form-group row">
                        <label for="user_email" class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-5">
                            <input type="text" id="user_email" v-model="form.email" class="form-control" :placeholder="__('Email')" />
                            <p class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</p>
                        </div>
                    </div>
                    <!-- Email address -->

                    <!-- Password -->
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-5">
                            <input id="password" type="password" autocomplete="off" v-model="form.password" class="form-control" :placeholder="__('Password')" />
                            <p class="text text-danger text-sm" v-if="form.errors.password">{{ form.errors.password }}</p>
                        </div>
                    </div>
                    <!-- Password -->

                    <!-- Password Confirmation -->
                    <div class="form-group row">
                        <label for="password_repeat" class="col-sm-3 col-form-label">{{ __('Password confirmation') }}</label>
                        <div class="col-sm-5">
                            <input id="password_repeat" type="password" autocomplete="off" v-model="form.password_confirmation" class="form-control" :placeholder="__('Password confirmation')" />
                            <p class="text text-danger text-sm" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</p>
                        </div>
                    </div>
                    <!-- Password Confirmation -->

                    <!-- Terms and conditions -->
                    <div class="form-group row mt-5">
                        <div class="col-12">
                            <div class="m-checkbox-list">
                                <label class="m-checkbox">
                                    <input type="checkbox" id="agree" v-model="form.agreement" />
                                    <label for="agree" style="padding: 0 5px; font-size: 16px; font-weight: bold">
                                        {{ __('I undertake that all data are correct, if otherwise the subscription will be suspended') }}
                                    </label>
                                </label>
                                <p class="text text-danger text-sm" v-if="form.errors.agreement">{{ form.errors.agreement }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Terms and conditions -->

                    <!-- Register me -->
                    <div class="text-end">
                        <button type="submit" id="submitregister" class="btn btn-success mb-2">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script defer>
export default {
    mounted() {},
};
</script>
