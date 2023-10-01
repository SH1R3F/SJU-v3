<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    ticket: Object,
});

let msgGroups = [];
let group = [];
props.ticket.messages.forEach((msg, i) => {
    if (msg.sender == group[0]?.sender) {
        group.push(msg);
    } else {
        msgGroups.push(group);
        group = [msg];
    }
    if (i + 1 == props.ticket.messages.length) msgGroups.push(group);
});
msgGroups = msgGroups.filter((group) => group.length);

const form = useForm({
    body: '',
    attachment: '',
});
</script>

<script defer>
export default {
    mounted() {
        $(document).ready(() => {
            setTimeout(() => {
                $('#chatParent').animate(
                    {
                        scrollTop: $('#chatParent')[0].scrollHeight,
                    },
                    500
                );
            }, 300);
        });
    },
};
</script>

<template>
    <Head>
        <title>{{ __('Technical support') }}</title>
        <link rel="stylesheet" href="/assets/vendor/css/pages/app-chat.css" />
    </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-chat card overflow-hidden">
            <div class="row g-0">
                <!-- Chat History -->
                <div class="col app-chat-history bg-body">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <div class="flex-shrink-0 avatar">
                                        <img
                                            :src="ticket.supportable.profile_photo || '/img/user-dark.png'"
                                            onerror="this.src = '/img/user-dark.png';"
                                            alt="Avatar"
                                            class="rounded-circle"
                                            data-bs-toggle="sidebar"
                                            data-overlay
                                            data-target="#app-chat-sidebar-right"
                                        />
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-2">
                                        <Link :href="ticket.supportable_type.includes('Admin') ? '#' :
                                                route(
                                                    ticket.supportable_type.includes('Member')
                                                        ? 'admin.members.show'
                                                        : ticket.supportable_type.includes('Subscriber')
                                                            ? 'admin.subscribers.show'
                                                            : 'admin.volunteers.show',
                                                    ticket.supportable.id
                                                )
                                            " class="m-0">{{ ticket.supportable.fullName }}</Link>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <Link
                                        as="i"
                                        :href="route('admin.tickets.toggle', ticket.id)"
                                        method="post"
                                        data-bs-placement="top"
                                        :aria-label="ticket.status ? __('Open ticket') : __('Close ticket')"
                                        :title="ticket.status ? __('Open ticket') : __('Close ticket')"
                                        class="ti cursor-pointer d-sm-block me-3"
                                        :class="{ 'ti-toggle-left': ticket.status, 'ti-toggle-right': !ticket.status }"
                                    ></Link>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history-body bg-body" id="chatParent" style="overflow-y: auto">
                            <ul class="list-unstyled chat-history">
                                <li class="chat-message" v-for="msgGroup in msgGroups" :class="{ 'chat-message-right': msgGroup[0].sender }">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3" v-if="!msgGroup[0].sender">
                                            <div class="avatar avatar-sm">
                                                <img src="/img/user-dark.png" alt="Avatar" class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div v-for="msg in msgGroup" :key="msg.id" class="d-flex" :class="{ 'justify-content-end': msg.sender }">
                                                <div class="chat-message-text mb-1 d-inline-block">
                                                    <p class="mb-0 d-inline">
                                                        {{ msg.body }}

                                                        <a v-if="msg.attachment" :href="msg.attachment" target="_block">
                                                            <img :src="msg.attachment" class="d-block mt-2" style="max-width: 300px" />
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-muted mt-1" :class="{ 'text-end': msgGroup[msgGroup.length - 1].sender }">
                                                <small>{{ msgGroup[msgGroup.length - 1].created_at }}</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 me-3" v-if="msgGroup[0].sender">
                                            <div class="avatar avatar-sm">
                                                <img src="/img/admin.png" alt="Avatar" class="rounded-circle" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Chat message form -->
                        <div class="chat-history-footer shadow-sm">
                            <form class="form-send-message d-flex justify-content-between align-items-center" @submit.prevent="form.post(route('admin.tickets.message', ticket.id))">
                                <input class="form-control message-input border-0 me-3 shadow-none" :placeholder="__('Type your message here')" v-model="form.body" />
                                <div class="message-actions d-flex align-items-center">
                                    <label for="attach-doc" class="form-label mb-0" :class="{ 'text-success': form.attachment }">
                                        <i class="ti ti-photo ti-sm cursor-pointer mx-3"></i>
                                        <input type="file" id="attach-doc" hidden @change="form.attachment = $event.target.files[0]" />
                                    </label>
                                    <button class="btn btn-primary d-flex send-msg-btn" type="submit">
                                        <i class="ti ti-send me-md-1 me-0"></i>
                                        <span class="align-middle d-md-inline-block d-none">{{ __('Send') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p class="text text-danger fs-sm" v-if="form.errors.body">{{ form.errors.body }}</p>
                        <p class="text text-danger fs-sm" v-if="form.errors.attachment">{{ form.errors.attachment }}</p>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                    </div>
                </div>
                <!-- /Chat History -->
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
