<script setup>
import MembersSidebar from '../Members/Sidebar.vue';
import SubscribersSidebar from '../Subscribers/Sidebar.vue';
import VolunteersSidebar from '../Volunteers/Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    userAuth: Object,
    userHome: String,
});

const form = useForm({
    title: '',
    attachment: '',
    body: '',
});
</script>

<template>
    <Head :title="__('Technical Support')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <MembersSidebar v-if="userHome == '/members'" />
                    <SubscribersSidebar v-else-if="userHome == '/subscribers'" />
                    <VolunteersSidebar v-else-if="userHome == '/volunteers'" />
                </div>

                <div class="col-md-9">
                    <!-- page content -->
                    <div class="page-content account new-ticket text-start">
                        <h5>{{ __('Technical Support') }} - {{ __('New ticket') }}</h5>

                        <form @submit.prevent="form.post(route('support.create'))">
                            <div class="form-group">
                                <label for="title">{{ __('Ticket title') }}</label>
                                <input id="title" type="text" v-model="form.title" class="form-control form-control-lg" />
                                <p class="text text-danger text-sm" v-if="form.errors.title">{{ form.errors.title }}</p>
                            </div>

                            <div class="form-group">
                                <label for="body">{{ __('Details') }}</label>
                                <textarea v-model="form.body" class="form-control form-control-lg" rows="7" :placeholder="__('Details')"></textarea>
                                <p class="text text-danger text-sm" v-if="form.errors.body">{{ form.errors.body }}</p>
                                <label for="attachment" class="text-muted d-block" style="cursor: pointer">
                                    <label for="attachment" class="cursor-pointer" :class="{ 'text-success': form.attachment }">+ {{ __('Attachment') }}</label>
                                    <input type="file" id="attachment" @change="form.attachment = $event.target.files[0]" style="display: none" />
                                </label>
                                <p class="text text-danger text-sm" v-if="form.errors.attachment">{{ form.errors.attachment }}</p>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-success" type="submit">{{ __('Create') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
