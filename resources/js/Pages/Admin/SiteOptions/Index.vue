<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    categories: Object,
    service: Object,
});

const form = useForm({
    categories: props.categories,
});
</script>

<template>
    <Head :title="__('Site options')" />
    <div class="container-xxl flex-grow-1 container-p-y">
        <form @submit.prevent="form.post(route('admin.site.options'))">
            <div>
                <h4 class="fw-semibold mb-3">{{ __('Site options') }}</h4>
                <p class="mb-4">
                    {{ __('Here you can find and modify the options used over the website') }}
                </p>
            </div>

            <!-- SMS status and balance -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ __('SMS settings') }}</h5>

                    <!-- Option -->
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <label class="form-label">{{ __('Service provider') }}</label>
                            <div class="input-group">
                                <h4>{{ service.provider }}</h4>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <label class="form-label">{{ __('Available balance') }}</label>
                            <div class="input-group">
                                <h4>{{ service.balance }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Text option -->
                </div>
            </div>
            <!-- SMS status and balance -->

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div></div>
                <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
            </div>
            <!-- Categories cards -->
            <div class="card mb-2" v-for="(options, category) in form.categories">
                <div class="card-body">
                    <h5 class="card-title">{{ __(category) }}</h5>

                    <!-- Option -->
                    <div class="row" v-for="(option, i) in options">
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __(option.name) }}</label>
                            <template v-if="option.type == 'boolean'">
                                <select class="form-control m-select2-no" v-model="option.value">
                                    <option value="yes">{{ __('Yes') }}</option>
                                    <option value="no">{{ __('No') }}</option>
                                </select>
                            </template>
                            <template v-else>
                                <div class="input-group">
                                    <textarea rows="4" class="form-control" v-model="option.value"></textarea>
                                </div>
                            </template>
                        </div>
                        <hr class="my-3" v-if="i % 2 && i !== options.length - 1" />
                    </div>
                    <!-- Text option -->
                </div>
            </div>
            <!--/ Categories cards -->
        </form>
    </div>
</template>
