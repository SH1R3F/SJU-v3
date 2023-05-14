<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import TabList from './TabList.vue';

const props = defineProps({
    member: Object,
    member_type: String,
    branches: Array,
});

const form = useForm({
    type: props.member_type || undefined,
    branch_id: props.member.branch_id || undefined,
    delivery_option: props.member.delivery_option || undefined,
    delivery_address: props.member.delivery_address || undefined,
});
</script>

<template>
    <Head :title="__('Membership types')" />
    <div class="container my-4">
        <div class="registration-form">
            <tab-list active="types" />

            <!-- Page content -->

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                    <form @submit.prevent="form.post(route('member.register.step4'))" class="form-horizontal form-bordered">
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('National id number') }}
                            </label>

                            <div class="col-lg-3">
                                <h4>{{ member.national_id }}</h4>
                                <Link :href="route('member.register')" class="text-success">{{ __('Change') }}</Link>
                            </div>

                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('Activated mobile number') }}
                            </label>

                            <div class="col-lg-3">
                                <h4>966{{ member.mobile }}</h4>
                                <Link :href="route('member.register.step2')" class="text-success">{{ __('Change') }}</Link>
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- Table of sub types -->

                            <table class="table mycustom-table1">
                                <thead>
                                    <tr>
                                        <th>{{ __('Please choost the type that suits you:') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                    </tr>
                                </thead>
                                <div class="text text-danger text-sm" v-if="form.errors.type">{{ form.errors.type }}</div>
                                <tbody>
                                    <tr class="mt-1">
                                        <td>
                                            <div class="radio-custom radio-success">
                                                <input type="radio" id="fullTime" v-model="form.type" value="1" />
                                                <label for="fullTime">
                                                    <h4 class="mb-0 text-success text-success">
                                                        <strong>{{ __('Full-time member') }}</strong>
                                                    </h4>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="text-success" style="font-size: 22px">
                                                <strong>
                                                    250 {{ __('SAR') }}
                                                    <span class="text-dark" style="font-size: 12px">{{ __('Annualy') }} *</span>
                                                </strong>
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <ol class="text-muted">
                                                <li>{{ __('Every Saudi journalist is dedicated to the profession of journalism') }}</li>
                                                <li>
                                                    {{
                                                        __(
                                                            'Every accredited and full-time journalist to work as a reporter or office manager according to a written agreement for any of the local and non-local media outlets in exchange for a fixed salary and he does not practice any other profession'
                                                        )
                                                    }}
                                                </li>
                                                <li>
                                                    {{
                                                        __(
                                                            'That the media in which he works shall fulfill all the conditions for a journalistic profession and the arts of journalistic editing, chiefly news.'
                                                        )
                                                    }}
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="radio-custom radio-success">
                                                <input type="radio" id="partTime" v-model="form.type" value="2" />
                                                <label for="partTime">
                                                    <h4 class="mb-0 text-success">
                                                        <strong>{{ __('Part-time member') }}</strong>
                                                    </h4>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="text-success" style="font-size: 22px">
                                                <strong>
                                                    200 {{ __('SAR') }} <span class="text-dark" style="font-size: 12px">{{ __('Annualy') }} *</span></strong
                                                >
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <ol class="text-muted">
                                                <li>{{ __('Every Saudi journalist partially practices journalistic work') }}</li>
                                                <li>{{ __('It includes Saudi journalists who occupy governmental or non-governmental jobs and who work alongside their perpetrators') }}</li>
                                            </ol>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="radio-custom radio-success">
                                                <input type="radio" id="affiliate" v-model="form.type" value="3" />

                                                <label for="affiliate">
                                                    <h4 class="mb-0 text-success">
                                                        <strong>{{ __('Affiliate member') }}</strong>
                                                    </h4>
                                                </label>
                                            </div>
                                        </td>

                                        <td>
                                            <h4 class="text-success" style="font-size: 22px">
                                                <strong>
                                                    150 {{ __('SAR') }}
                                                    <span class="text-dark" style="font-size: 12px">{{ __('Annualy') }} *</span>
                                                </strong>
                                            </h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <ol class="text-muted">
                                                <li>{{ __('Every non-Saudi journalist residing in the Kingdom and working in the journalistic field under a work contract.') }}</li>
                                            </ol>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Table of sub types -->
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('Membership branch') }}
                            </label>

                            <div class="col-lg-6">
                                <select class="form-control m-input--square" v-model="form.branch_id">
                                    <option value="">{{ __('Select branch') }}</option>
                                    <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                                </select>
                                <div class="text text-danger text-sm" v-if="form.errors.branch_id">{{ form.errors.branch_id }}</div>
                            </div>
                        </div>

                        <!-- Option for delivery -->
                        <div class="form-group row delivery_option">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('Card delivery method') }}
                            </label>

                            <div class="col-lg-6">
                                <select class="form-control m-input--square" v-model="form.delivery_option">
                                    <option value="">{{ __('Choose') }}</option>
                                    <option value="1">{{ __('Pickup from branch') }}</option>
                                    <option value="2">{{ __('Delivery') }}</option>
                                </select>
                                <small id="deliverHelp" class="form-text text-muted">{{ __('In the case of choosing delivery, 35.42 riyals will be added to the invoice value.') }}</small>
                                <div class="text text-danger text-sm" v-if="form.errors.delivery_option">{{ form.errors.delivery_option }}</div>
                            </div>
                        </div>
                        <!-- option for delivery -->

                        <!-- The delivery address -->
                        <div class="form-group row" v-if="form.delivery_option == 2">
                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                {{ __('Delivery address') }}
                            </label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control" v-model="form.delivery_address" />
                                <div class="text text-danger text-sm" v-if="form.errors.delivery_address">{{ form.errors.delivery_address }}</div>
                            </div>
                        </div>
                        <!-- option for delivery -->

                        <div class="form-group row">
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">{{ __('Next') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Page content -->
        </div>
    </div>
</template>
