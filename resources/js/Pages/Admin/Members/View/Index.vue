<script setup>
import Pills from './Pills.vue';
import MemberCard from './MemberCard.vue';
import InvoiceCard from './InvoiceCard.vue';
const props = defineProps({
    member: Object,
    nationalities: Object,
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
                                    <td class="fw-bold">{{ __('ID source') }}</td>
                                    <td class="fw-bold">{{ member.national_id_source }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('ID date') }}</td>
                                    <td class="fw-bold">{{ member.national_id_date }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Gender') }}</td>
                                    <td class="fw-bold">{{ member.gender ? __('Female') : __('Male') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Birthday (Hijri)') }}</td>
                                    <td class="fw-bold">{{ member.birthday_h }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Birthday (Miladi)') }}</td>
                                    <td class="fw-bold">{{ member.birthday_m }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Nationality') }}</td>
                                    <td class="fw-bold">{{ __(nationalities[member.nationality]) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('The last academic qualification') }}</td>
                                    <td class="fw-bold">{{ member.qualification }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Specialization') }}</td>
                                    <td class="fw-bold">{{ member.major }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Journalistic profession title') }}</td>
                                    <td class="fw-bold">{{ member.journalistic_profession }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Employer') }}</td>
                                    <td class="fw-bold">{{ member.journalistic_employer }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Newspaper type') }}</td>
                                    <td class="fw-bold">{{ member.newspaper_type == 2 ? __('Electronic newspaper') : __('Paper newspaper') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Non-Journalistic profession title') }}</td>
                                    <td class="fw-bold">{{ member.non_journalistic_profession }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Employer') }}</td>
                                    <td class="fw-bold">{{ member.non_journalistic_employer }}</td>
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
