<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
    nationalities: Object,
});
const form = useForm({
    national_id_source: props.member.national_id_source || undefined,
    national_id_date: props.member.national_id_date || undefined,
    fname_ar: props.member.fname_ar || undefined,
    sname_ar: props.member.sname_ar || undefined,
    tname_ar: props.member.tname_ar || undefined,
    lname_ar: props.member.lname_ar || undefined,
    fname_en: props.member.fname_en || undefined,
    sname_en: props.member.sname_en || undefined,
    tname_en: props.member.tname_en || undefined,
    lname_en: props.member.lname_en || undefined,
    gender: props.member.gender?.toString() || undefined,
    birthday_h: props.member.birthday_h || undefined,
    birthday_m: props.member.birthday_m || undefined,
    nationality: props.member.nationality || undefined,
    qualification: props.member.qualification || undefined,
    major: props.member.major || undefined,
    journalistic_profession: props.member.journalistic_profession || undefined,
    journalistic_employer: props.member.journalistic_employer || undefined,
    newspaper_type: props.member.newspaper_type || undefined,
    non_journalistic_profession: props.member.non_journalistic_profession || undefined,
    non_journalistic_employer: props.member.non_journalistic_employer || undefined,
    workphone: props.member.workphone || undefined,
    workphone_ext: props.member.workphone_ext || undefined,
    fax: props.member.fax || undefined,
    fax_ext: props.member.fax_ext || undefined,
    postbox: props.member.postbox || undefined,
    postcode: props.member.postcode || undefined,
    postcity: props.member.postcity || undefined,
    email: props.member.email || undefined,
});

const changeDate = (e) => {
    form[e.target.name] = e.target.value;
};
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
    <Head :title="__('Member info')" />
    <div class="container my-4">
        <tab-list active="info" />
        <!-- Page content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                <form class="form-horizontal form-bordered mycustom-form1" @submit.prevent="form.post(route('member.register.step5'))">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">
                            {{ __('National id number') }}
                        </label>

                        <div class="col-lg-3">
                            <h4>{{ member.national_id }}</h4>
                            <Link :href="route('member.register')" class="text-success">{{ __('Change') }}</Link>
                        </div>

                        <label class="col-lg-3 control-label pt-2">{{ __('Activated mobile number') }}</label>

                        <div class="col-lg-3">
                            <h4>{{ member.mobile }}</h4>
                            <Link :href="route('member.register.step2')" class="text-success">{{ __('Change') }}</Link>
                        </div>
                    </div>

                    <!-- More informations about Nat ID -->

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('ID source') }}</label>
                        <div class="col-lg-3">
                            <input type="text" v-model="form.national_id_source" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.national_id_source">{{ form.errors.national_id_source }}</span>
                        </div>

                        <label class="col-lg-3 control-label pt-2">{{ __('ID date') }}</label>
                        <div class="col-lg-3">
                            <input type="text" @change="changeDate" class="form-control" name="national_id_date" id="national_id_date" :value="form.national_id_date" />
                            <datepicker-hijri reference="national_id_date" placement="bottom" date-format="iYYYY/iMM/iDD" :selected-date="form.national_id_date"></datepicker-hijri>
                            <span class="text text-danger text-sm" v-if="form.errors.national_id_date">{{ form.errors.national_id_date }}</span>
                        </div>
                    </div>

                    <!-- Info of nat id -->

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>{{ __('First name') }}</label>

                            <input type="text" name="fname_ar" v-model="form.fname_ar" @input="onlyArabic" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.fname_ar">{{ form.errors.fname_ar }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Second name') }}</label>

                            <input type="text" name="sname_ar" v-model="form.sname_ar" @input="onlyArabic" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.sname_ar">{{ form.errors.sname_ar }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Third name') }}</label>

                            <input type="text" name="tname_ar" v-model="form.tname_ar" @input="onlyArabic" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.tname_ar">{{ form.errors.tname_ar }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Last name') }}</label>

                            <input type="text" name="lname_ar" v-model="form.lname_ar" @input="onlyArabic" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.lname_ar">{{ form.errors.lname_ar }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>{{ __('First name') }} ({{ __('In English') }})</label>

                            <input type="text" autocapitalize="on" name="fname_en" v-model="form.fname_en" @input="onlyEnglish" class="form-control OnlyEnglish" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.errors.fname_en">{{ form.errors.fname_en }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Second name') }} ({{ __('In English') }})</label>

                            <input type="text" autocapitalize="on" name="sname_en" v-model="form.sname_en" @input="onlyEnglish" class="form-control OnlyEnglish" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.errors.sname_en">{{ form.errors.sname_en }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Third name') }} ({{ __('In English') }})</label>

                            <input type="text" autocapitalize="on" name="tname_en" v-model="form.tname_en" @input="onlyEnglish" class="form-control OnlyEnglish" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.errors.tname_en">{{ form.errors.tname_en }}</span>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Last name') }} ({{ __('In English') }})</label>

                            <input type="text" autocapitalize="on" name="lname_en" v-model="form.lname_en" @input="onlyEnglish" class="form-control OnlyEnglish" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.errors.lname_en">{{ form.errors.lname_en }}</span>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Gender') }}</label>

                        <div class="col-lg-5">
                            <div class="radio-inline">
                                <div class="radio-custom radio-success d-inline mx-3 my-2">
                                    <input type="radio" id="male" v-model="form.gender" value="0" />
                                    <label for="male">{{ __('Male') }}</label>
                                </div>
                                <div class="radio-custom radio-success d-inline mx-3 my-2">
                                    <input type="radio" id="female" v-model="form.gender" value="1" />
                                    <label for="female">{{ __('Female') }}</label>
                                </div>
                            </div>
                            <span class="text text-danger text-sm" v-if="form.errors.gender">{{ form.errors.gender }}</span>
                        </div>
                    </div>
                    <!-- Gender -->

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Birthday (Hijri)') }}</label>
                        <div class="col-lg-3">
                            <input type="text" @change="changeDate" class="form-control" name="birthday_h" id="birthday_h" :value="form.birthday_h" />
                            <datepicker-hijri reference="birthday_h" placement="bottom" date-format="iYYYY/iMM/iDD" :selected-date="form.birthday_h"></datepicker-hijri>
                            <span class="text text-danger text-sm" v-if="form.errors.birthday_h">{{ form.errors.birthday_h }}</span>
                        </div>

                        <label class="col-lg-3 control-label pt-2">{{ __('Birthday (Miladi)') }}</label>
                        <div class="col-lg-3">
                            <input type="date" v-model="form.birthday_m" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.birthday_m">{{ form.errors.birthday_m }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Nationality') }}</label>
                        <div class="col-lg-4">
                            <select class="form-control m-select2-no" v-model="form.nationality">
                                <option value="">{{ __('Choose') }}</option>
                                <option v-for="(nationality, k) in nationalities" :key="k" :value="k">{{ __(nationality) }}</option>
                            </select>
                            <span class="text text-danger text-sm" v-if="form.errors.nationality">{{ form.errors.nationality }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('The last academic qualification') }}</label>

                        <div class="col-lg-3">
                            <input type="text" v-model="form.qualification" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.qualification">{{ form.errors.qualification }}</span>
                        </div>

                        <label class="col-lg-1 control-label pt-2">{{ __('Specialization') }}</label>

                        <div class="col-lg-3">
                            <input type="text" v-model="form.major" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.major">{{ form.errors.major }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>{{ __('Journalistic profession title') }}</label>
                            <input type="text" v-model="form.journalistic_profession" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.journalistic_profession">{{ form.errors.journalistic_profession }}</span>
                        </div>

                        <div class="col-lg-4">
                            <label>{{ __('Employer') }}</label>
                            <input type="text" v-model="form.journalistic_employer" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.journalistic_employer">{{ form.errors.journalistic_employer }}</span>
                        </div>

                        <div class="col-lg-4">
                            <label>{{ __('Newspaper type') }}</label>
                            <select v-model="form.newspaper_type" class="form-control">
                                <option value="">{{ __('Choose') }}</option>
                                <option value="1">{{ __('Paper newspaper') }}</option>
                                <option value="2">{{ __('Electronic newspaper') }}</option>
                            </select>
                            <span class="text text-danger text-sm" v-if="form.errors.newspaper_type">{{ form.errors.newspaper_type }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Non-Journalistic profession title') }}</label>
                        <div class="col-lg-3">
                            <input type="text" v-model="form.non_journalistic_profession" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.non_journalistic_profession">{{ form.errors.non_journalistic_profession }}</span>
                        </div>

                        <label class="col-lg-1 control-label pt-2">{{ __('Employer') }}</label>
                        <div class="col-lg-3">
                            <input type="text" v-model="form.non_journalistic_employer" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.non_journalistic_employer">{{ form.errors.non_journalistic_employer }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Work phone') }}</label>
                        <div class="col-lg-3">
                            <input type="number" v-model="form.workphone" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.workphone">{{ form.errors.workphone }}</span>
                        </div>

                        <label class="col-lg-1 control-label pt-2">{{ __('Ext') }}</label>
                        <div class="col-lg-2">
                            <input type="number" v-model="form.workphone_ext" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.workphone_ext">{{ form.errors.workphone_ext }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Fax') }}</label>
                        <div class="col-lg-3">
                            <input type="number" v-model="form.fax" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.fax">{{ form.errors.fax }}</span>
                        </div>

                        <label class="col-lg-1 control-label pt-2">{{ __('Ext') }}</label>
                        <div class="col-lg-2">
                            <input type="number" v-model="form.fax_ext" class="form-control" />
                            <span class="text text-danger text-sm" v-if="form.errors.fax_ext">{{ form.errors.fax_ext }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Post address') }}</label>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>{{ __('P.B') }}</label>
                                    <input type="number" v-model="form.postbox" class="form-control" />
                                    <span class="text text-danger text-sm" v-if="form.errors.postbox">{{ form.errors.postbox }}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('Post code') }}</label>
                                    <input type="number" v-model="form.postcode" class="form-control" />
                                    <span class="text text-danger text-sm" v-if="form.errors.postcode">{{ form.errors.postcode }}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('Post city') }}</label>
                                    <input type="text" v-model="form.postcity" class="form-control" />
                                    <span class="text text-danger text-sm" v-if="form.errors.postcity">{{ form.errors.postcity }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label pt-2">{{ __('Email') }}</label>
                        <div class="col-lg-6">
                            <input type="email" v-model="form.email" class="form-control" style="direction: ltr" />
                            <span class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">{{ __('Next') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Page content -->
    </div>
</template>
