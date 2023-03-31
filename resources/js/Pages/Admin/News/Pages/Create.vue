<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    slug_ar: '',
    slug_en: '',
    title_ar: '',
    title_en: '',
    content_ar: '',
    content_en: '',
});
</script>

<template>
    <Head :title="__('Create page')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create page') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.pages.store'))">
                            <!-- Page title -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_ar">{{ __('Page title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_ar" v-model="form.title_ar" :placeholder="__('Page title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_ar">{{ form.errors.title_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_en">{{ __('Page title') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_en" v-model="form.title_en" :placeholder="__('Page title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_en">{{ form.errors.title_en }}</span>
                                </div>
                            </div>
                            <!-- Page title -->

                            <!-- Page slug -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="slug_ar">{{ __('Page slug') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="slug_ar" v-model="form.slug_ar" :placeholder="__('Page slug')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.slug_ar">{{ form.errors.slug_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="slug_en">{{ __('Page slug') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="slug_en" v-model="form.slug_en" :placeholder="__('Page slug')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.slug_en">{{ form.errors.slug_en }}</span>
                                </div>
                            </div>
                            <!-- Page slug -->

                            <!-- Content -->
                            <div class="row mb-3">
                                <label class="form-label" for="content_ar">{{ __('Content') }}</label>
                                <QuillEditor theme="snow" toolbar="full" v-model:content="form.content_ar" contentType="html" :placeholder="__('Content')" />
                                <span class="fs-6 text-danger" v-if="form.errors.content_ar">{{ form.errors.content_ar }}</span>
                            </div>
                            <!-- Content -->

                            <!-- Content -->
                            <div class="row mb-3">
                                <label class="form-label" for="content_en">{{ __('Content') }} ({{ __('In English') }})</label>
                                <QuillEditor theme="snow" toolbar="full" v-model:content="form.content_en" contentType="html" :placeholder="__('Content')" />
                                <span class="fs-6 text-danger" v-if="form.errors.content_en">{{ form.errors.content_en }}</span>
                            </div>
                            <!-- Content -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2" :disabled="form.processing">{{ __('Create') }}</button>
                                <Link :href="route('admin.pages.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>

<style>
.ql-editor {
    direction: rtl;
    text-align: right;
    min-height: 100px;
    max-height: 500px;
}
</style>
