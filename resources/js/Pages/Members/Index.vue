<script setup>
import Sidebar from './Sidebar.vue';

const props = defineProps({
    notifications: Object,
    old_notifications: Object,
});
</script>

<template>
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <div class="page-content account text-start">
                        <table class="table mycustom-table1">
                            <thead>
                                <tr>
                                    <th>{{ __('Request type') }}</th>
                                    <th>{{ __('Request date') }}</th>
                                    <th>{{ __('Request status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Notifications loop -->
                                <tr v-for="notification in notifications">
                                    <td>{{ notification.data['message'] }}</td>
                                    <td>{{ arabic_date(notification.created_at) }}</td>
                                    <td v-if="notification.data['status']">{{ notification.data['status'] }}</td>
                                    <td v-else>
                                        <Link :href="route('read-notification', notification.id)" method="POST" as="button" class="btn btn-success btn-sm">{{ __('Mark as read') }}</Link>
                                    </td>
                                </tr>
                                <!-- Old Notifications -->
                                <tr v-for="notification in old_notifications">
                                    <td>{{ notification.title }}</td>
                                    <td>{{ arabic_date(notification.created_at) }}</td>
                                    <td>
                                        {{ notification.status }}
                                        <Link :href="route('read-old-notification', notification.id)" method="POST" as="button" class="btn btn-success btn-sm">{{ __('Mark as read') }}</Link>
                                    </td>
                                </tr>
                                <tr v-if="notifications.length + old_notifications.length == 0">
                                    <td colspan="3">{{ __("You don't have any unseen notifications") }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
