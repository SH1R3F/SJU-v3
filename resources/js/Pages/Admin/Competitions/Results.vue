<script setup>
import { computed } from 'vue';

const props = defineProps({
    submission: Object,
});

const linedText = computed(() => {
    return (html) => {
        return html.replace(/<(?!\/?br( |>))/g, "&lt;").replace(/(?<=&lt;[^>]+)>/g, "&gt;")
    }
});

</script>

<template>
    <Head :title="__('Competition results')" />
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row me-2 py-3 text-center">
            <div class="col-md-8 mb-1 text-xl-start">
                <h3 class="fw-semibold m-0">{{ __('Competition results') }}</h3>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="mb-5 mt-1">
                        <h5 class="fw-semibold mb-3">{{props.submission.userable ? props.submission.userable.fullName : __('Guest')}}</h5>
                        <div class="table-responsive border-top shadow-sm">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">{{ __('Question') }}</th>
                                        <th class="cell-fit">{{ __('Answer') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="answer in props.submission.answers" :key="answer.id">
                                        <td class="text-nowrap">{{ answer.competition_field.title }}</td>
                                        <td class="text-nowrap" v-if="answer.competition_field.type === 'text'" v-html="linedText(answer.answer_text)"></td>
                                        <td class="text-nowrap" v-if="answer.competition_field.type === 'date'">{{ answer.answer_date }}</td>
                                        <td class="text-nowrap" v-if="answer.competition_field.type === 'file'">
                                            <a :href="answer.answer_file" target="_blank">{{__('View')}}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</template>
