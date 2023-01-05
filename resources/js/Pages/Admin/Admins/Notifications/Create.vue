<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps({
    admins: Object,
});

const form = useForm({
    message: '',
    via: {},
    to_type: 'select',
    recipients: [],
});

const somethin = ref(null);

const sendNotification = () => {
    form.recipients = somethin.value.getAttribute('data-result')?.split(',') || [];
    form.post(route('admin.admins.notify'));
};
</script>

<template>
    <Head :title="__('Notify moderators')" />

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- User information -->
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Notify moderators') }}</h5>
            <div class="card-body">
                <form @submit.prevent="sendNotification">
                    <!-- Message -->
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label" for="message">{{ __('Message') }}</label>
                            <div class="input-group">
                                <textarea class="form-control" id="message" v-model="form.message" :placeholder="__('Message')"></textarea>
                            </div>
                            <span class="fs-6 text-danger" v-if="form.errors.message">{{ form.errors.message }}</span>
                        </div>
                    </div>
                    <!-- Message -->

                    <!-- Send via -->
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label">{{ __('Send via') }}</label>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="mail" v-model="form.via.mail" />
                                    <label class="form-check-label" for="mail"> {{ __('Email') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="sms" v-model="form.via.sms" />
                                    <label class="form-check-label" for="sms"> {{ __('SMS') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="database" v-model="form.via.database" />
                                    <label class="form-check-label" for="database"> {{ __('In-app notification') }} </label>
                                </div>
                            </div>
                            <span class="fs-6 text-danger" v-if="form.errors.via">{{ form.errors.via }}</span>
                        </div>
                    </div>
                    <!-- Send via -->

                    <!-- Send to -->
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label">{{ __('Send to') }}</label>
                            <div class="input-group" v-show="form.to_type === 'select'">
                                <select id="select2Multiple" class="select2 form-select" ref="somethin" multiple>
                                    <option v-for="admin in admins.data" :key="admin.id" :value="admin.id">{{ admin.fullName }}</option>
                                </select>
                            </div>
                            <span class="fs-6 text-danger" v-if="form.errors.recipients">{{ form.errors.recipients }}</span>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="select" value="select" v-model="form.to_type" />
                                    <label class="form-check-label" for="select"> {{ __('Select') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="all" value="all" v-model="form.to_type" />
                                    <label class="form-check-label" for="all"> {{ __('All Moderators') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="admins" value="Site admin" v-model="form.to_type" />
                                    <label class="form-check-label" for="admins"> {{ __('Site admins') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="managers" value="Branch manager" v-model="form.to_type" />
                                    <label class="form-check-label" for="managers"> {{ __('Branch managers') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="editors" value="News editor" v-model="form.to_type" />
                                    <label class="form-check-label" for="editors"> {{ __('News editors') }} </label>
                                </div>
                            </div>

                            <span class="fs-6 text-danger" v-if="form.errors.to_type">{{ form.errors.to_type }}</span>
                        </div>
                    </div>
                    <!-- Send to -->

                    <div>
                        <button type="submit" class="btn btn-primary me-2">{{ __('Send') }}</button>
                        <Link :href="route('admin.admins.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                    </div>
                </form>
            </div>
        </div>
        <!-- User information -->

        <!-- /Modals -->
    </div>
    <!-- / Content -->
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(function () {
            $('.select2').select2();
            $('.select2').on('select2:select select2:unselect', function (e) {
                $(this).attr('data-result', $('.select2').val().join(','));
            });
        });
    },
};
</script>
