<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
});

const form = useForm({
    mobile: props.member.mobile || '',
    mobilecode: '',
});

const send = ref(true);
const codeSent = ref(false);
const timer2 = ref(null);
const settimermm = () => {
    timer2.value = '2:30';
    var interval = setInterval(function () {
        var timer = timer2.value.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = seconds < 0 ? --minutes : minutes;
        seconds = seconds < 0 ? 59 : seconds;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        minutes = minutes < 10 ? minutes : minutes;
        timer2.value = minutes + ':' + seconds;
        if (seconds == 0 && minutes == 0) {
            clearInterval(interval);
            timer2.value = null;
            send.value = true;
        }
    }, 1000);
};
</script>

<template>
    <Head :title="__('Contact info')" />
    <div class="container my-4">
        <div class="registration-form">
            <tab-list active="contact" />

            <!-- Page content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                    <form class="mt-4" @submit.prevent="form.post(route('member.register.step3'), { preserveScroll: true })">
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('National id number') }}</label>
                            <div class="col-lg-4">
                                <h4>{{ member.national_id }}</h4>
                                <Link :href="route('member.register')" class="text-success">{{ __('Change') }}</Link>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">{{ __('Mobile number') }}</label>
                            <div class="col-lg-4">
                                <div class="input-group input-group-4">
                                    <span class="input-group-append" v-if="$page.props.locale === 'en'">
                                        <span class="input-group-text px-3 alert-success" style="font-size: 25px">966</span>
                                    </span>
                                    <input
                                        type="text"
                                        v-model="form.mobile"
                                        autocomplete="off"
                                        class="form-control form-control-lg"
                                        maxlength="9"
                                        style="font-size: 20px; height: 54px"
                                        :readonly="!send"
                                    />
                                    <span class="input-group-prepend" v-if="$page.props.locale === 'ar'">
                                        <span class="input-group-text px-3 alert-success" style="font-size: 25px">966</span>
                                    </span>
                                </div>
                                <div class="text-danger text-sm text" v-if="$page.props.errors.mobile">{{ $page.props.errors.mobile }}</div>

                                <div class="input-group-append mt-3" style="margin-top: 10px">
                                    <button
                                        class="btn btn-success"
                                        @click.prevent="
                                            $inertia.post(
                                                route('member.register.verify.send'),
                                                { mobile: form.mobile },

                                                {
                                                    preserveScroll: true,
                                                    onSuccess: () => {
                                                        timer2 = null;
                                                        settimermm();
                                                        codeSent = true;
                                                        send = false;
                                                    },
                                                }
                                            )
                                        "
                                        type="button"
                                        :disabled="!send"
                                    >
                                        {{ __('Send verification code') }}
                                    </button>
                                    <div class="countdown mt-3 mr-3" style="font-weight: bold; font-size: 25px">{{ timer2 }}</div>
                                </div>
                                <span class="m-form__help"> {{ __('E.g. 501234567') }}</span>
                            </div>
                            <div class="text-end">
                                <Link class="btn btn-default" :href="route('member.register.step3')" v-if="member.mobile_verified_at">
                                    {{ __('Next') }}
                                </Link>
                            </div>
                        </div>

                        <div class="form-group row" v-if="codeSent">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('Enter verification code') }}
                            </label>
                            <div class="col-lg-4">
                                <div class="input-group input-group-4 mb-3" style="direction: ltr">
                                    <div class="input-group-append" v-if="$page.props.locale === 'ar'">
                                        <span class="alert-success">
                                            <button type="submit" class="btn btn-success px-3 py-3" style="font-size: 14px">{{ __('Activate') }}</button>
                                        </span>
                                    </div>
                                    <input type="text" autocomplete="off" v-model="form.mobilecode" class="form-control" style="height: 54px" />
                                    <div class="input-group-prepend" v-if="$page.props.locale === 'en'">
                                        <span class="alert-success">
                                            <button type="submit" class="btn btn-success px-3 py-3" style="font-size: 14px">{{ __('Activate') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-danger text-sm text" v-if="form.errors.mobilecode">{{ form.errors.mobilecode }}</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Page content -->
        </div>
    </div>
</template>
