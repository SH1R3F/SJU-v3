<script setup>
const props = defineProps({
    questionnaire: Object,
    filters: Object,
});
</script>

<template>
    <Head :title="`${__('Questions of')} ${questionnaire.name}`" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ `${__('Questions of')} ${questionnaire.name}` }}</h5>
            </div>
            <div class="card-datatable table-responsive">
                <div class="row me-2 py-3 text-center">
                    <div class="col-md-12 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="questionnaire.viewable" :href="route('admin.questions.create', questionnaire.id)" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create question') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th class="cell-fit">{{ __('Question') }}</th>
                            <th class="cell-fit">{{ __('Status') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="question in questionnaire.questions">
                            <td>{{ question.question }}</td>
                            <td>{{ question.state }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        :href="route('admin.questions.edit', { questionnaire: questionnaire.id, question: question.id })"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Edit')"
                                        :title="__('Edit')"
                                    >
                                        <i class="ti ti-edit mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        :href="route('admin.questions.destroy', { questionnaire: questionnaire.id, question: question.id })"
                                        method="DELETE"
                                        as="span"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Delete')"
                                        :title="__('Delete')"
                                    >
                                        <i class="ti ti-trash mx-2 ti-sm cursor-pointer"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
