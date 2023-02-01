<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    type: 'photo',
    file: '',
    link: '',
    upload: true,
});
</script>

<template>
    <Head :title="__('Upload media')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Upload media') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.media.store'))">
                            <!-- Type -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="category_id">{{ __('Type') }}</label>
                                    <select class="form-control m-select2-no" id="type" v-model="form.type">
                                        <option value="photo">{{ __('Photo') }}</option>
                                        <option value="video">{{ __('Video') }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.type">{{ form.errors.type }}</p>
                                </div>
                            </div>
                            <!-- Type -->

                            <!-- File on my disk -->
                            <div class="row">
                                <div class="mb-3 form-check mt-3">
                                    <input class="form-check-input" v-model="form.upload" type="checkbox" id="upload" />
                                    <label class="form-check-label" for="upload"> {{ __('Upload file') }} </label>
                                </div>
                            </div>
                            <!-- File on my disk -->

                            <!-- File -->
                            <div class="row" v-if="form.upload">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="file">{{ __('File') }}</label>
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            :accept="form.type == 'photo' ? 'image/*' : 'video/mp4,video/x-m4v,video/*'"
                                            type="file"
                                            id="file"
                                            @change="form.file = $event.target.files[0]"
                                        />
                                    </div>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                    <p class="fs-6 text-danger" v-if="form.errors.file">{{ form.errors.file }}</p>
                                </div>
                            </div>
                            <!-- File -->

                            <!-- Link -->
                            <div class="row" v-else>
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name">{{ __('Link') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="url" id="link" :placeholder="__('Link')" v-model="form.link" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.link">{{ form.errors.link }}</p>
                                </div>
                            </div>
                            <!-- Link -->
                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Upload') }}</button>
                                <Link :href="route('admin.media.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
