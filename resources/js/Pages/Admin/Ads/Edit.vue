<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    ad: Object,
});

const form = useForm({
    title_ar: props.ad.title_ar || '',
    title_en: props.ad.title_en || '',
    image: '',
    link: props.ad.link || '',
    target: props.ad.target || '_self',
    only_image: props.ad.only_image || false,
    _method: 'PUT',
});
</script>

<template>
    <Head :title="__('Edit ad')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Edit ad') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.ads.update', ad.id))">
                            <!-- Title (Arabic & English) -->
                            <div class="row">
                                <div class="mb-3 col-12 col-md-6">
                                    <label class="form-label" for="title_ar">{{ __('Title') }} ({{ __('In Arabic') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_ar" :placeholder="__('Title')" v-model="form.title_ar" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.title_ar">{{ form.errors.title_ar }}</p>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label class="form-label" for="title_en">{{ __('Title') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_en" :placeholder="__('Title')" v-model="form.title_en" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.title_en">{{ form.errors.title_en }}</p>
                                </div>
                            </div>
                            <!-- Title (Arabic & English) -->

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

                            <!-- Show only image -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <div class="d-flex gap-3 flex-wrap">
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" id="only_image" v-model="form.only_image" />
                                            <label class="form-check-label" for="only_image"> {{ __('Show only image') }} </label>
                                        </div>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.only_image">{{ form.errors.only_image }}</span>
                                </div>
                            </div>
                            <!-- Show only image -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.ads.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
