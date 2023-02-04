<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    category: Object,
});

const form = useForm({
    title_ar: props.category.title_ar || '',
    title_en: props.category.title_en || '',
});
</script>

<template>
    <Head :title="__('Edit page')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Edit page') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.put(route('admin.categories.update', category.id))">
                            <!-- Title -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="title_ar">{{ __('Title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_ar" v-model="form.title_ar" :placeholder="__('Title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_ar">{{ form.errors.title_ar }}</span>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="title_en">{{ __('Title') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_en" v-model="form.title_en" :placeholder="__('Title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_en">{{ form.errors.title_en }}</span>
                                </div>
                            </div>
                            <!-- Title -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.categories.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
