<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Object,
});

const form = useForm({
    category_id: '',
    title_ar: '',
    title_en: '',
    news_date: '',
    images: [],
    summary_ar: '',
    summary_en: '',
    content_ar: '',
    content_en: '',
});

let images = ref([]);

const handleImages = ($event) => {
    let files = $event.target.files;
    files.forEach((file) => {
        form.images.push(file);

        const reader = new FileReader();
        let rawImg;
        reader.onloadend = () => {
            rawImg = reader.result;
            images.value.push(rawImg);
        };
        reader.readAsDataURL(file);
    });
};
</script>

<template>
    <Head :title="__('Create article')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create article') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.articles.store'))" enctype="multipart/form-data">
                            <!-- Category -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="category_id">{{ __('Category') }}</label>
                                    <select class="form-control m-select2-no" id="category_id" v-model="form.category_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(category, k) in categories.data" :key="k" :value="category.id">{{ __(category.title) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.category_id">{{ form.errors.category_id }}</p>
                                </div>
                            </div>
                            <!-- Category -->

                            <!-- Title -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_ar">{{ __('Title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_ar" v-model="form.title_ar" :placeholder="__('Title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_ar">{{ form.errors.title_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_en">{{ __('Title') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_en" v-model="form.title_en" :placeholder="__('Title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_en">{{ form.errors.title_en }}</span>
                                </div>
                            </div>
                            <!-- Title -->

                            <!-- Date -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="news_date">{{ __('Date') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="date" id="news_date" v-model="form.news_date" :placeholder="__('Date')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.news_date">{{ form.errors.news_date }}</span>
                                </div>
                            </div>
                            <!-- Date -->

                            <!-- images -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="images">{{ __('Images') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="file" @change="handleImages" multiple />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.images">{{ form.errors.images }}</p>
                                    <div class="images border p-3" v-if="images.length">
                                        <img
                                            v-for="(img, i) in images"
                                            :key="i"
                                            :src="img"
                                            class="img-thumbnail d-inline mx-1"
                                            style="max-width: 120px"
                                            @click="
                                                form.images.splice(i, 1);
                                                images.splice(i, 1);
                                            "
                                        />
                                    </div>
                                </div>
                            </div>
                            <!-- images -->

                            <!-- Summary -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="summary_ar">{{ __('Summary') }}</label>
                                    <div class="input-group">
                                        <textarea class="form-control" type="text" id="summary_ar" v-model="form.summary_ar" :placeholder="__('Summary')"></textarea>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.summary_ar">{{ form.errors.summary_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="summary_en">{{ __('Summary') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <textarea class="form-control" type="text" id="summary_en" v-model="form.summary_en" :placeholder="__('Summary')"></textarea>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.summary_en">{{ form.errors.summary_en }}</span>
                                </div>
                            </div>
                            <!-- Summary -->

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
                                <Link :href="route('admin.articles.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
