<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    nationalities: Object,
    countries: Object,
    cities: Object,
    qualifications: Object,
    subscriber: Object,
});

const form = useForm({
    fname_ar: props.subscriber.fname_ar || '',
    sname_ar: props.subscriber.sname_ar || '',
    tname_ar: props.subscriber.tname_ar || '',
    lname_ar: props.subscriber.lname_ar || '',
    gender: props.subscriber.gender || '',
    country: props.subscriber.country || '',
    city: props.subscriber.city || '',
    nationality: props.subscriber.nationality || '',
    qualification: props.subscriber.qualification || '',
    mobile: props.subscriber.mobile || '',
    mobile_key: props.subscriber.mobile_key || '',
    email: props.subscriber.email || '',
    password: '',
});
</script>

<template>
    <Head :title="__('Edit subscriber')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Subscriber Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Subscriber information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Edit subscriber') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.put(route('admin.subscribers.update', subscriber.id))">
                            <!-- Full name -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="fname">{{ __('First name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="fname" v-model="form.fname_ar" :placeholder="__('First name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.fname_ar">{{ form.errors.fname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="sname">{{ __('Second name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="sname" v-model="form.sname_ar" :placeholder="__('Second name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.sname_ar">{{ form.errors.sname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="tname">{{ __('Third name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="tname" v-model="form.tname_ar" :placeholder="__('Third name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.tname_ar">{{ form.errors.tname_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="lname">{{ __('Last name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lname" v-model="form.lname_ar" :placeholder="__('Last name')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lname_ar">{{ form.errors.lname_ar }}</span>
                                </div>
                            </div>
                            <!-- Full name -->

                            <!-- Gender -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label d-block">{{ __('Gender') }}</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" id="male" name="gender" value="male" v-model="form.gender" />
                                        <label class="form-check-label" for="male">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="female" name="gender" value="female" v-model="form.gender" />
                                        <label class="form-check-label" for="female">{{ __('Female') }}</label>
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.gender">{{ form.errors.gender }}</p>
                                </div>
                            </div>
                            <!-- Gender -->

                            <!-- Country -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="country">{{ __('Country') }}</label>
                                    <select class="form-control m-select2-no" id="country" v-model="form.country">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(key, country) in countries" :key="key" :value="country">{{ country }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.country">{{ form.errors.country }}</p>
                                </div>
                            </div>
                            <!-- Country -->

                            <!-- City -->
                            <div class="row" v-if="form.country == 'المملكة العربية السعودية'">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="city">{{ __('City') }}</label>
                                    <select class="form-control m-select2-no" id="city" v-model="form.city">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(city, k) in cities" :key="k" :value="k">{{ city }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.city">{{ form.errors.city }}</p>
                                </div>
                            </div>
                            <!-- City -->

                            <!-- Nationality -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="nationality">{{ __('Nationality') }}</label>
                                    <select class="form-control m-select2-no" id="nationality" v-model="form.nationality">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(nationality, k) in nationalities" :key="k" :value="k">{{ nationality }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.nationality">{{ form.errors.nationality }}</p>
                                </div>
                            </div>
                            <!-- Nationality -->

                            <!-- Qualification -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="qualification">{{ __('The last academic qualification') }}</label>
                                    <select class="form-control m-select2-no" id="qualification" v-model="form.qualification">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(qualification, k) in qualifications" :key="k" :value="k">{{ qualification }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.qualification">{{ form.errors.qualification }}</p>
                                </div>
                            </div>
                            <!-- Qualification -->

                            <!-- Mobile and key -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-4">
                                    <label class="form-label" for="mobile">{{ __('Mobile') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="mobile" v-model="form.mobile" :placeholder="__('Mobile')" />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.mobile">{{ form.errors.mobile }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-2">
                                    <label class="form-label" for="mobile_key">{{ __('Country key') }}</label>
                                    <select class="form-control m-select2-no" id="mobile_key" v-model="form.mobile_key">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(key, country) in countries" :key="key" :value="key">{{ key }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.mobile_key">{{ form.errors.mobile_key }}</p>
                                </div>
                            </div>
                            <!-- Mobile and key -->

                            <!-- Email -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="email" id="email" v-model="form.email" :placeholder="__('Email')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                                </div>
                            </div>
                            <!-- Email -->

                            <!-- Password -->
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password" v-model="form.password" :placeholder="__('Password')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                                </div>
                            </div>
                            <!-- Password -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.subscribers.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Subscriber information -->
            </div>
            <!--/ Subscriber Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
