<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';


defineProps({
    branches: Object,
});

const form = useForm({
    message: '',
    via: {},
    to_type: 'select',
    recipients: [],
    branch: 'all',
    status: 'all'
});

const somethin = ref(null);

const sendNotification = () => {
    form.recipients = somethin.value.getAttribute('data-result')?.split(',') || [];
    form.post(route('admin.members.notify'));
};
</script>

<template>
    <Head :title="__('Notify members')" />

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- User information -->
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Notify members') }}</h5>
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
                                    <label class="form-check-label" for="all"> {{ __('All members') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="fulltime" value="fulltime" v-model="form.to_type" />
                                    <label class="form-check-label" for="fulltime"> {{ __('Full-time members') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="parttime" value="parttime" v-model="form.to_type" />
                                    <label class="form-check-label" for="parttime"> {{ __('Part-time members') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendTo" id="affiliate" value="affiliate" v-model="form.to_type" />
                                    <label class="form-check-label" for="affiliate"> {{ __('Affiliate members') }} </label>
                                </div>
                            </div>

                            <span class="fs-6 text-danger" v-if="form.errors.to_type">{{ form.errors.to_type }}</span>
                        </div>
                    </div>
                    <!-- Send to -->

                    <!-- Branch -->
                    <div class="row" v-if="form.to_type !== 'select' && !['Branch manager', 'Employee'].includes($page.props.authUser.data.role)">
                        <div class="mb-3 col-12">
                            <label class="form-label">{{ __('Branch') }}</label>
                            <div class="input-group">
                                <select class="form-select" v-model='form.branch'>
                                    <option value='all'>{{__('All')}}</option>
                                    <option v-for='branch in branches' :key='branch.id' :value='branch.id'>{{branch.name}}</option>
                                </select>
                            </div>
                            <span class="fs-6 text-danger" v-if="form.errors.to_type">{{ form.errors.branch }}</span>
                        </div>
                    </div>
                    <!-- Branch -->


                    <!-- Send to -->
                    <div class="row" v-if="form.to_type !== 'select'">
                        <div class="mb-3 col-12">
                            <label class="form-label">{{ __('Status') }}</label>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendStatus" id="all" value="all" v-model="form.status" />
                                    <label class="form-check-label" for="all"> {{ __('All') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendStatus" id="members" value="members" v-model="form.status" />
                                    <label class="form-check-label" for="members"> {{ __('Members') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendStatus" id="branch_approval" value="branch_approval" v-model="form.status" />
                                    <label class="form-check-label" for="branch_approval"> {{ __('Branch approval') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendStatus" id="admin_approval" value="admin_approval" v-model="form.status" />
                                    <label class="form-check-label" for="admin_approval"> {{ __('Admin approval') }} </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="sendStatus" id="refused" value="refused" v-model="form.status" />
                                    <label class="form-check-label" for="refused"> {{ __('Refused members') }} </label>
                                </div>
                            </div>

                            <span class="fs-6 text-danger" v-if="form.errors.status">{{ form.errors.status }}</span>
                        </div>
                    </div>
                    <!-- Send to -->

                    <div>
                        <button type="submit" class="btn btn-primary me-2">{{ __('Send') }}</button>
                        <Link :href="route('admin.members.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
                    url: route('admin.members.notify.chuncks'),
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
