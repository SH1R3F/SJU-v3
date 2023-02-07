<script setup>
const props = defineProps({
    invoice: Object,
    types: Object,
});
</script>

<template>
    <Head :title="__('View invoice')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                    <span class="app-brand-logo demo">
                                        <img src="/img/logo.png" style="height: 100%" />
                                    </span>

                                    <span class="app-brand-text fw-bold fs-4"> {{ __('Saudi journalists association') }} </span>
                                </div>
                                <p class="mb-2">info@sju.org.sa</p>
                                <p class="mb-0">0114878555 – 0114878855</p>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-2">{{ __('INVOICE') }} #{{ invoice.invoice_number }}</h4>
                                <div class="mb-2 pt-1">
                                    <span>{{ __('Date') }}:</span>
                                    <span class="fw-semibold">{{ invoice.created_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <h6 class="mb-3">{{ __('Invoice To') }}:</h6>
                                <p class="mb-1">{{ invoice.member.fullName }}</p>
                                <p class="mb-1">{{ invoice.member.national_id }}</p>
                                <p class="mb-1">{{ invoice.member.membership_number }}</p>
                                <p class="mb-1">{{ invoice.member.mobile }}</p>
                                <p class="mb-0">{{ invoice.member.email }}</p>
                                <p class="mb-1">{{ __('Branch') }}: ({{ invoice.member.branch.name }})</p>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                <h6 class="mb-4">{{ __('Payment') }}:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-4">{{ __('Amount') }}:</td>
                                            <td>
                                                <strong>{{ invoice.amount }} {{ __('SAR') }}</strong>
                                            </td>
                                        </tr>
                                        <!--
                                        TO BE ADDED WHEN DYNAMICALLY STORE PAYMENT DATA    
                                        <tr>
                                            <td class="pe-4">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive border-top">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Item') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap">{{ invoice.subscription?.type }}</td>
                                    <td>{{ types[invoice.subscription.num].price }} {{ __('SAR') }}</td>
                                </tr>
                                <tr v-if="invoice.member.delivery_option == 2">
                                    <td class="text-nowrap">{{ __('Delivery fees') }}</td>
                                    <td>{{ types['delivery_fees'] }} {{ __('SAR') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-bold">{{ __('Total') }}</td>
                                    <td class="fw-bold">{{ types[invoice.subscription.num].price + (invoice.member.delivery_option == 2 ? types['delivery_fees'] : 0) }} {{ __('SAR') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->
        </div>
        <!-- /Offcanvas -->
    </div>
    <!-- / Content -->
</template>
