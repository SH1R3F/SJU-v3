<script setup>
import Sidebar from './Sidebar.vue';

defineProps({
    userAuth: Object,
});
</script>

<template>
    <Head :title="__('Authority membership')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <div class="page-content account text-start">
                        <!-- Subscription table -->

                        <h5>{{ __('Authority membership') }}</h5>
                        <table class="table mycustom-table1">
                            <thead>
                                <tr>
                                    <th>{{ __('Membership type') }}</th>
                                    <th>{{ __('Start date') }}</th>
                                    <th>{{ __('End date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ userAuth.subscription.type }}</td>
                                    <td>{{ userAuth.subscription.start_date }}</td>
                                    <td>{{ userAuth.subscription.end_date }}</td>
                                    <td>{{ userAuth.subscription.status }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Subscriptions table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
