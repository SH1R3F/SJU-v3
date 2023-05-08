<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
    member_type: String,
    memberships: Object,
    branches: Object,
    nationalities: Object,
    errors: Object,
});

const form = useForm({
    agreement: undefined,
});
</script>

<template>
    <Head :title="__('Review')" />
    <div class="container my-4">
        <tab-list active="review" />

        <!-- Page content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                <form @submit.prevent="form.post(route('member.register'), { preserveScroll: true })">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('National id number') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.national_id }}</h4>
                            <Link :href="route('member.register')" class="text-success">{{ __('Change') }}</Link>
                            <p class="text text-danger text-sm" v-if="errors.national_id">{{ errors.national_id }}</p>
                        </div>

                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Activated mobile number') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.mobile }}</h4>
                            <Link :href="route('member.register.step2')" class="text-success">{{ __('Change') }}</Link>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Membership type') }}</label>
                        <div class="col-lg-3">
                            <h4 class="text-success">{{ __(memberships[member_type]?.name) }}</h4>
                            <Link :href="route('member.register.step3')" class="text-success">{{ __('Change') }}</Link>
                        </div>

                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Membership branch') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ branches.find((b) => b.id == member.branch_id)?.name }}</h4>
                            <Link :href="route('member.register.step3')" class="text-success">{{ __('Change') }}</Link>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>{{ __('First name') }}</label>
                            <h4>{{ member.fname_ar }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Second name') }}</label>
                            <h4>{{ member.sname_ar }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Third name') }}</label>
                            <h4>{{ member.tname_ar }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Last name') }}</label>
                            <h4>{{ member.lname_ar }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>{{ __('First name') }} ({{ __('In English') }})</label>
                            <h4>{{ member.fname_en }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Second name') }} ({{ __('In English') }})</label>
                            <h4>{{ member.sname_en }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Third name') }} ({{ __('In English') }})</label>
                            <h4>{{ member.tname_en }}</h4>
                        </div>

                        <div class="col-lg-3">
                            <label>{{ __('Last name') }} ({{ __('In English') }})</label>
                            <h4>{{ member.lname_en }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Gender') }}</label>
                        <div class="col-lg-4">
                            <h4>{{ member.gender ? __('Female') : __('Male') }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Birthday (Hijri)') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.birthday_h }}</h4>
                        </div>

                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Birthday (Miladi)') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.birthday_m }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Nationality') }}</label>
                        <div class="col-lg-4">{{ __(nationalities[member.nationality]) }}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('The last academic qualification') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.qualification }}</h4>
                        </div>

                        <label class="col-lg-1 control-label text-lg-right pt-2">{{ __('Specialization') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.major }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Journalistic profession title') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.journalistic_profession }}</h4>
                        </div>

                        <label class="col-lg-1 control-label text-lg-right pt-2">{{ __('Employer') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.journalistic_employer }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Non-Journalistic profession title') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.non_journalistic_profession }}</h4>
                        </div>

                        <label class="col-lg-1 control-label text-lg-right pt-2">{{ __('Employer') }}</label>

                        <div class="col-lg-3">
                            <h4>{{ member.non_journalistic_employer }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Work phone') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.workphone }}</h4>
                        </div>

                        <label class="col-lg-1 control-label text-lg-right pt-2">{{ __('Ext') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.workphone_ext }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Fax') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.fax }}</h4>
                        </div>

                        <label class="col-lg-1 control-label text-lg-right pt-2">{{ __('Ext') }}</label>
                        <div class="col-lg-3">
                            <h4>{{ member.fax_ext }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Post address') }}</label>

                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>{{ __('P.B') }}</label>
                                    <h4>{{ member.postbox }}</h4>
                                </div>

                                <div class="col-lg-4">
                                    <label>{{ __('Post code') }}</label>
                                    <h4>{{ member.postcode }}</h4>
                                </div>

                                <div class="col-lg-4">
                                    <label>{{ __('Post city') }}</label>
                                    <h4>{{ member.postcity }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Email') }}</label>

                        <div class="col-lg-6">
                            <h4>{{ member.email }}</h4>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="checkbox-custom">
                                <input type="checkbox" id="agree" v-model="form.agreement" />
                                <label for="agree" style="font-size: 14px">{{
                                    __(
                                        'I acknowledge my knowledge and commitment to all terms and conditions, and I also undertake that all data provided are correct personal data, and I bear all responsibility for that.'
                                    )
                                }}</label>
                                <span class="text text-danger text-sm d-block" v-if="form.errors.agreement">{{ form.errors.agreement }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Page content -->
    </div>
</template>
