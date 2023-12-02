<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

defineProps({
    nationalities: Object
});
const somethin = ref(null);

const form = useForm({
    candidates: [],
});



const createCandidate = () => {
    form.candidates = somethin.value.getAttribute('data-result')?.split(',') || [];

    if (!form.candidates.length) {
        form.errors.candidates = __('This field is required')
        return;
    }

    form.post(route('admin.candidates.store'));
};
</script>

<template>
    <Head :title="__('Create candidate')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Volunteer Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Volunteer information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create candidate') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="createCandidate">
                            <!-- Candidate -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="candidate">{{ __('Candidate') }}</label>
                                    <div class="input-group">
                                        <select id="select2Multiple" class="select2 form-select" ref="somethin" multiple></select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.candidates">{{ form.errors.candidates }}</span>
                                </div>
                            </div>
                            <!-- Candidate -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.candidates.index')" as="button" type="reset"
                                    class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Volunteer information -->
            </div>
            <!--/ Volunteer Content -->
        </div>
    </div><!-- / Content -->
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(function () {
            $('.select2').select2({
                ajax: {
                    url: route('admin.candidates.chuncks'),
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            name: params.term,
                            page: params.page || 1,
                        };
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: Object.values(data.data),
                            pagination: {
                                more: data.next_page_url,
                            },
                        };
                    },
                    delay: 250,
                },
            });
            $('.select2').on('select2:select select2:unselect', function (e) {
                $(this).attr('data-result', $('.select2').val().join(','));
            });
        });
    },
};
</script>
