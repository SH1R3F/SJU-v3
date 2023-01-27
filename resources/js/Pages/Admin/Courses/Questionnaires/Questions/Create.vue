<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    id: Number,
});

const form = useForm({
    question: '',
    commentable: false,
    answer1: '',
    color1: '#000000',
    answer2: '',
    color2: '#000000',
    answer3: '',
    color3: '#000000',
    answer4: '',
    color4: '#000000',
    order: '',
    status: 1,
});
</script>

<template>
    <Head :title="__('Create question')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 order-0 order-md-1">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create question') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.questions.store', id))">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="question">{{ __('Question') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="question" :placeholder="__('Question')" v-model="form.question" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.question">{{ form.errors.question }}</p>
                                </div>
                            </div>
                            <!-- Name -->

                            <!-- Commentable -->
                            <div class="row">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" v-model="form.commentable" type="checkbox" id="commentable" />
                                    <label class="form-check-label" for="commentable"> {{ __('Commentable') }} </label>
                                </div>
                                <p class="fs-6 text-danger" v-if="form.errors.commentable">{{ form.errors.commentable }}</p>
                            </div>
                            <!-- Commentable -->

                            <template v-if="!form.commentable">
                                <!-- Answer & Color 1 -->
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="answer1">{{ `${__('Answer')} (1)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="answer1" :placeholder="__('Answer')" v-model="form.answer1" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.answer1">{{ form.errors.answer1 }}</p>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="color1">{{ `${__('Color')} (1)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" style="height: 38px" type="color" id="color1" :placeholder="__('Color')" v-model="form.color1" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.color1">{{ form.errors.color1 }}</p>
                                    </div>
                                </div>
                                <!-- Answer & Color 1 -->

                                <!-- Answer & Color 2 -->
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="answer2">{{ `${__('Answer')} (2)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="answer2" :placeholder="__('Answer')" v-model="form.answer2" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.answer2">{{ form.errors.answer2 }}</p>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="color2">{{ `${__('Color')} (2)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" style="height: 38px" type="color" id="color2" :placeholder="__('Color')" v-model="form.color2" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.color2">{{ form.errors.color2 }}</p>
                                    </div>
                                </div>
                                <!-- Answer & Color 1 -->

                                <!-- Answer & Color 3 -->
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="answer3">{{ `${__('Answer')} (3)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="answer3" :placeholder="__('Answer')" v-model="form.answer3" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.answer3">{{ form.errors.answer3 }}</p>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="color3">{{ `${__('Color')} (3)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" style="height: 38px" type="color" id="color3" :placeholder="__('Color')" v-model="form.color3" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.color3">{{ form.errors.color3 }}</p>
                                    </div>
                                </div>
                                <!-- Answer & Color 3 -->

                                <!-- Answer & Color 4 -->
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="answer4">{{ `${__('Answer')} (4)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="answer4" :placeholder="__('Answer')" v-model="form.answer4" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.answer4">{{ form.errors.answer4 }}</p>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="color4">{{ `${__('Color')} (4)` }}</label>
                                        <div class="input-group">
                                            <input class="form-control" style="height: 38px" type="color" id="color4" :placeholder="__('Color')" v-model="form.color4" />
                                        </div>
                                        <p class="fs-6 text-danger" v-if="form.errors.color4">{{ form.errors.color4 }}</p>
                                    </div>
                                </div>
                                <!-- Answer & Color 4 -->
                            </template>

                            <!-- Order -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="order">{{ __('Order') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="order" :placeholder="__('Order')" v-model="form.order" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.order">{{ form.errors.order }}</p>
                                </div>
                            </div>
                            <!-- Order -->

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
                                    <p class="fs-6 text-danger" v-if="form.errors.status">{{ form.errors.status }}</p>
                                </div>
                            </div>
                            <!-- Status -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.questionnaires.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
