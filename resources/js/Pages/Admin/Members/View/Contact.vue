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
                        <table class="table datatable-project border-top">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">{{ __('Mobile') }}</td>
                                    <td class="fw-bold" dir="ltr">{{ member.phone_number }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Work phone') }}</td>
                                    <td class="fw-bold">{{ member.workphone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Ext') }}</td>
                                    <td class="fw-bold">{{ member.workphone_ext }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Fax') }}</td>
                                    <td class="fw-bold">{{ member.fax }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Ext') }}</td>
                                    <td class="fw-bold">{{ member.fax_ext }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ `${__('Post address')}: ${__('P.B')}` }}</td>
                                    <td class="fw-bold">{{ member.postbox }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ `${__('Post address')}: ${__('Post code')}` }}</td>
                                    <td class="fw-bold">{{ member.postcode }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ `${__('Post address')}: ${__('Post city')}` }}</td>
                                    <td class="fw-bold">{{ member.postcity }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email') }}</td>
                                    <td class="fw-bold">{{ member.email }}</td>
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
