<script setup>
import Sidebar from '../Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import NavTabs from './NavTabs.vue';

const props = defineProps({
    userAuth: Object,
    nationalities: Object,
});

const form = useForm({
    national_id_source: props.userAuth?.national_id_source,
    national_id_date: props.userAuth?.national_id_date,
    qualification: props.userAuth?.qualification,
    major: props.userAuth?.major,
    journalistic_profession: props.userAuth?.journalistic_profession,
    journalistic_employer: props.userAuth?.journalistic_employer,
    newspaper_type: props.userAuth?.newspaper_type,
    non_journalistic_profession: props.userAuth?.non_journalistic_profession,
    non_journalistic_employer: props.userAuth?.non_journalistic_employer,
    workphone: props.userAuth?.workphone,
    workphone_ext: props.userAuth?.workphone_ext,
    fax: props.userAuth?.fax,
    fax_ext: props.userAuth?.fax_ext,
    postbox: props.userAuth?.postbox,
    postcode: props.userAuth?.postcode,
    postcity: props.userAuth?.postcity,
    email: props.userAuth?.email,
});
</script>

<template>
    <Head :title="__('My information')" />
    <div class="members">
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
                            <form class="form-horizontal form-bordered" @submit.prevent="form.post(route('member.profile.info'))">
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('National id number') }}</label>
                                    <div class="col-lg-3">
                                        <h4>{{ userAuth?.national_id }}</h4>
                                    </div>

                                    <label class="col-lg-3 control-label pt-2">{{ __('Mobile number') }}</label>
                                    <div class="col-lg-3">
                                        <h4>{{ userAuth?.mobile }}</h4>
                                        <!-- if ($memberinfo->approved != 1): -->
                                        <a v-if="false" href="#" class="text-success">{{ __('Change') }}</a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('ID source') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.national_id_source" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.national_id_source">{{ form.errors.national_id_source }}</span>
                                    </div>

                                    <label class="col-lg-3 control-label pt-2">{{ __('ID date') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.national_id_date" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.national_id_date">{{ form.errors.national_id_date }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label>{{ __('First name') }}</label>
                                        <h4>{{ userAuth?.fname_ar }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Second name') }}</label>
                                        <h4>{{ userAuth?.sname_ar }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Third name') }}</label>
                                        <h4>{{ userAuth?.tname_ar }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Last name') }}</label>
                                        <h4>{{ userAuth?.lname_ar }}</h4>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label>{{ __('First name') }} ({{ __('In English') }})</label>
                                        <h4>{{ userAuth?.fname_en }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Second name') }} ({{ __('In English') }})</label>
                                        <h4>{{ userAuth?.sname_en }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Third name') }} ({{ __('In English') }})</label>
                                        <h4>{{ userAuth?.tname_en }}</h4>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>{{ __('Last name') }} ({{ __('In English') }})</label>
                                        <h4>{{ userAuth?.lname_en }}</h4>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Gender') }}</label>
                                    <div class="col-lg-4">
                                        <h4>{{ userAuth?.gender ? __('Female') : __('Male') }}</h4>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Birthday (Hijri)') }}</label>
                                    <div class="col-lg-3">
                                        <h4>{{ userAuth?.birthday_h }}</h4>
                                    </div>

                                    <label class="col-lg-3 control-label pt-2">{{ __('Birthday (Miladi)') }}</label>
                                    <div class="col-lg-3">
                                        <h4>{{ userAuth?.birthday_m }}</h4>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Nationality') }}</label>
                                    <div class="col-lg-4">
                                        <h4>{{ __(nationalities[userAuth?.nationality]) }}</h4>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('The last academic qualification') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.qualification" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.qualification">{{ form.errors.qualification }}</span>
                                    </div>

                                    <label class="col-lg-1 control-label pt-2">{{ __('Specialization') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.major" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.major">{{ form.errors.major }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>{{ __('Journalistic profession title') }}</label>
                                        <input type="text" v-model="form.journalistic_profession" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.journalistic_profession">{{ form.errors.journalistic_profession }}</span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>{{ __('Employer') }}</label>
                                        <input type="text" v-model="form.journalistic_employer" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.journalistic_employer">{{ form.errors.journalistic_employer }}</span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>{{ __('Newspaper type') }}</label>
                                        <select v-model="form.newspaper_type" class="form-control" :disabled="userAuth?.status >= 1">
                                            <option value="1">{{ __('Paper newspaper') }}</option>
                                            <option value="2">{{ __('Electronic newspaper') }}</option>
                                        </select>
                                        <span class="text text-danger text-sm" v-if="form.errors.newspaper_type">{{ form.errors.newspaper_type }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Non-Journalistic profession title') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.non_journalistic_profession" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.non_journalistic_profession">{{ form.errors.non_journalistic_profession }}</span>
                                    </div>

                                    <label class="col-lg-1 control-label pt-2">{{ __('Employer') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.non_journalistic_employer" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.non_journalistic_employer">{{ form.errors.non_journalistic_employer }}</span>
                                    </div>
                                </div>

                                <!-- Worktel -->
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Work phone') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.workphone" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.workphone">{{ form.errors.workphone }}</span>
                                    </div>

                                    <label class="col-lg-1 control-label pt-2">{{ __('Ext') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.workphone_ext" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.workphone_ext">{{ form.errors.workphone_ext }}</span>
                                    </div>
                                </div>

                                <!-- Fax -->
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Fax') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.fax" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.fax">{{ form.errors.fax }}</span>
                                    </div>

                                    <label class="col-lg-1 control-label pt-2">{{ __('Ext') }}</label>
                                    <div class="col-lg-3">
                                        <input type="text" v-model="form.fax_ext" class="form-control" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.fax_ext">{{ form.errors.fax_ext }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Post address') }}</label>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>{{ __('P.B') }}</label>
                                                <input type="text" v-model="form.postbox" class="form-control" :readonly="userAuth?.status >= 1" />
                                                <span class="text text-danger text-sm" v-if="form.errors.postbox">{{ form.errors.postbox }}</span>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>{{ __('Post code') }}</label>
                                                <input type="text" v-model="form.postcode" class="form-control" :readonly="userAuth?.status >= 1" />
                                                <span class="text text-danger text-sm" v-if="form.errors.postcode">{{ form.errors.postcode }}</span>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>{{ __('Post city') }}</label>
                                                <input type="text" v-model="form.postcity" class="form-control" :readonly="userAuth?.status >= 1" />
                                                <span class="text text-danger text-sm" v-if="form.errors.postcity">{{ form.errors.postcity }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Email') }}</label>
                                    <div class="col-lg-6">
                                        <input type="text" v-model="form.email" class="form-control" style="direction: ltr" :readonly="userAuth?.status >= 1" />
                                        <span class="text text-danger text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
                                    </div>
                                </div>

                                <!-- User can edit delivery option -->
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Card delivery method') }}</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-input--square" :value="userAuth?.delivery_option" disabled>
                                            <option value="1">{{ __('Pickup from branch') }}</option>
                                            <option value="2">{{ __('Delivery') }}</option>
                                        </select>
                                        <small id="deliverHelp" class="form-text text-muted">{{ __('In the case of choosing delivery, 35.42 riyals will be added to the invoice value.') }}</small>
                                    </div>
                                </div>

                                <!-- User can edit delivery address -->
                                <div class="form-group row" v-if="userAuth?.delivery_option == 2">
                                    <label class="col-lg-3 control-label pt-2">{{ __('Delivery address') }}</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" :value="userAuth?.delivery_address" readonly />
                                    </div>
                                </div>

                                <!-- <?php if($memberinfo->approved == 1): ?> -->
                                <a class="text-muted" v-if="userAuth?.status >= 1">{{ __('The data cannot be modified after the approval of the branch') }}</a>
                                <div class="text-end">
                                    <input type="submit" class="btn btn-success" :value="__('Save')" :disabled="userAuth?.status >= 1" />
                                </div>
                            </form>

                            <!-- <form id="confirmmobile" class="form-horizontal form-bordered mycustom-form1" method="post" action="<?php echo base_url();?>members/profile" style="display: none">

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <input type="hidden" name="is_mobile_change" value="yes">

                            <div class="form-group row mt-4">

                                <label class="col-lg-3 control-label pt-2">

                                    <?php echo lang('create_user_cphone_label'); ?>:

                                </label>

                                <div class="col-lg-3">

                                    <h3><?php echo $memberinfo->mobile;?></h3>

                                </div>

                            </div>



                            <div class="form-group row">

                                <label class="col-lg-3 control-label pt-2"><?php echo lang('create_user_nphone_label'); ?>:</label>

                                <div class="col-lg-6">

                                    <div class="input-group input-group-4 mb-3">

                                    <input type="text" name="mobile" id="mobile" autocomplete="off" class="form-control" maxlength="9" style="font-size: 20px; height: 54px;">

                                    <span class="input-group-prepend">

                                        <span class="input-group-text px-3 mycustom-input-group alert-success" style="font-size: 25px">966</span>

                                    </span>

                                    </div>

                                    <div class="text-start">

                                        <button class="btn btn-success" id="sendvar" type="button"><?php echo lang('create_member_sendval'); ?></button>

                                        <div class="countdown_timer mt-3 mr-3" style="font-weight: bold; font-size: 25px"></div>

                                    </div>

                                    <span class="form-help text-muted"><?php echo lang('create_member_example'); ?> 501234567</span>

                                    <?php echo form_error('mobile'); ?>

                                </div>

                            </div>



                            <div class="form-group  row" id="confirmcode" style="display: none">

                                <label class="col-lg-3 control-label pt-2">

                                    <?php echo lang('create_member_enter_code'); ?>

                                </label>

                                <div class="col-lg-6">

                                    <div class="input-group input-group-4 mb-3" style="direction: ltr">

                                        <div class="input-group-append" >

                                            <span class="input-group-text px-0 py-0 mycustom-input-group"><button class="btn btn-success px-3 py-3" style="font-size: 14px" id="sendactive" type="button"><?php echo lang('create_member_activate'); ?></button></span>

                                        </div>

                                        <input type="text" autocomplete="off" value="<?php echo set_value('mobile'); ?>" name="mobilecode" id="mobilecode" class="form-control" aria-label="Large size" style="height: 54px;">

                                    </div>

                                    <?php echo form_error('mobile'); ?>

                                </div>

                            </div>



                            <div class="text-end">

                                <button type="button" id="cancel_mobile" class="btn btn-default btn-sm"><?php echo lang('create_member_cancel'); ?></button>

                            </div>

                        </form> -->
                        </div>
                        <!-- Tab content -->
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
