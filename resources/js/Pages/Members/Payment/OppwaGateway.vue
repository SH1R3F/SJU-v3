<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Sidebar from '../Sidebar.vue';

defineProps({
    userAuth: Object,
    locale: String,
    memberships: Object,
    payment_method: Number,
    script: String,
});
</script>

<template>
    <Head>
        <title>{{ __('Authority membership') }}</title>
        <component is="script"> var wpwlOptions = { style:"plain", locale: "ar", brandDetection: true, } </component>
        <component is="script" :src="script"></component>
    </Head>
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <div class="page-content account text-start">
                        <table class="cart-totals">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>
                                        <strong class="text-dark">{{ __('Membership type') }}:</strong>
                                    </th>

                                    <td>
                                        <strong class="text-success">
                                            <span class="amount" style="font-size: 20px">{{ userAuth.subscription?.type }}</span>
                                        </strong>
                                    </td>
                                </tr>

                                <tr class="cart-subtotal">
                                    <th>
                                        <strong class="text-dark">{{ __('Start date') }}:</strong>
                                    </th>

                                    <td>
                                        <strong class="text-dark">
                                            {{ new Date().toLocaleDateString(locale == 'ar' ? 'ar-EG' : 'en-GB') }}
                                        </strong>
                                    </td>
                                </tr>

                                <tr class="cart-subtotal">
                                    <th>
                                        <strong class="text-dark">{{ __('End date') }}:</strong>
                                    </th>

                                    <td>
                                        <strong class="text-dark">
                                            {{ new Date(new Date().getFullYear(), 11, 31).toLocaleDateString(locale == 'ar' ? 'ar-EG' : 'en-GB') }}
                                        </strong>
                                    </td>
                                </tr>

                                <tr class="total">
                                    <th>
                                        <strong class="text-dark">{{ __('Amount') }}</strong>
                                    </th>

                                    <td>
                                        <strong class="text-success">
                                            <span class="amount">
                                                {{ memberships[userAuth.subscription.num].price + (userAuth.delivery_option == 2 ? memberships['delivery_fees'] : 0) }}
                                                {{ __('SAR') }}
                                            </span>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="my-4" />
                        <!-- Payment Gateway -->
                        <form :action="route('member.payment-response')" class="paymentWidgets" :data-brands="payment_method == 2 ? 'MADA' : 'VISA MASTER'"></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
