<script setup>
import Sidebar from './Sidebar.vue';

const props = defineProps({
    userAuth: Object,
});

let percentage = 30;
if (props.userAuth?.newspaper_type) percentage += 10;
if (props.userAuth?.profile_photo) percentage += 10;
if (props.userAuth?.national_id_photo) percentage += 10;
if (props.userAuth?.statement_photo) percentage += 10;
if (props.userAuth?.newspaper_type != 2) percentage += 10;
if (props.userAuth?.newspaper_type == 2 && props.userAuth?.license_photo) percentage += 10;
if (props.userAuth?.subscription.num == 3 && props.userAuth?.contract_photo) percentage += 10;
if (props.userAuth?.subscription.num != 3) percentage += 10;
if (props.userAuth?.exp_flds_lngs_complete) percentage += 10;
</script>

<template>
    <Head :title="__('Complete information')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <!-- page content -->
                    <div class="page-content account events text-start">
                        <h5>{{ __('Complete information') }}</h5>
                        <p class="text-muted">{{ __('To request a membership, the required information must be completed') }}</p>
                        <!-- Progress bar -->
                        <h4>{{ __('Completion percentage') }}</h4>
                        <div class="progress mb-2">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                aria-valuenow="<?php echo  $PROGRESSBAR;?>"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                :style="`background-color: green; width: ${percentage}%`"
                            >
                                {{ percentage }}%
                            </div>
                        </div>
                        <!-- Progress bar -->

                        <div class="featured-boxes">
                            <div class="row">
                                <div class="col">
                                    <div class="featured-box featured-box-primary text-left mt-2">
                                        <div class="box-content">
                                            <table class="table mycustom-table1 text-start">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px"></th>
                                                        <th>{{ __('Required') }}</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.profile_photo"></i>
                                                            <span v-if="!userAuth?.profile_photo">*</span>
                                                        </td>
                                                        <td :style="userAuth?.profile_photo ? 'text-decoration-line: line-through' : ''" :class="{ 'text-success': userAuth?.profile_photo }">
                                                            {{ __('Profile picture') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="!userAuth?.profile_photo" :href="route('member.profile.photo')" class="btn btn-rounded btn-success btn-sm">
                                                                {{ __('Upload') }}
                                                            </Link>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.national_id_photo"></i>
                                                            <span v-if="!userAuth?.national_id_photo">*</span>
                                                        </td>
                                                        <td :style="userAuth?.national_id_photo ? 'text-decoration-line: line-through' : ''" :class="{ 'text-success': userAuth?.national_id_photo }">
                                                            {{ __('A copy of the status or residence card') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="!userAuth?.national_id_photo" :href="route('member.profile.id')" class="btn btn-rounded btn-success btn-sm">
                                                                {{ __('Upload') }}
                                                            </Link>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.statement_photo"></i>
                                                            <span v-if="!userAuth?.statement_photo">*</span>
                                                        </td>
                                                        <td :style="userAuth?.statement_photo ? 'text-decoration-line: line-through' : ''" :class="{ 'text-success': userAuth?.statement_photo }">
                                                            {{ __('A statement from the employer regarding the current press position') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="!userAuth?.statement_photo" :href="route('member.profile.statement')" class="btn btn-rounded btn-success btn-sm">
                                                                {{ __('Upload') }}
                                                            </Link>
                                                        </td>
                                                    </tr>

                                                    <!-- if electronic newspaper (2) we need a license -->
                                                    <tr v-if="userAuth?.newspaper_type == 2">
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.license_photo"></i>
                                                            <span v-if="!userAuth?.license_photo">*</span>
                                                        </td>
                                                        <td :style="userAuth?.license_photo ? 'text-decoration-line: line-through' : ''" :class="{ 'text-success': userAuth?.license_photo }">
                                                            {{ __('Newspaper license') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="!userAuth?.license_photo" :href="route('member.profile.license')" class="btn btn-rounded btn-success btn-sm">{{
                                                                __('Upload')
                                                            }}</Link>
                                                        </td>
                                                    </tr>
                                                    <!-- if sub type is 3 upload job contract -->
                                                    <tr v-if="userAuth?.subscription.num == 3">
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.contract_photo"></i>
                                                            <span v-if="!userAuth?.contract_photo">*</span>
                                                        </td>
                                                        <td :style="userAuth?.contract_photo ? 'text-decoration-line: line-through' : ''" :class="{ 'text-success': userAuth?.contract_photo }">
                                                            {{ __('Job contract') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="!userAuth?.contract_photo" :href="route('member.profile.contract')" class="btn btn-rounded btn-success btn-sm">
                                                                {{ __('Upload') }}
                                                            </Link>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.exp_flds_lngs_complete"></i>
                                                            <span v-if="!userAuth?.exp_flds_lngs_complete">*</span>
                                                        </td>
                                                        <td
                                                            :style="userAuth?.exp_flds_lngs_complete ? 'text-decoration-line: line-through' : ''"
                                                            :class="{ 'text-success': userAuth?.exp_flds_lngs_complete }"
                                                        >
                                                            {{ __('Biography, experiences, fields, and languages') }}
                                                        </td>
                                                        <td>
                                                            <Link
                                                                v-if="!userAuth?.exp_flds_lngs_complete"
                                                                :href="route('member.profile.experiences')"
                                                                type="button"
                                                                class="btn btn-rounded btn-success btn-sm"
                                                            >
                                                                {{ __('Complete') }}
                                                            </Link>
                                                        </td>
                                                    </tr>

                                                    <tr v-if="!userAuth?.newspaper_type">
                                                        <td>
                                                            <i style="font-size: 16px" class="fas fa-check text-success" v-if="userAuth?.newspaper_type"></i>
                                                            <span v-if="!userAuth?.newspaper_type">*</span>
                                                        </td>
                                                        <td :style="userAuth?.newspaper_type ? 'text-decoration-line: line-through' : ''" class="text-success">
                                                            {{ __('Set the type of newspaper in the data') }}
                                                        </td>
                                                        <td>
                                                            <Link v-if="userAuth?.newspaper_type" :href="route('member.profile.info')" type="button" class="btn btn-rounded btn-success btn-sm">
                                                                {{ __('Complete') }}
                                                            </Link>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
