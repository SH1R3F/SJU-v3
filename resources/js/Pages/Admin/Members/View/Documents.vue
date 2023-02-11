<script setup>
import Pills from './Pills.vue';
import MemberCard from './MemberCard.vue';
import InvoiceCard from './InvoiceCard.vue';
const props = defineProps({
    member: Object,
});
</script>

<template>
    <Head :title="__('Member file')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- Member Card -->
                <member-card :member="member" />
                <!-- /Member Card -->
                <!-- Invoice Card -->
                <invoice-card :member="member" />
                <!-- /Invoice Card -->
            </div>
            <!--/ Member Sidebar -->

            <!-- Member Content -->
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Member Pills -->
                <Pills :member="member" />
                <!--/ Member Pills -->

                <!-- Profile picture -->
                <div class="card mb-3 py-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Profile picture') }}</h5>
                                <p class="card-text">
                                    <a :href="member.profile_photo" target="_blank" class="fw-bold btn btn-sm btn-default">{{ __('Show') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img class="card-img card-img-right" src="/img/user-dark.png" style="max-width: 200px" />
                        </div>
                    </div>
                </div>
                <!-- /Profile picture -->
                <!-- ID photo -->
                <div class="card mb-3 py-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('ID photo') }}</h5>
                                <p class="card-text">
                                    <a :href="member.national_id_photo" target="_blank" class="fw-bold btn btn-sm btn-default">{{ __('Show') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img class="card-img card-img-right" src="/img/card.png" style="max-width: 200px" />
                        </div>
                    </div>
                </div>
                <!-- /ID photo -->
                <!-- Statement photo -->
                <div class="card mb-3 py-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Employment statement') }}</h5>
                                <p class="card-text">
                                    <a :href="member.statement_photo" target="_blank" class="fw-bold btn btn-sm btn-default">{{ __('Show') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img class="card-img card-img-right" src="/img/letter.png" style="max-width: 200px" />
                        </div>
                    </div>
                </div>
                <!-- /Statement photo -->
                <!-- License photo -->
                <div class="card mb-3 py-3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Newspaper license') }}</h5>
                                <p class="card-text">
                                    <a :href="member.license_photo" target="_blank" class="fw-bold btn btn-sm btn-default">{{ __('Show') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img class="card-img card-img-right" src="/img/letter.png" style="max-width: 200px" />
                        </div>
                    </div>
                </div>
                <!-- /License photo -->
                <!-- Contract photo -->
                <div class="card mb-3 py-3" v-if="member.subscription?.num == 3">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Job contract') }}</h5>
                                <p class="card-text">
                                    <a :href="member.contract_photo" target="_blank" class="fw-bold btn btn-sm btn-default">{{ __('Show') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img class="card-img card-img-right" src="/img/letter.png" style="max-width: 200px" />
                        </div>
                    </div>
                </div>
                <!-- /Contract photo -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
