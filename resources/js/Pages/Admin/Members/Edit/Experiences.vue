<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    member: Object,
    nationalities: Object,
    branches: Object,
});
const form = useForm({
    exp_flds_lngs: props.member.exp_flds_lngs || {
        experiences: experiences || [],
        fields: fields || [],
        languages: languages || [],
    },
});
</script>

<template>
    <Head :title="__('Edit member')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Pills -->
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Index' }" :href="route('admin.members.edit', member.id)">
                            <i class="ti ti-check ti-xs me-1"></i>{{ __('Member info') }}
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Experiences' }" :href="route('admin.members.edit.experiences', member.id)">
                            <i class="ti ti-language ti-xs me-1"></i>
                            {{ __('Experiences & Fields') }}
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Documents' }" :href="route('admin.members.edit.documents', member.id)">
                            <i class="ti ti-files ti-xs me-1"></i>{{ __('Documents') }}
                        </Link>
                    </li>
                </ul>
                <!-- Pills -->

                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Experiences & Fields') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.put(route('admin.members.update.experiences', member.id))">
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
                                        <tr v-for="(experience, i) in form.exp_flds_lngs.experiences">
                                            <td>{{ i + 1 }}</td>
                                            <td>
                                                <input type="text" class="form-control" v-model="experience.title" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" v-model="experience.years" />
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm" @click.prevent="form.exp_flds_lngs.experiences.splice(i, 1)">
                                                    <i class="fa fa-trash-alt" style="color: red"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span class="text text-danger text-sm" v-if="form.errors['exp_flds_lngs.experiences']">{{ form.errors['exp_flds_lngs.experiences'] }}</span>
                                <div class="text-end">
                                    <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs.experiences.push({ title: undefined, years: undefined })">
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
                                    <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs.fields.push({ title: undefined })">{{ __('Add') }}</button>
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
                                    <button type="button" class="btn btn-default btn-sm" @click.prevent="form.exp_flds_lngs.languages.push({ title: undefined })">{{ __('Add') }}</button>
                                </div>
                            </div>
                            <!-- Languages -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.members.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Member information -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
