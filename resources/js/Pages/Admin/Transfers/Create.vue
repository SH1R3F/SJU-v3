<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    branches: Object,
});

const form = useForm({
    national_id: '',
    transfer_to: ''
});
</script>

<template>
    <Head :title="__('Transfer member')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Subscriber Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Subscriber information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Transfer member') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.members.transfers.transfer'))">

                            <div class="mb-3 col-12">
                                <label class="form-label" for="national_id">{{ __('National ID number') }}</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="national_id" v-model="form.national_id" :placeholder="__('National ID number')" />
                                </div>
                                <span class="fs-6 text-danger" v-if="form.errors.national_id">{{ form.errors.national_id }}</span>
                            </div>

                            <!-- Branch -->
                            <div class="row" v-if="$page.props.authUser.data.role === 'Site admin'">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="branch">{{ __('Branch to') }}</label>
                                    <select class="form-control m-select2-no" id="branch" v-model="form.transfer_to">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.name}}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.transfer_to">{{ form.errors.transfer_to }}</p>
                                </div>
                            </div>
                            <!-- Branch -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.subscribers.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Subscriber information -->
            </div>
            <!--/ Subscriber Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
