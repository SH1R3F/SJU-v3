<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    file: '',
});
</script>

<template>
    <Head :title="__('Upload file')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Upload file') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.training-bag.store'))">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name" :placeholder="__('Name')"
                                            v-model="form.name" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <!-- Name -->
                            <!-- File -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="file">{{ __('File') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="file"
                                            @change="form.file = $event.target.files[0]" />
                                    </div>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{
                                        form.progress.percentage }}%</progress>
                                    <span class="fs-6 text-danger" v-if="form.errors.file">{{ form.errors.file }}</span>
                                </div>
                            </div>
                            <!-- File -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Upload') }}</button>
                                <Link :href="route('admin.training-bag.index')" as="button" type="reset"
                                    class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Member information -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
<!-- / Content --></template>
