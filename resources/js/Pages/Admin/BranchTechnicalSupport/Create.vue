<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    attachment: '',
    body: '',
});
</script>

<template>
    <Head :title="__('Technical Support')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Technical Support') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.branch-issues.store'))">

                            <!-- Title -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="title">{{ __('Ticket title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title" :placeholder="__('Ticket title')" v-model="form.title" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.title">{{ form.errors.title }}</p>
                                </div>
                            </div>
                            <!-- Title -->

                            <!-- Details -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="title">{{ __('Details') }}</label>
                                    <div class="input-group">
                                        <textarea v-model="form.body" class="form-control" id="title" rows="7" :placeholder="__('Details')"></textarea>
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.body">{{ form.errors.body }}</p>

                                    <label for="attachment" class="text-muted d-block" style="cursor: pointer">
                                        <label for="attachment" class="cursor-pointer" :class="{ 'text-success': form.attachment }">+ {{ __('Attachment') }}</label>
                                        <input type="file" id="attachment" @change="form.attachment = $event.target.files[0]" style="display: none" />
                                    </label>
                                    <p class="text text-danger text-sm" v-if="form.errors.attachment">{{ form.errors.attachment }}</p>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                </div>
                            </div>
                            <!-- Details -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.branch-issues.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
