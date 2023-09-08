<script setup>
const props = defineProps({
    course: Object,
    answers: Object,
    questions: Object,
});
</script>

<template>
    <Head :title="__('Questionnaire results')" />
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row me-2 py-3 text-center">
            <div class="col-md-8 mb-1 text-xl-start">
                <h3 class="fw-semibold m-0">{{ __('Questionnaire results') }}</h3>
            </div>
            <div class="col-md-4 mb-1">
                <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                    <div class="dt-buttons">
                        <a v-if="true" :href="route('admin.questionnaires.export', course.id)" type="button" class="dt-button add-new btn btn-label-secondary me-1">
                            <span>
                                <i class="ti ti-screen-share me-0 me-sm-1 ti-xs"></i>
                                <span class="d-none d-sm-inline-block">{{ __('Export') }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories cards -->
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <template v-for="(question, i) in questions">
                        <template v-if="question.commentable">
                            <div class="mb-5 mt-1">
                                <h5 class="fw-semibold mb-3">{{ question.question }}</h5>
                                <div class="table-responsive border-top shadow-sm">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Answer') }}</th>
                                                <th>{{ __('Name') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="Object.keys(answers).length" v-for="(answerer, i) in answers[question.id]['answerers']" :key="i">
                                                <td style="max-width: 250px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis">{{ answerer.answer }}</td>
                                                <td>
                                                    <Link
                                                        :href="
                                                            route(
                                                                answerer.type.includes('Member')
                                                                    ? 'admin.members.show'
                                                                    : answerer.type.includes('Subscriber')
                                                                    ? 'admin.subscribers.show'
                                                                    : 'admin.volunteers.show',
                                                                answerer.id
                                                            )
                                                        "
                                                        class="m-0"
                                                        >{{ answerer.name }}</Link
                                                    >
                                                </td>
                                            </tr>
                                            <tr v-else>
                                                <td colspan="2" class="text-nowrap">{{ __('Nobody registered for the questionnaire yet') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-12 col-lg-4 mb-4">
                                <div class="card h-100">
                                    <h5 class="card-header">{{ question.question }}</h5>
                                    <div class="card-body" v-if="Object.keys(answers).length">
                                        <canvas
                                            class="doughnutChart chartjs mb-4"
                                            data-height="350"
                                            :data-results="[answers[question.id]['a'], answers[question.id]['b'], answers[question.id]['c'], answers[question.id]['d']]"
                                        ></canvas>
                                        <ul class="doughnut-legend d-flex justify-content-around px-1 mb-2 pt-1">
                                            <li class="ct-series-0 d-flex flex-column text-center">
                                                <h5 class="mb-0 fw-bold">A+</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill mx-auto" style="background-color: #1daf5a; width: 35px; height: 6px"></span>
                                                <div class="text-muted">{{ answers[question.id]['a'] }}</div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column text-center">
                                                <h5 class="mb-0 fw-bold">A</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill mx-auto" style="background-color: #84d0ff; width: 35px; height: 6px"></span>
                                                <div class="text-muted">{{ answers[question.id]['b'] }}</div>
                                            </li>
                                            <li class="ct-series-2 d-flex flex-column text-center">
                                                <h5 class="mb-0 fw-bold">B</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill mx-auto" style="background-color: #ff8132; width: 35px; height: 6px"></span>
                                                <div class="text-muted">{{ answers[question.id]['c'] }}</div>
                                            </li>
                                            <li class="ct-series-2 d-flex flex-column text-center">
                                                <h5 class="mb-0 fw-bold">C</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill mx-auto" style="background-color: #299aff; width: 35px; height: 6px"></span>
                                                <div class="text-muted">{{ answers[question.id]['d'] }}</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body" v-else>
                                        {{ __('Nobody registered for the questionnaire yet') }}
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
        <!--/ Categories cards -->
    </div>
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(function () {
            const cardColor = '#FFF',
                headingColor = '#000',
                legendColor = '#000',
                borderColor = '#000';

            const doughnutCharts = document.getElementsByClassName('doughnutChart');
            if (doughnutCharts.length) {
                for (let doughnutChart of doughnutCharts) {
                    new Chart(doughnutChart, {
                        type: 'doughnut',
                        data: {
                            labels: ['A+', 'A', 'B', 'C'],
                            datasets: [
                                {
                                    data: $(doughnutChart).data('results').split(','),
                                    backgroundColor: ['#1daf5a', '#84D0FF', '#FF8132', '#299AFF'],
                                    borderWidth: 0,
                                    pointStyle: 'rectRounded',
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 500,
                            },
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    display: false,
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            const label = context.labels || '',
                                                value = context.parsed;
                                            const output = ' ' + label + ' : ' + value;
                                            return output;
                                        },
                                    },
                                    // Updated default tooltip UI
                                    rtl: true,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor,
                                },
                            },
                        },
                    });
                }
            }
        });
    },
};
</script>
