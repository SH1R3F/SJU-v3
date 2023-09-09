<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    nationalities: Object,
    countries: Object,
    cities: Object,
    qualifications: Object,
    branches: Object,
});

const form = useForm({
    national_id: '',
    fname_ar: '',
    sname_ar: '',
    tname_ar: '',
    lname_ar: '',
    fname_en: '',
    sname_en: '',
    tname_en: '',
    lname_en: '',
    gender: '',
    birthday: '',
    country: '',
    city: '',
    nationality: '',
    qualification: '',
    marital_status: '',
    region: '',
    governorate: '',
    national_address: '',
    job_title: '',
    residence: '',
    education_level: '',
    experiences: '',
    branch_id: '',
    mobile: '',
    mobile_key: '',
    email: '',
    password: '',
});
</script>

<template>
    <Head :title="__('Create volunteer')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Volunteer Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Volunteer information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create volunteer') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.volunteers.store'))">
                            <!-- National ID -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="national_id">{{ __('National ID') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="national_id"
                                            v-model="form.national_id" :placeholder="__('National ID')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.national_id">{{ form.errors.national_id
                                    }}</span>
                                </div>
                            </div>
                            <!-- National ID -->

                            <!-- Full name -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="fname_ar">{{ __('First name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname_ar" v-model="form.fname_ar"
                                            :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname_ar">{{ form.errors.fname_ar
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="sname_ar">{{ __('Second name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="sname_ar" v-model="form.sname_ar"
                                            :placeholder="__('Second name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.sname_ar">{{ form.errors.sname_ar
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="tname_ar">{{ __('Third name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="tname_ar" v-model="form.tname_ar"
                                            :placeholder="__('Third name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.tname_ar">{{ form.errors.tname_ar
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="lname_ar">{{ __('Last name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname_ar" v-model="form.lname_ar"
                                            :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname_ar">{{ form.errors.lname_ar
                                    }}</span>
                                </div>
                            </div>
                            <!-- Full name -->

                            <!-- Full name In English -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="fname_en">{{ __('First name') }} ({{ __('In English')
                                    }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname_en" v-model="form.fname_en"
                                            :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname_en">{{ form.errors.fname_en
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="sname_en">{{ __('Second name') }} ({{ __('In English')
                                    }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="sname_en" v-model="form.sname_en"
                                            :placeholder="__('Second name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.sname_en">{{ form.errors.sname_en
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="tname_en">{{ __('Third name') }} ({{ __('In English')
                                    }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="tname_en" v-model="form.tname_en"
                                            :placeholder="__('Third name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.tname_en">{{ form.errors.tname_en
                                    }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="lname_en">{{ __('Last name') }} ({{ __('In English')
                                    }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname_en" v-model="form.lname_en"
                                            :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname_en">{{ form.errors.lname_en
                                    }}</span>
                                </div>
                            </div>
                            <!-- Full name In English -->

                            <!-- Gender -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label d-block">{{ __('Gender') }}</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" id="male" name="gender" value="male"
                                            v-model="form.gender" />
                                        <label class="form-check-label" for="male">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="female" name="gender"
                                            value="female" v-model="form.gender" />
                                        <label class="form-check-label" for="female">{{ __('Female') }}</label>
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.gender">{{ form.errors.gender }}</p>
                                </div>
                            </div>
                            <!-- Gender -->

                            <!-- Birthday -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="birthday">{{ __('Birthday') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="date" id="birthday" v-model="form.birthday"
                                            :placeholder="__('Birthday')" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.birthday">{{ form.errors.birthday }}</p>
                                </div>
                            </div>
                            <!-- Birthday -->

                            <!-- Country -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="country">{{ __('Country') }}</label>
                                    <select class="form-control m-select2-no" id="country" v-model="form.country">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(key, country) in countries" :key="key" :value="country">{{ country
                                        }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.country">{{ form.errors.country }}</p>
                                </div>
                            </div>
                            <!-- Country -->

                            <!-- City -->
                            <div class="row" v-if="form.country == 'المملكة العربية السعودية'">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="city">{{ __('City') }}</label>
                                    <select class="form-control m-select2-no" id="city" v-model="form.city">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(city, k) in cities" :key="k" :value="k">{{ city }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.city">{{ form.errors.city }}</p>
                                </div>
                            </div>
                            <!-- City -->

                            <!-- Nationality -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="nationality">{{ __('Nationality') }}</label>
                                    <select class="form-control m-select2-no" id="nationality" v-model="form.nationality">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(nationality, k) in nationalities" :key="k" :value="k">{{ nationality
                                        }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.nationality">{{ form.errors.nationality }}
                                    </p>
                                </div>
                            </div>
                            <!-- Nationality -->

                            <!-- Qualification -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="qualification">{{ __('The last academic qualification')
                                    }}</label>
                                    <select class="form-control m-select2-no" id="qualification"
                                        v-model="form.qualification">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(qualification, k) in qualifications" :key="k" :value="k">{{
                                            qualification }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.qualification">{{
                                        form.errors.qualification }}</p>
                                </div>
                            </div>
                            <!-- Qualification -->

                            <!-- Marital status, Region, governorate, and national address -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="marital_status">{{ __('Marital status') }}</label>
                                    <input class="form-control" type="text" id="marital_status"
                                        v-model="form.marital_status" :placeholder="__('Marital status')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.marital_status">{{
                                        form.errors.marital_status }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="region">{{ __('Region') }}</label>
                                    <input class="form-control" type="text" id="region" v-model="form.region"
                                        :placeholder="__('Region')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.region">{{ form.errors.region }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="governorate">{{ __('Governorate') }}</label>
                                    <input class="form-control" type="text" id="governorate" v-model="form.governorate"
                                        :placeholder="__('Governorate')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.governorate">{{ form.errors.governorate }}
                                    </p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="national_address">{{ __('National address') }}</label>
                                    <input class="form-control" type="text" id="national_address"
                                        v-model="form.national_address" :placeholder="__('National address')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.national_address">{{
                                        form.errors.national_address }}</p>
                                </div>
                            </div>
                            <!-- Marital status, Region, governorate, and national address -->

                            <!-- Job title, residence, education level, and experiences -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="job_title">{{ __('Job title') }}</label>
                                    <input class="form-control" type="text" id="job_title" v-model="form.job_title"
                                        :placeholder="__('Job title')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.job_title">{{ form.errors.job_title }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="residence">{{ __('Place of residence') }}</label>
                                    <input class="form-control" type="text" id="residence" v-model="form.residence"
                                        :placeholder="__('Place of residence')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.residence">{{ form.errors.residence }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="education_level">{{ __('Educational level') }}</label>
                                    <input class="form-control" type="text" id="education_level"
                                        v-model="form.education_level" :placeholder="__('Educational level')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.education_level">{{
                                        form.errors.education_level }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 col-md-3">
                                    <label class="form-label" for="experiences">{{ __('Volunteering experiences') }}</label>
                                    <input class="form-control" type="text" id="experiences" v-model="form.experiences"
                                        :placeholder="__('Volunteering experiences')" />
                                    <p class="fs-6 text-danger" v-if="form.errors.experiences">{{ form.errors.experiences }}
                                    </p>
                                </div>
                            </div>
                            <!-- Job title, residence, education level, and experiences -->

                            <!-- Branch -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="branch_id">{{ __('Branch') }}</label>
                                    <select class="form-control m-select2-no" id="branch_id" v-model="form.branch_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{
                                            branch.name }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</p>
                                </div>
                            </div>
                            <!-- Branch -->

                            <!-- Mobile and key -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="mobile">{{ __('Mobile') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="mobile" v-model="form.mobile"
                                            :placeholder="__('Mobile')" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.mobile">{{ form.errors.mobile }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-2">
                                    <label class="form-label" for="mobile_key">{{ __('Country key') }}</label>
                                    <select class="form-control m-select2-no" id="mobile_key" v-model="form.mobile_key">
                                        <option value="">{{ __('Choose') }}</option>
                                    <option v-for="(key, country) in countries" :key="key" :value="key">{{ key }}
                                    </option>
                                </select>
                                <p class="fs-6 text-danger" v-if="form.errors.mobile_key">{{ form.errors.mobile_key }}
                                </p>
                            </div>
                        </div>
                        <!-- Mobile and key -->

                        <!-- Email -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="email">{{ __('Email') }}</label>
                                <div class="input-group">
                                    <input class="form-control" type="email" id="email" v-model="form.email"
                                        :placeholder="__('Email')" />
                                </div>
                                <span class="fs-6 text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                            </div>
                        </div>
                        <!-- Email -->

                        <!-- Password -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password" v-model="form.password"
                                        :placeholder="__('Password')" />
                                </div>
                                <span class="fs-6 text-danger" v-if="form.errors.password">{{ form.errors.password
                                    }}</span>
                            </div>
                        </div>
                        <!-- Password -->

                        <div>
                            <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                            <Link :href="route('admin.volunteers.index')" as="button" type="reset"
                                class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Volunteer information -->
        </div>
        <!--/ Volunteer Content -->
    </div>
</div>
<!-- / Content --></template>
