<script setup>
import MembersSidebar from '../Members/Sidebar.vue';
import SubscribersSidebar from '../Subscribers/Sidebar.vue';
import VolunteersSidebar from '../Volunteers/Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    userAuth: Object,
    userHome: String,
    ticket: Object,
});

const form = useForm({
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
                    <div class="page-content account ticket text-start">
                        <h5>{{ ticket.title }}</h5>

                        <!-- Support Chat -->
                        <div class="chat" id="chat">
                            <div class="bubble" v-for="message in ticket.messages" :class="{ support: message.sender, me: !message.sender }">
                                {{ message.body }}
                                <a v-if="message.attachment" :href="message.attachment" target="_blank">
                                    <img :src="message.attachment" class="img-thumbnail" />
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <template v-if="!ticket.status">
                            <hr class="border-0" />
                            <form
                                @submit.prevent="
                                    form.post(route('support.message', ticket.id), {
                                        onSuccess: () => {
                                            form.reset();
                                        },
                                    })
                                "
                            >
                                <textarea class="form-control" v-model="form.body" :placeholder="__('Type your message here')" required></textarea>
                                <p class="text text-danger text-sm" v-if="form.errors.body">{{ form.errors.body }}</p>

                                <label for="attachment" class="text-muted d-block" style="cursor: pointer">
                                    <span for="attachment" :class="{ 'text-success': form.attachment }">+ {{ __('Attachment') }}</span>
                                    <input type="file" id="attachment" @change="form.attachment = $event.target.files[0]" style="display: none" />
                                </label>

                                <p class="text text-danger text-sm" v-if="form.errors.attachment">{{ form.errors.attachment }}</p>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>

                                <div class="text-end mt-2">
                                    <input type="submit" class="btn btn-success btn-sm" :value="__('Send')" />
                                </div>
                            </form>
                        </template>

                        <!-- Support Chat -->
                    </div>
                    <!-- ticket -->

                    <p class="text-muted text-start">
                        {{ ticket.status ? __("Problem didn't solve?") : __('Problem solved?') }}
                        <Link :href="route('support.toggle', ticket.id)" method="post" as="span" class="text-success" style="cursor: pointer">
                            {{ ticket.status ? __('Open ticket') : __('Close ticket') }}
                        </Link>
                    </p>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(() => {
            setTimeout(() => {
                $('#chat').animate(
                    {
                        scrollTop: $('#chat')[0].scrollHeight,
                    },
                    500
                );
            }, 300);
        });
    },
};
</script>
