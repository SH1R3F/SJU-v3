<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    countries: Object,
    cities: Object,
    nationalities: Object,
    qualifications: Object,
    sources: Object,
    branches: Object,
});

const form = useForm({
    profile_photo: '',
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
    national_id: '',
    marital_status: '',
    region: '',
    governorate: '',
    national_address: '',
    job_title: '',
    residence: '',
    fields: {},
    education_level: '',
    experiences: '',
    branch_id: '',
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
const onlyEnglish = (e) => {
    const pattern = /^[a-z\s-]+$/i;

    if (!pattern.test(e.target.value)) {
        e.target.value = e.target.value.slice(0, -1);
    } else {
        form[e.target.name] = e.target.value;
    }
};
</script>

<template>
    <Head :title="__('Register a new volunteer')" />
    <div class="users site-login">
        <div class="container my-4">
            <div class="signing-form">
                <h5>{{ __('Register a new volunteer') }}</h5>

                <form @submit.prevent="form.post(route('volunteer.register'))">
                    <!-- Profile photo -->
                    <div class="form-group row">
                        <label for="profile_photo">{{ __('Profile picture') }}</label>
                        <input type="file" accept="image/*" class="form-control" id="profile_photo" @change="form.profile_photo = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                        <p class="text text-danger text-sm" v-if="form.errors.profile_photo">{{ form.errors.profile_photo }}</p>
                    </div>
                    <!-- Profile photo -->

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

                    <!-- Full name fields (In English) -->
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label for="fname_en">{{ __('First name') }} ({{ __('In English') }})</label>
                            <input type="text" class="form-control" id="fname_en" name="fname_en" @input="onlyEnglish" v-model="form.fname_en" :placeholder="__('First name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.fname_en">{{ form.errors.fname_en }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="sname_en">{{ __('Second name') }} ({{ __('In English') }})</label>
                            <input type="text" class="form-control" id="sname_en" name="sname_en" @input="onlyEnglish" v-model="form.sname_en" :placeholder="__('Second name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.sname_en">{{ form.errors.sname_en }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="tname_en">{{ __('Third name') }} ({{ __('In English') }})</label>
                            <input type="text" class="form-control" id="tname_en" name="tname_en" @input="onlyEnglish" v-model="form.tname_en" :placeholder="__('Third name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.tname_en">{{ form.errors.tname_en }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="lname_en">{{ __('Last name') }} ({{ __('In English') }})</label>
                            <input type="text" class="form-control" id="lname_en" name="lname_en" @input="onlyEnglish" v-model="form.lname_en" :placeholder="__('Last name')" />
                            <p class="text text-danger text-sm" v-if="form.errors.lname_en">{{ form.errors.lname_en }}</p>
                        </div>
                    </div>
                    <!-- Full name fields (In English) -->

                    <!-- Gender -->
                    <div class="form-group row">
                        <label class="col-lg-2 control-label pt-2">{{ __('Gender') }}</label>

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

                    <!-- Birthday -->
                    <div class="form-group row">
                        <label class="col-lg-2 control-label pt-2">{{ __('Birthday') }}</label>

                        <div class="col-lg-4">
                            <input type="date" v-model="form.birthday" class="form-control" />
                            <p class="text text-danger text-sm" v-if="form.errors.birthday">{{ form.errors.birthday }}</p>
                        </div>
                    </div>
                    <!-- Birthday -->

                    <!-- Country -->
                    <div class="form-row">
                        <div class="form-group col-sm-6" :class="{ 'col-md-3': form.country == 'المملكة العربية السعودية', 'col-md-4': form.country !== 'المملكة العربية السعودية' }">
                            <label for="country">{{ __('Place of residence') }}</label>
                            <select id="country" class="form-control m-select2-no" v-model="form.country" :data-placeholder="__('Place of residence')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(key, country) in countries" :key="key" :value="country">{{ country }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.country">{{ form.errors.country }}</p>
                        </div>
                        <!-- Country -->

                        <!-- city -->
                        <div
                            v-if="form.country == 'المملكة العربية السعودية'"
                            class="form-group col-sm-6"
                            :class="{ 'col-md-3': form.country == 'المملكة العربية السعودية', 'col-md-4': form.country !== 'المملكة العربية السعودية' }"
                        >
                            <label for="city">{{ __('City') }}</label>
                            <select id="city" class="form-control m-select2-no" v-model="form.city" :data-placeholder="__('City')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(city, i) in cities" :key="i" :value="i">{{ city }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.city">{{ form.errors.city }}</p>
                        </div>
                        <!-- city -->

                        <!-- Nationality -->
                        <div class="form-group col-sm-6" :class="{ 'col-md-3': form.country == 'المملكة العربية السعودية', 'col-md-4': form.country !== 'المملكة العربية السعودية' }">
                            <label for="nat">{{ __('Nationality') }}</label>
                            <select id="nat" class="form-control m-select2-no" v-model="form.nationality" :data-placeholder="__('Nationality')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(nationality, key) in nationalities" :key="key" :value="key">{{ nationality }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.nationality">{{ form.errors.nationality }}</p>
                        </div>
                        <!-- Nationality -->

                        <!-- Academic Qualification -->
                        <div class="form-group col-sm-6" :class="{ 'col-md-3': form.country == 'المملكة العربية السعودية', 'col-md-4': form.country !== 'المملكة العربية السعودية' }">
                            <label for="qualification">{{ __('The last academic qualification') }}</label>
                            <select id="qualification" v-model="form.qualification" class="form-control m-select2-no" :data-placeholder="__('The last academic qualification')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(qualification, key) in qualifications" :key="key" :value="key">{{ qualification }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.qualification">{{ form.errors.qualification }}</p>
                        </div>
                    </div>
                    <!-- Academic Qualification -->

                    <!-- National id, Marital status, and Region -->
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-md-4">
                            <label for="national_id">{{ __('National ID') }}</label>
                            <input type="number" class="form-control" id="national_id" name="national_id" v-model="form.national_id" :placeholder="__('National ID')" />
                            <p class="text text-danger text-sm" v-if="form.errors.national_id">{{ form.errors.national_id }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                            <label for="marital_status">{{ __('Marital status') }}</label>
                            <input type="text" class="form-control" id="marital_status" name="marital_status" v-model="form.marital_status" :placeholder="__('Marital status')" />
                            <p class="text text-danger text-sm" v-if="form.errors.marital_status">{{ form.errors.marital_status }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                            <label for="region">{{ __('Region') }}</label>
                            <input type="text" class="form-control" id="region" name="region" v-model="form.region" :placeholder="__('Region')" />
                            <p class="text text-danger text-sm" v-if="form.errors.region">{{ form.errors.region }}</p>
                        </div>
                    </div>
                    <!-- National id, Marital status, and Region -->

                    <!-- Governorate, address, job title, and residence -->
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label for="governorate">{{ __('Governorate') }}</label>
                            <input type="text" class="form-control" id="governorate" name="governorate" v-model="form.governorate" :placeholder="__('Governorate')" />
                            <p class="text text-danger text-sm" v-if="form.errors.governorate">{{ form.errors.governorate }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="national_address">{{ __('National address') }}</label>
                            <input type="text" class="form-control" id="national_address" name="national_address" v-model="form.national_address" :placeholder="__('National address')" />
                            <p class="text text-danger text-sm" v-if="form.errors.national_address">{{ form.errors.national_address }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="job_title">{{ __('Job title') }}</label>
                            <input type="text" class="form-control" id="job_title" name="job_title" v-model="form.job_title" :placeholder="__('Job title')" />
                            <p class="text text-danger text-sm" v-if="form.errors.job_title">{{ form.errors.job_title }}</p>
                        </div>

                        <div class="form-group col-sm-6 col-md-3">
                            <label for="residence">{{ __('Place of residence') }}</label>
                            <input type="text" class="form-control" id="residence" name="residence" v-model="form.residence" :placeholder="__('Place of residence')" />
                            <p class="text text-danger text-sm" v-if="form.errors.residence">{{ form.errors.residence }}</p>
                        </div>
                    </div>
                    <!-- Governorate, address, job title, and residence -->

                    <!-- Volunteering fields -->
                    <div class="form-group col-12">
                        <label>{{ __('Volunteer in') }}</label>
                        <div class="row">
                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Photography') }}</label>
                                    <input type="checkbox" v-model="form.fields['التصوير الفوتوغرافي']" value="التصوير الفوتوغرافي" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Videography') }}</label>
                                    <input type="checkbox" v-model="form.fields['تصوير الفيديو']" value="تصوير الفيديو" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Cinematography') }}</label>
                                    <input type="checkbox" v-model="form.fields['التصوير السينمائي']" value="التصوير السينمائي" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Editing - media platforms - documentation') }}</label>
                                    <input type="checkbox" v-model="form.fields['التحرير - المنصات الإعلامية -التوثيق']" value="التحرير - المنصات الإعلامية -التوثيق" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Coverages') }}</label>
                                    <input type="checkbox" v-model="form.fields['التغطيات']" value="التغطيات" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Presentation') }}</label>
                                    <input type="checkbox" v-model="form.fields['التقديم']" value="التقديم" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Digital content industry') }}</label>
                                    <input type="checkbox" v-model="form.fields['صناعة المحتوى الرقمي']" value="صناعة المحتوى الرقمي" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Montage') }}</label>
                                    <input type="checkbox" v-model="form.fields['المونتاج']" value="المونتاج" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Social media') }}</label>
                                    <input type="checkbox" v-model="form.fields['السوشل ميديا']" value="السوشل ميديا" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Media marketing') }}</label>
                                    <input type="checkbox" v-model="form.fields['التسويق الاعلامي']" value="التسويق الاعلامي" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Editorial management') }}</label>
                                    <input type="checkbox" v-model="form.fields['إدارة التحرير']" value="إدارة التحرير" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Field Editing Command') }}</label>
                                    <input type="checkbox" v-model="form.fields['قيادة التحرير الميداني']" value="قيادة التحرير الميداني" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Management of meetings and seminars') }}</label>
                                    <input type="checkbox" v-model="form.fields['إدارة الملتقيات والندوات']" value="إدارة الملتقيات والندوات" />
                                </div>
                            </div>

                            <div class="col-4 border p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="m-0">{{ __('Media training') }}</label>
                                    <input type="checkbox" v-model="form.fields['التدريب الاعلامي']" value="التدريب الاعلامي" />
                                </div>
                            </div>
                        </div>
                        <p class="text text-danger text-sm" v-if="form.errors.fields">{{ form.errors.fields }}</p>
                    </div>
                    <!-- Volunteering fields -->

                    <!-- Education and experiences -->
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="education_level">{{ __('Educational level') }}</label>
                            <input type="text" class="form-control" id="education_level" name="education_level" v-model="form.education_level" :placeholder="__('Educational level')" />
                            <p class="text text-danger text-sm" v-if="form.errors.education_level">{{ form.errors.education_level }}</p>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="experiences">{{ __('Volunteering experiences') }}</label>
                            <input type="text" class="form-control" id="experiences" name="experiences" v-model="form.experiences" :placeholder="__('Volunteering experiences')" />
                            <p class="text text-danger text-sm" v-if="form.errors.experiences">{{ form.errors.experiences }}</p>
                        </div>
                    </div>
                    <!-- Education and experiences -->

                    <!-- Branch -->
                    <div class="form-group row">
                        <label for="branch_id" class="col-sm-3 col-form-label">{{ __('Branch') }}</label>

                        <div class="col-sm-5">
                            <select id="branch_id" class="form-control m-select2-no" v-model="form.branch_id" :data-placeholder="__('Branch')">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                            </select>
                            <p class="text text-danger text-sm" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</p>
                        </div>
                    </div>
                    <!-- Branch -->

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
