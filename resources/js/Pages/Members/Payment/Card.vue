<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Sidebar from '../Sidebar.vue';

defineProps({
    userAuth: Object,
    memberships: Object,
    locale: String,
});

const form = useForm({
    payment_method: '',
    agreement: false,
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
                        <form @submit.prevent="form.post(route('member.payment-gateway'))">
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

                                    <tr class="total">
                                        <th>
                                            <strong class="text-dark" id="selectpay_text">{{ __('Payment method') }}</strong>
                                        </th>

                                        <td>
                                            <label class="radio-inline text-primary text-5 font-weight-bold mt-4">
                                                <div class="radio-custom radio-success">
                                                    <input type="radio" id="paymada" v-model="form.payment_method" class="selectpayment" value="2" />
                                                    <label for="paymada"> <img src="/img/pay-mada.png" style="width: 70px" /></label>
                                                </div>
                                            </label>

                                            <label class="radio-inline text-primary text-5 font-weight-bold mr-5">
                                                <div class="radio-custom radio-success">
                                                    <input type="radio" id="payvisamaster" v-model="form.payment_method" class="selectpayment" value="1" />
                                                    <label for="payvisamaster">
                                                        <img src="/img/pay-mastercard.png" style="width: 50px" />
                                                        <img src="/img/pay-visa.png" style="width: 50px" />
                                                    </label>
                                                </div>
                                            </label>
                                            <p class="text text-danger text-sm" v-if="form.errors.payment_method">{{ form.errors.payment_method }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr class="my-4" />

                            <h5>{{ __('Terms and conditions:') }}</h5>

                            <ol>
                                <li>{{ __('The amount is not refundable') }}</li>

                                <li>{{ __('The Authority has the right to cancel your subscription') }}</li>

                                <li>{{ __('The subscription period is until the end of the calendar year') }}</li>
                            </ol>

                            <hr class="my-4" />

                            <!-- Amount details -->

                            <h5>{{ __('Amount details:') }}</h5>

                            <ol>
                                <li>{{ __(':amount riyals for :type membership', { amount: memberships[userAuth.subscription.num].price, type: userAuth.subscription?.type }) }}</li>
                                <li v-if="userAuth.delivery_option == 2">{{ __(':amount riyals for the card delivery fee', { amount: memberships['delivery_fees'] }) }}</li>
                            </ol>

                            <div class="custom-control custom-checkbox text-success">
                                <input type="checkbox" id="terms" class="mx-2" v-model="form.agreement" />
                                <label class="text-2 font-weight-bold" for="terms">
                                    {{ __('I agree to all conditions') }}
                                </label>
                                <p class="text text-danger text-sm" v-if="form.errors.agreement">{{ form.errors.agreement }}</p>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Complete the payment process') }}
                                    <i class="fas fa-angle-left ml-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
