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

                <!-- Project table -->
                <div class="card mb-4 p-4">
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project border-top mb-4">
                            <thead>
                                <tr>
                                    <th>{{ __('Experience') }}</th>
                                    <th>{{ __('Years') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(experience, i) in member.exp_flds_lngs?.experiences" :key="i">
                                    <td class="fw-bold">{{ experience?.title }}</td>
                                    <td class="fw-bold" dir="ltr">{{ experience?.years }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table datatable-project border-top mb-4">
                            <thead>
                                <tr>
                                    <th>{{ __('Areas in which you would like to contribute') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(field, i) in member.exp_flds_lngs?.fields" :key="i">
                                    <td class="fw-bold">{{ field?.title }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table datatable-project border-top mb-4">
                            <thead>
                                <tr>
                                    <th>{{ __('The languages you are good at') }}</th>
                                    <th>{{ __('Level') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(field, i) in member.exp_flds_lngs?.languages" :key="i">
                                    <td class="fw-bold">{{ field?.title }}</td>
                                    <td class="fw-bold">{{ field?.level }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Project table -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
