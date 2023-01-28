<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    questionnaire: Object,
    question: Object,
    locale: String,
});

const form = useForm({
    answer: undefined,
    choice: undefined,
});
</script>

<template>
    <Head :title="__('Evaluate course')" />
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-md-1"></div>
            <div class="page-content account text-start col-md-9">
                <h5>{{ __('Fill questionnaire') }}</h5>

                <form
                    @submit.prevent="
                        form.post(route('courses.question', question.id), {
                            onSuccess: () => form.reset(),
                        })
                    "
                >
                    <div class="form-body my-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-radios">
                                    <h3>{{ question.question }}</h3>

                                    <div class="my-4">
                                        <!-- COMMENTABLE -->
                                        <template v-if="question.commentable">
                                            <textarea rows="5" class="form-control" v-model="form.answer"></textarea>
                                            <p class="text text-danger text-sm" v-if="form.errors.answer">{{ form.errors.answer }}</p>
                                        </template>

                                        <!-- MCQ -->
                                        <template v-else>
                                            <div class="radio" style="margin: 15px">
                                                <label class="evalu_choose">
                                                    <input type="radio" id="radio1" name="answer" value="1" v-model="form.choice" class="md-radiobtn" />
                                                    {{ question.answer1 }}
                                                </label>
                                            </div>

                                            <div class="radio" style="margin: 15px">
                                                <label class="evalu_choose">
                                                    <input type="radio" id="radio2" name="answer" value="2" v-model="form.choice" class="md-radiobtn" />
                                                    {{ question.answer2 }}
                                                </label>
                                            </div>

                                            <div class="radio" style="margin: 15px">
                                                <label class="evalu_choose">
                                                    <input type="radio" id="radio3" name="answer" value="3" v-model="form.choice" class="md-radiobtn" />
                                                    {{ question.answer3 }}
                                                </label>
                                            </div>

                                            <div class="radio" style="margin: 15px">
                                                <label class="evalu_choose">
                                                    <input type="radio" id="radio5" name="answer" value="4" v-model="form.choice" class="md-radiobtn" />
                                                    {{ question.answer4 }}
                                                </label>
                                            </div>

                                            <p class="text text-danger text-sm" v-if="form.errors.choice">{{ form.errors.choice }}</p>
                                        </template>
                                    </div>
                                </div>

                                <div class="form-actions text-end">
                                    <button type="submit" class="btn btn-success">{{ __('Next') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() {},
};
</script>
