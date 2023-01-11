<script setup>
import Sidebar from '../Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import NavTabs from './NavTabs.vue';

const props = defineProps({
    userAuth: Object,
});

let experiences = props.userAuth?.exp_flds_lngs?.experiences?.filter((exp) => exp.title && exp.years) || [];
let fields = props.userAuth?.exp_flds_lngs?.fields?.filter((fld) => fld.title) || [];
let languages = props.userAuth?.exp_flds_lngs?.languages?.filter((lng) => lng.title && lng.level) || [];
const form = useForm({
    exp_flds_lngs: {
        experiences: experiences || [],
        fields: fields || [],
        languages: languages || [],
    },
});
</script>

<template>
    <Head :title="__('Experiences & Fields')" />
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
                        <div class="tab-content text-start" id="myTabContent">
                            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                                <form @submit.prevent="form.post(route('member.profile.experiences'))">
                                    <h5 class="mt-2">{{ __('CV, experiences, fields and languages') }}</h5>
                                    <!-- Experiences -->
                                    <div>
                                        <table class="table mycustom-table1">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px"></th>
                                                    <th style="width: 60%">{{ __('Experience') }}</th>
                                                    <th>{{ __('Years') }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(experience, i) in form.exp_flds_lngs?.experiences">
                                                    <td>{{ i + 1 }}</td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="experience.title" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="experience.years" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" @click.prevent="form.exp_flds_lngs?.experiences.splice(i, 1)">
                                                            <i class="fa fa-trash-alt" style="color: red"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <span class="text text-danger text-sm" v-if="form.errors['exp_flds_lngs.experiences']">{{ form.errors['exp_flds_lngs.experiences'] }}</span>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs?.experiences.push({ title: undefined, years: undefined })">
                                                {{ __('Add') }}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Experiences -->

                                    <!-- Fields -->
                                    <div>
                                        <table class="table mycustom-table1">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px"></th>
                                                    <th>{{ __('Areas in which you would like to contribute') }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(field, i) in form.exp_flds_lngs.fields" :key="i">
                                                    <td>{{ i + 1 }}</td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="field.title" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" @click.prevent="form.exp_flds_lngs.fields.splice(i, 1)">
                                                            <i class="fa fa-trash-alt" style="color: red"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <span class="text text-danger text-sm" v-if="form.errors['exp_flds_lngs.fields']">{{ form.errors['exp_flds_lngs.fields'] }}</span>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs?.fields.push({ title: undefined })">{{ __('Add') }}</button>
                                        </div>
                                    </div>
                                    <!-- Fields -->

                                    <!-- Languages -->
                                    <div>
                                        <table class="table mycustom-table1">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px"></th>
                                                    <th>{{ __('The languages you are good at') }}</th>
                                                    <th>{{ __('Level') }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(language, i) in form.exp_flds_lngs.languages">
                                                    <td>{{ i + 1 }}</td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="language.title" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="language.level" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" @click.prevent="form.exp_flds_lngs.languages.splice(i, 1)">
                                                            <i class="fa fa-trash-alt" style="color: red"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <span class="text text-danger text-sm" v-if="form.errors['exp_flds_lngs.languages']">{{ form.errors['exp_flds_lngs.languages'] }}</span>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs?.languages.push({ title: undefined })">{{ __('Add') }}</button>
                                        </div>
                                    </div>
                                    <!-- Languages -->

                                    <div class="row">
                                        <div class="col-6 mt-5">
                                            <h6 class="text-info">
                                                <span v-if="userAuth?.status >= 1">{{ __("Your info can't be modified after branch approval") }}</span>
                                            </h6>
                                        </div>
                                        <div class="col-6 text-end mt-5">
                                            <button type="submit" class="btn btn-success" :disabled="userAuth?.status >= 1">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Tab content -->
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
