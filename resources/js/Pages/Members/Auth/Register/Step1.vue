<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
});

const form = useForm({
    national_id: props.member?.national_id || undefined,
});
</script>

<template>
    <Head :title="__('Registration')" />
    <div class="container my-4">
        <div class="registration-form">
            <tab-list active="nid" />

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                    <!-- Terms and conditions -->

                    <h5 class="mt-1">{{ __('Terms and conditions:') }}</h5>

                    <ol id="setcond" class="list list-icons list-success">
                        <li class="text-success my-2">
                            <i></i>
                            {{ __('Be at least 20 years old') }}
                        </li>

                        <li class="text-success my-2">
                            <i></i>
                            {{ __('To practice his journalistic activity effectively and continuously, and to have spent in the profession full-time for a period of not less than a year') }}
                        </li>

                        <li class="text-success my-2">
                            <i></i>
                            {{ __('To be practicing activity in one of the local media organizations or accredited as a correspondent for foreign media or working as a journalist for them') }}
                        </li>

                        <li class="text-success my-2">
                            <i></i>
                            {{
                                __('That he be practicing any of the journalistic activities detailed in Article (20) of the Regulations in accordance with the controls set by the General Assembly.')
                            }}
                        </li>

                        <li class="text-success my-2">
                            <i></i>
                            {{ __('He should not have been convicted of a crime involving moral turpitude or dishonesty.') }}
                        </li>

                        <li class="text-success my-2">
                            <i></i>
                            {{ __('To submit the necessary supporting documents required by the authority.') }}
                        </li>
                    </ol>

                    <!-- Terms and conditions -->

                    <!-- Accept terms and conditions -->
                    <div class="col-md-6">
                        <div class="checkbox-custom">
                            <input type="checkbox" id="setagree" />

                            <label for="setagree" class="text-muted lead">{{ __('I agree to all conditions') }}</label>
                        </div>
                    </div>
                    <!-- Accept terms and conditions -->

                    <!-- Page divider -->

                    <div class="divider divider-solid my-4">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <!-- Page divider -->

                    <!-- Nid registration -->

                    <div class="row" id="setnid" style="display: none">
                        <div class="col-md-12">
                            <form id="registerform" class="form-horizontal form-bordered mycustom-form1" @submit.prevent="form.post(route('member.register.step2'))">
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="national_id">{{ __('National id number') }}</label>

                                    <div class="col-lg-4">
                                        <div class="input-group input-group-4 mb-3">
                                            <input
                                                id="national_id"
                                                type="text"
                                                autocomplete="off"
                                                class="form-control form-control-lg h-auto"
                                                maxlength="10"
                                                style="font-size: 20px; direction: ltr"
                                                v-model="form.national_id"
                                            />

                                            <span class="input-group-prepend">
                                                <span class="input-group-text px-4 mycustom-input-group alert-success" style="font-size: 22px">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="text text-danger text-sm" v-if="form.errors.national_id">{{ form.errors.national_id }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">{{ __('Next') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Nid registration -->
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
export default {
    mounted() {
        $('body').on('click', '#setagree', function (e) {
            if ($('#setagree').is(':checked')) {
                $('#setcond').css({ 'list-style': 'none' });
                $('#setcond').find('i').addClass('fas fa-check');
                $('#setagree').parents('label').css('color', '#008141');
                $('#setnid').slideDown();
            } else {
                $('#setcond').css({ 'list-style': 'decimal' });
                $('#setcond').find('i').removeClass('fas fa-check');
                $('#setagree').parents('label').css('color', '');
                $('#setnid').slideUp();
            }
        });
    },
};
</script>
