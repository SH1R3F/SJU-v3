<script setup>
import Sidebar from '../Sidebar.vue';

defineProps({
    userAuth: Object,
});
</script>

<template>
    <Head :title="__('Elections')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <div class="page-content account text-start">
                        <h5>{{ __('Elections for the Saudi Journalists Association') }}</h5>

                        <!-- Elections alert -->
                        <section class="call-to-action call-to-action-primary m-0 row alert alert-success">
                            <div class="col-sm-9 col-lg-9 text-start">
                                <div class="call-to-action-content">
                                    <p class="mb-0 opacity-7">
                                        <strong class="font-weight-extra-bold">{{ __("You have successfully participated in the elections") }}</strong>
                                    </p>
                                </div>
                            </div>
                        </section>
                        <!-- Elections alert -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
