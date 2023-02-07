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
                                    <td>{{ userAuth.subscription?.type }}</td>
                                    <td>{{ userAuth.subscription.start_date }}</td>
                                    <td>{{ userAuth.subscription.end_date }}</td>
                                    <td>
                                        <template v-if="userAuth.status == -2">
                                            <span class="text-link" @click="toastAlert(userAuth.refusal_reason)">{{ userAuth.membership_status }}</span>
                                            <Link :href="route('member.subscription.resend')" method="post" as="button" class="btn btn-sm btn-success mx-1">{{ __('Resend') }}</Link>
                                        </template>
                                        <template v-else>
                                            {{ userAuth.membership_status }}
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Subscriptions table -->

                        <!-- Payment-alert button -->
                        <section class="call-to-action call-to-action-primary m-0 row alert alert-success" v-if="userAuth.status == 2 && userAuth.can_pay">
                            <div class="col-sm-9 col-lg-9 text-start">
                                <div class="call-to-action-content">
                                    <h3>
                                        <strong>{{ __('Complete the payment process') }}</strong>
                                    </h3>
                                    <p class="mb-0 opacity-7">
                                        <strong class="font-weight-extra-bold">{{ userAuth.subscription?.type }}</strong>
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-3 text-end pt-3">
                                <div class="call-to-action-btn">
                                    <Link :href="route('member.payment-card')" class="btn btn-modern text-2 btn-light border-0">
                                        <i class="fa fa-credit-card"></i>
                                        {{ __('Pay') }}
                                    </Link>
                                </div>
                            </div>
                        </section>
                        <!-- Payment-alert button -->

                        <!-- Membership Card -->
                        <template v-if="userAuth.status == 2 && !userAuth.can_pay">
                            <hr class="my-5 border-0" />
                            <h5>{{ __('Membership card') }}</h5>
                            <div class="row m-4">
                                <div class="membership-cart">
                                    <div style="position: relative">
                                        <div class="cart-header">
                                            <p class="m-0" style="font-weight: bolder; color: #fff; font-size: 1.8em; font-family: 'Markazi Text', serif">هيئــة الصحفيين السعوديـين</p>
                                            <p class="m-0" style="color: #fff; font-size: 1em; font-family: 'Cairo', sans-serif">SAUDI JOURNALISTS ASSOCIATION</p>
                                        </div>

                                        <div class="cart-header-logo">
                                            <img style="height: 100px" src="/img/logo.png" />
                                        </div>

                                        <div class="membership-id">
                                            <p class="m-0" style="font-size: 1em; font-weight: bolder; color: #fff">بطاقة عضوية &nbsp;&nbsp;&nbsp;&nbsp; Membership ID</p>
                                        </div>

                                        <div class="membership-body">
                                            <img
                                                style="height: 205px; border: 1px solid #d9d8d8; width: 200px; object-fit: cover; object-position: top; border-radius: 3px; margin-bottom: 5px"
                                                :src="userAuth.profile_photo"
                                            />
                                            <p class="m-1" style="font-size: 1.25em; font-weight: bolder; color: #000">{{ userAuth.fullNameAr }}</p>
                                            <p class="m-1" style="font-family: acumin-pro, sans-serif; font-weight: 600; color: #000; text-transform: capitalize; font-size: 18px">
                                                {{ userAuth.fullNameEn }}
                                            </p>
                                            <p class="m-1 membership-number" style="font-size: 1em; font-weight: bolder; color: #000; direction: ltr; margin: 21px 0 !important">
                                                ID Number &nbsp;&nbsp; {{ userAuth.membership_number }} &nbsp;&nbsp; رقم العضوية
                                            </p>
                                            <p
                                                class="m-0"
                                                style="font-weight: bolder; color: #000; background: #95c049; display: block; width: 100%; direction: ltr; color: #fff; font-size: 1em; padding: 3px 0"
                                            >
                                                Expiry data &nbsp;&nbsp;&nbsp;&nbsp; {{ new Date(new Date().getFullYear(), 11, 31).toLocaleDateString('en-GB') }} &nbsp;&nbsp;&nbsp;&nbsp; صلاحية
                                                البطاقة
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Membership Card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
