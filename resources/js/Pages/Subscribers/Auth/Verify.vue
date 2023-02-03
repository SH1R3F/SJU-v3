<script setup>
import Sidebar from '../Sidebar.vue';
</script>

<template>
    <Head :title="__('Email activation')" />
    <div class="users">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <div class="page-content account text-start">
                        <h5>{{ __('Email activation') }}</h5>

                        <div class="text-end mt-3">
                            <p class="text-start">{{ __("Didn't receive the activation code? Look in the junk mailbox or you can request activation again") }}</p>
                            <Link :href="route('subscriber.verification.send')" method="POST" as="button" class="btn btn-success">
                                <i class="fas fa-check"></i>
                                {{ __('Resend activation mail') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
