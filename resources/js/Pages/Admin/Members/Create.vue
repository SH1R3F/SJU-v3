<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    nationalities: Object,
    branches: Object,
});

const form = useForm({
    fname_ar: '',
    sname_ar: '',
    tname_ar: '',
    lname_ar: '',
    fname_en: '',
    sname_en: '',
    tname_en: '',
    lname_en: '',
    national_id: '',
    mobile: '',
    gender: '',
    birthday_h: '',
    birthday_m: '',
    nationality: '',
    qualification: '',
    major: '',
    journalistic_profession: '',
    journalistic_employer: '',
    newspaper_type: '',
    non_journalistic_profession: '',
    non_journalistic_employer: '',
    workphone: '',
    workphone_ext: '',
    fax: '',
    fax_ext: '',
    postbox: '',
    postcode: '',
    postcity: '',
    email: '',
    branch_id: '',
    type: '',
});

const changeDate = (e) => {
    form[e.target.name] = e.target.value;
};
</script>

<template>
    <Head :title="__('Create member')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create member') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.members.store'))">
                            <!-- Full name -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="fname_ar">{{ __('First name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname_ar" v-model="form.fname_ar" :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname_ar">{{ form.errors.fname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="sname_ar">{{ __('Second name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="sname_ar" v-model="form.sname_ar" :placeholder="__('Second name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.sname_ar">{{ form.errors.sname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="tname_ar">{{ __('Third name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="tname_ar" v-model="form.tname_ar" :placeholder="__('Third name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.tname_ar">{{ form.errors.tname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="lname_ar">{{ __('Last name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname_ar" v-model="form.lname_ar" :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname">{{ form.errors.lname_ar }}</span>
                                </div>
                            </div>
                            <!-- Full name -->

                            <!-- Full name - English -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="fname_en">{{ __('First name') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname_en" v-model="form.fname_en" :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname_en">{{ form.errors.fname_en }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="sname_en">{{ __('Second name') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="sname_en" v-model="form.sname_en" :placeholder="__('Second name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.sname_en">{{ form.errors.sname_en }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="tname_en">{{ __('Third name') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="tname_en" v-model="form.tname_en" :placeholder="__('Third name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.tname_en">{{ form.errors.tname_en }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-3">
                                    <label class="form-label" for="lname_en">{{ __('Last name') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname_en" v-model="form.lname_en" :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname">{{ form.errors.lname_en }}</span>
                                </div>
                            </div>
                            <!-- Full name -->

                            <!-- National id and mobile -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="national_id">{{ __('National ID number') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="national_id" v-model="form.national_id" :placeholder="__('National ID number')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.national_id">{{ form.errors.national_id }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="mobile">{{ __('Mobile') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="mobile" v-model="form.mobile" :placeholder="__('Mobile')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.mobile">{{ form.errors.mobile }}</span>
                                </div>
                            </div>
                            <!-- National id and mobile -->

                            <!-- Gender -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label d-block">{{ __('Gender') }}</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" id="male" name="gender" value="0" v-model="form.gender" />
                                        <label class="form-check-label" for="male">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="female" name="gender" value="1" v-model="form.gender" />
                                        <label class="form-check-label" for="female">{{ __('Female') }}</label>
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.gender">{{ form.errors.gender }}</p>
                                </div>
                            </div>
                            <!-- Gender -->

                            <!-- Birthday Hijri & Miladi -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="birthday_h">{{ __('Birthday (Hijri)') }}</label>
                                    <div class="input-group">
                                        <input type="text" @change="changeDate" class="form-control" name="birthday_h" id="birthday_h" />
                                        <datepicker-hijri reference="birthday_h" placement="bottom" date-format="iYYYY/iMM/iDD"></datepicker-hijri>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.birthday_h">{{ form.errors.birthday_h }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="birthday_m">{{ __('Birthday (Miladi)') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="date" id="birthday_m" v-model="form.birthday_m" :placeholder="__('Birthday (Miladi)')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.birthday_m">{{ form.errors.birthday_m }}</span>
                                </div>
                            </div>
                            <!-- Birthday Hijri & Miladi -->

                            <!-- Nationality -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="nationality">{{ __('Nationality') }}</label>
                                    <select class="form-control m-select2-no" id="nationality" v-model="form.nationality">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(nationality, k) in nationalities" :key="k" :value="k">{{ __(nationality) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.nationality">{{ form.errors.nationality }}</p>
                                </div>
                            </div>
                            <!-- Nationality -->

                            <!-- Qualification & Major -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qualification">{{ __('The last academic qualification') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="qualification" v-model="form.qualification" :placeholder="__('The last academic qualification')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qualification">{{ form.errors.qualification }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="major">{{ __('Specialization') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="major" v-model="form.major" :placeholder="__('Specialization')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.major">{{ form.errors.major }}</span>
                                </div>
                            </div>
                            <!-- Qualification & Major -->

                            <!-- Journalistic job, employer & newspaper type -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="journalistic_profession">{{ __('Journalistic profession title') }}</label>
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="journalistic_profession"
                                            v-model="form.journalistic_profession"
                                            :placeholder="__('Journalistic profession title')"
                                        />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.journalistic_profession">{{ form.errors.journalistic_profession }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="journalistic_employer">{{ __('Employer') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="journalistic_employer" v-model="form.journalistic_employer" :placeholder="__('Employer')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.journalistic_employer">{{ form.errors.journalistic_employer }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="newspaper_type">{{ __('Newspaper type') }}</label>
                                    <select class="form-control m-select2-no" id="newspaper_type" v-model="form.newspaper_type">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option value="1">{{ __('Paper newspaper') }}</option>
                                        <option value="2">{{ __('Electronic newspaper') }}</option>
                                    </select>
                                    <span class="fs-6 text-danger" v-if="form.errors.newspaper_type">{{ form.errors.newspaper_type }}</span>
                                </div>
                            </div>
                            <!-- Journalistic job, employer & newspaper type -->

                            <!-- Non-Journalistic job & employer -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="non_journalistic_profession">{{ __('Non-Journalistic profession title') }}</label>
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="non_journalistic_profession"
                                            v-model="form.non_journalistic_profession"
                                            :placeholder="__('Non-Journalistic profession title')"
                                        />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.non_journalistic_profession">{{ form.errors.non_journalistic_profession }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="non_journalistic_employer">{{ __('Employer') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="non_journalistic_employer" v-model="form.non_journalistic_employer" :placeholder="__('Employer')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.non_journalistic_employer">{{ form.errors.non_journalistic_employer }}</span>
                                </div>
                            </div>
                            <!-- Non-Journalistic job & employer -->

                            <!-- Workphone & Ext -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="workphone">{{ __('Work phone') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="workphone" v-model="form.workphone" :placeholder="__('Work phone')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.workphone">{{ form.errors.workphone }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="workphone_ext">{{ __('Ext') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="workphone_ext" v-model="form.workphone_ext" :placeholder="__('Ext')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.workphone_ext">{{ form.errors.workphone_ext }}</span>
                                </div>
                            </div>
                            <!-- Workphone & Ext -->

                            <!-- Fax & Ext -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="fax">{{ __('Fax') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fax" v-model="form.fax" :placeholder="__('Fax')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fax">{{ form.errors.fax }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="fax_ext">{{ __('Ext') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fax_ext" v-model="form.fax_ext" :placeholder="__('Ext')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fax_ext">{{ form.errors.fax_ext }}</span>
                                </div>
                            </div>
                            <!-- Fax & Ext -->

                            <!-- Post address -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="postbox">{{ __('Post address') }}: {{ __('P.B') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="postbox" v-model="form.postbox" :placeholder="__('P.B')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.postbox">{{ form.errors.postbox }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="postcode">{{ __('Post code') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="postcode" v-model="form.postcode" :placeholder="__('Post code')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.postcode">{{ form.errors.postcode }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="postcity">{{ __('Post city') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="postcity" v-model="form.postcity" :placeholder="__('Post city')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.postcity">{{ form.errors.postcity }}</span>
                                </div>
                            </div>
                            <!-- Post address -->

                            <!-- Email -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="email" id="email" v-model="form.email" :placeholder="__('Email')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                                </div>
                            </div>
                            <!-- Email -->

                            <!-- Branch -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="branch" class="form-label">{{ __('Branch') }}</label>
                                    <select class="form-control m-select2-no" id="branch" v-model="form.branch_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</p>
                                </div>
                            </div>
                            <!-- Branch -->

                            <!-- Subscription type -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="type" class="form-label">{{ __('Membership type') }}</label>
                                    <select class="form-control m-select2-no" id="type" v-model="form.type">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option value="1">{{ __('Full-time member') }}</option>
                                        <option value="2">{{ __('Part-time member') }}</option>
                                        <option value="3">{{ __('Affiliate member') }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.type">{{ form.errors.type }}</p>
                                </div>
                            </div>
                            <!-- Subscription type -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.members.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Member information -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
