<script setup>
import MembersSidebar from '../Members/Sidebar.vue';
import SubscribersSidebar from '../Subscribers/Sidebar.vue';
import VolunteersSidebar from '../Volunteers/Sidebar.vue';

const props = defineProps({
    userAuth: Object,
    userHome: String,
    tickets: Object,
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
                    <div class="page-content account tickets text-start">
                        <h5>{{ __('Technical Support') }}</h5>

                        <table class="table table-hover mycustom-table1">
                            <thead>
                                <tr>
                                    <th>{{ __('Ticket title') }}</th>
                                    <th>{{ __('Last update') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="ticket in tickets.data" :key="ticket.id">
                                    <td>
                                        <Link :href="route('support.show', ticket.id)" class="title">{{ ticket.title }}</Link>
                                    </td>
                                    <td>{{ ticket.updated_at }}</td>
                                    <td>{{ ticket.status ? __('Closed') : __('Open') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-end">
                            <Link :href="route('support.create')">
                                <button class="btn btn-success btn-sm">+ {{ __('New ticket') }}</button>
                            </Link>
                        </div>
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
