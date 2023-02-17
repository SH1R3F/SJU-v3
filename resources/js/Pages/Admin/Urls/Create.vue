<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    image: '',
    link: '',
    target: '_self',
    group: 2,
});
</script>

<template>
    <Head :title="__('Create url')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create url') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.urls.store'))">
                            <!-- Title -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="title">{{ __('Title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title" :placeholder="__('Title')" v-model="form.title" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.title">{{ form.errors.title }}</p>
                                </div>
                            </div>
                            <!-- Title -->

                            <!-- Image on my disk -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="image">{{ __('Image') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" accept="image/*" type="file" id="image" @change="form.image = $event.target.files[0]" />
                                    </div>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                    <p class="fs-6 text-danger" v-if="form.errors.image">{{ form.errors.image }}</p>
                                </div>
                            </div>
                            <!-- Image on my disk -->

                            <!-- Link -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="link">{{ __('Link') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="url" id="link" :placeholder="__('Link')" v-model="form.link" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.link">{{ form.errors.link }}</p>
                                </div>
                            </div>
                            <!-- Link -->

                            <!-- Target -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="target">{{ __('Opens in') }}</label>
                                    <select class="form-control m-select2-no" id="target" v-model="form.target">
                                        <option value="_self">{{ __('Same window') }}</option>
                                        <option value="_blank">{{ __('New window') }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.target">{{ form.errors.target }}</p>
                                </div>
                            </div>
                            <!-- Target -->

                            <!-- Group -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="group">{{ __('Group') }}</label>
                                    <select class="form-control m-select2-no" id="group" v-model="form.group">
                                        <option value="1">{{ __('Electronic newspaper') }}</option>
                                        <option value="2">{{ __('Paper newspaper') }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.group">{{ form.errors.group }}</p>
                                </div>
                            </div>
                            <!-- Group -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.urls.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
