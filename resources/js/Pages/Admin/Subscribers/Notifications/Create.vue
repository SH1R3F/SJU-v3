<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const form = useForm({
    message: '',
    via: {},
    to_type: 'select',
    recipients: [],
});

const somethin = ref(null);

const sendNotification = () => {
    form.recipients = somethin.value.getAttribute('data-result')?.split(',') || [];
    form.post(route('admin.subscribers.notify'));
};
</script>

<template>
    <Head :title="__('Notify subscribers')" />

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- User information -->
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Notify subscribers') }}</h5>
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
                                <select id="select2Multiple" class="select2 form-select" ref="somethin" multiple></select>
                            </div>
                            <span class="fs-6 text-danger" v-if="form.errors.recipients">{{ form.errors.recipients }}</span>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="select" value="select" v-model="form.to_type" />
                                    <label class="form-check-label" for="select"> {{ __('Select') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="all" value="all" v-model="form.to_type" />
                                    <label class="form-check-label" for="all"> {{ __('All subscribers') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="active" value="active" v-model="form.to_type" />
                                    <label class="form-check-label" for="active"> {{ __('Active subscribers') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="inactive" value="inactive" v-model="form.to_type" />
                                    <label class="form-check-label" for="inactive"> {{ __('Inactive subscribers') }} </label>
                                </div>
                            </div>

                            <span class="fs-6 text-danger" v-if="form.errors.to_type">{{ form.errors.to_type }}</span>
                        </div>
                    </div>
                    <!-- Send to -->

                    <div>
                        <button type="submit" class="btn btn-primary me-2">{{ __('Send') }}</button>
                        <Link :href="route('admin.subscribers.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
            $('.select2').select2({
                ajax: {
                    url: route('admin.subscribers.notify.chuncks'),
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            name: params.term,
                            page: params.page || 1,
                        };
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: Object.values(data.data),
                            pagination: {
                                more: data.next_page_url,
                            },
                        };
                    },
                    delay: 250,
                },
            });
            $('.select2').on('select2:select select2:unselect', function (e) {
                $(this).attr('data-result', $('.select2').val().join(','));
            });
        });
    },
};
</script>
