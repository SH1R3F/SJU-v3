<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name_ar: '',
    name_en: '',
    status: 1,
});
</script>

<template>
    <Head :title="__('Create questionnaire')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create questionnaire') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.questionnaires.store'))">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name_ar">{{ `${__('Name')} (${__('In Arabic')})` }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name_ar" :placeholder="__('Name')" v-model="form.name_ar" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name_ar">{{ form.errors.name_ar }}</span>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name_en">{{ `${__('Name')} (${__('In English')})` }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name_en" :placeholder="__('Name')" v-model="form.name_en" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name_en">{{ form.errors.name_en }}</span>
                                </div>
                            </div>
                            <!-- Name -->

                            <!-- Status -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="status">{{ __('Status') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="status" v-model="form.status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.status">{{ form.errors.status }}</span>
                                </div>
                            </div>
                            <!-- Status -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.questionnaires.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
