<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    competition: Object,
});

const form = useForm({
    name: props.competition.name || '',
    status: props.competition.status || '1',
    allow_guests: props.competition.allow_guests || 1,
    competition_fields: props.competition.fields || [
        {
            title: '',
            type: 'text',
            required: false,
        }
    ],
    _method: 'PUT',
});

const competition_field = {
    title: '',
    type: 'text',
    required: false,
};

</script>

<template>
    <Head :title="__('Edit competition')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Edit competition') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.competitions.update', competition.id))">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name" v-model="form.name" :placeholder="__('Name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <!-- Name -->

                            <!-- Status -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="status">{{ __('Status') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="status" v-model="form.status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.status">{{ form.errors.status }}</span>
                                </div>
                            </div>
                            <!-- Status -->

                            <hr />

                            <!-- Competition Fields -->
                            <div class="row" v-for="(competition_field, i) in form.competition_fields" :key="i">
                                <div class="mb-3 col-12 col-md-4">
                                    <label class="form-label" :for="`text-${i}`">{{ __('Field') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" :id="`text-${i}`" v-model="competition_field.title" :placeholder="__('Field')" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors[`competition_fields.${i}.title`]">{{ form.errors[`competition_fields.${i}.title`] }}</p>
                                </div>

                                <div class="mb-3 col-12 col-md-4">
                                    <label class="form-label" :for="`field-${i}`">{{ __('Field type') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" :id="`field-${i}`" v-model="competition_field.type">
                                            <option value="text">{{ __('text') }}</option>
                                            <option value="date">{{ __('date') }}</option>
                                            <option value="file">{{ __('file') }}</option>
                                        </select>
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors[`competition_fields.${i}.type`]">{{ form.errors[`competition_fields.${i}.type`] }}</p>
                                </div>

                                <div class="mb-3 col-12 col-md-2 row">
                                    <label class="form-label" :for="`required-${i}`"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="competition_field.required" type="checkbox" :id="`required-${i}`" />
                                        <label class="form-check-label" :for="`required-${i}`"> {{ __('required') }} </label>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label"></label>
                                    <div>
                                        <button class="btn btn-link btn-label-danger" @click.prevent="form.competition_fields.splice(i, 1)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" @click.prevent="form.competition_fields.push(JSON.parse(JSON.stringify(competition_field)))">{{ __('Add field') }}</button>
                            <!-- Competition Fields -->

                            <hr />


                            <div>
                                <button type="submit" class="btn btn-primary me-2" :disabled="form.processing">{{ __('Update') }}</button>
                                <Link :href="route('admin.competitions.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Information -->
            </div>
            <!--/ Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
