<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    types: Object,
    genders: Object,
    categories: Object,
    branches: Object,
    templates: Object,
    questionnaires: Object,
});

const form = useForm({
    title_ar: '',
    title_en: '',
    region: '',
    course_type_id: '',
    course_category_id: '',
    course_gender_id: '',
    course_branch_id: '',
    map_link: '',
    lng: 27.0001404,
    lat: 49.6574203,
    seats: 1,
    date_from: '',
    date_to: '',
    time_from: '',
    time_to: '',
    days: {},
    minutes: '',
    percentage: '',
    cost: 0,
    price: '',
    currency: '',
    payment_method: '',
    images: [],
    trainer: '',
    summary: '',
    content: '',
    zoom: '',
    youtube: '',
    template_id: '',
    questionnaire_id: 24,
    attendance_mins: '',
});

const handleImages = ($event) => {
    let files = $event.target.files;
    files.forEach((file) => {
        const reader = new FileReader();
        let rawImg;
        reader.onloadend = () => {
            rawImg = reader.result;
            form.images.push(rawImg);
        };
        reader.readAsDataURL(file);
    });
};
</script>

<template>
    <Head :title="__('Create course')"> </Head>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create course') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.courses.store'))">
                            <!-- Course title -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_ar">{{ __('Course title') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_ar" v-model="form.title_ar" :placeholder="__('Course title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_ar">{{ form.errors.title_ar }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="title_en">{{ __('Course title') }} ({{ __('In English') }})</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="title_en" v-model="form.title_en" :placeholder="__('Course title')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.title_en">{{ form.errors.title_en }}</span>
                                </div>
                            </div>
                            <!-- Course title -->

                            <!-- Region -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="region">{{ __('Region') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="region" v-model="form.region" :placeholder="__('Region')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.region">{{ form.errors.region }}</span>
                                </div>
                            </div>
                            <!-- Region -->

                            <!-- Type & Category -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="type_id">{{ __('Type') }}</label>
                                    <select class="form-control m-select2-no" id="type_id" v-model="form.course_type_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(type, k) in types" :key="k" :value="type.id">{{ __(type.name) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.course_type_id">{{ form.errors.course_type_id }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="category_id">{{ __('Category') }}</label>
                                    <select class="form-control m-select2-no" id="category_id" v-model="form.course_category_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(category, k) in categories" :key="k" :value="category.id">{{ __(category.name) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.course_category_id">{{ form.errors.course_category_id }}</p>
                                </div>
                            </div>
                            <!-- Type & Category -->

                            <!-- Gender & Branch -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="gender_id">{{ __('Gender') }}</label>
                                    <select class="form-control m-select2-no" id="gender_id" v-model="form.course_gender_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(gender, k) in genders" :key="k" :value="gender.id">{{ __(gender.name) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.course_gender_id">{{ form.errors.course_gender_id }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="branch_id">{{ __('Branch') }}</label>
                                    <select class="form-control m-select2-no" id="branch_id" v-model="form.course_branch_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(branch, k) in branches" :key="k" :value="branch.id">{{ __(branch.name) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.course_branch_id">{{ form.errors.course_branch_id }}</p>
                                </div>
                            </div>
                            <!-- Gender & Branch -->

                            <!-- Map link -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="map_link">{{ __('Map link') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="url" id="map_link" v-model="form.map_link" :placeholder="__('Map link')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.map_link">{{ form.errors.map_link }}</span>
                                </div>
                            </div>
                            <!-- Map link -->

                            <!-- Map -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="map_link">{{ __('Map') }}</label>
                                    <div id="us3" style="width: 100%; height: 400px"></div>
                                </div>
                            </div>
                            <!-- Map -->

                            <!-- Longitude & latitude -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="lng">{{ __('Longitude') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lng" v-model="form.lng" :placeholder="__('Longitude')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lng">{{ form.errors.lng }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="lat">{{ __('Latitude') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="lat" v-model="form.lat" :placeholder="__('Latitude')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.lat">{{ form.errors.lat }}</span>
                                </div>
                            </div>
                            <!-- Longitude & latitude -->

                            <!-- Passing percentage -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="percentage">{{ __('Passing percentage') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="percentage" v-model="form.percentage">
                                            <option value="">{{ __('Unspecified') }}</option>
                                            <option v-for="x in 100" :key="x" :value="x">{{ x }}%</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.percentage">{{ form.errors.percentage }}</span>
                                </div>
                            </div>
                            <!-- Passing percentage -->

                            <!-- Date from & to -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="date_from">{{ __('Date from') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="date" id="date_from" v-model="form.date_from" :placeholder="__('Date from')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.date_from">{{ form.errors.date_from }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="date_to">{{ __('Date to') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="date" id="date_to" v-model="form.date_to" :placeholder="__('Date to')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.date_to">{{ form.errors.date_to }}</span>
                                </div>
                            </div>
                            <!-- Date from & to -->

                            <!-- Time from & to -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="time_from">{{ __('Time from') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="time" id="time_from" v-model="form.time_from" :placeholder="__('Time from')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.time_from">{{ form.errors.time_from }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="time_to">{{ __('Time to') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="time" id="time_to" v-model="form.time_to" :placeholder="__('Time to')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.time_to">{{ form.errors.time_to }}</span>
                                </div>
                            </div>
                            <!-- Time from & to -->

                            <!-- Days -->
                            <div class="row">
                                <div class="mb-3 col-6 col-sm-3">
                                    <label class="form-label" for="time_from">{{ __('Days') }}</label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Sat" type="checkbox" value="Sat" id="saturday" />
                                        <label class="form-check-label" for="saturday"> {{ __('Saturday') }} </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Sun" type="checkbox" value="Sun" id="sunday" />
                                        <label class="form-check-label" for="sunday"> {{ __('Sunday') }} </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Mon" type="checkbox" value="Mon" id="Monday" />
                                        <label class="form-check-label" for="Monday"> {{ __('Monday') }} </label>
                                    </div>
                                </div>
                                <div class="mb-3 col-6 col-sm-3">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Tue" type="checkbox" value="Tue" id="Tuesday" />
                                        <label class="form-check-label" for="Tuesday"> {{ __('Tuesday') }} </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Wed" type="checkbox" value="Wed" id="Wednesday" />
                                        <label class="form-check-label" for="Wednesday"> {{ __('Wednesday') }} </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Thu" type="checkbox" value="Thu" id="Thursday" />
                                        <label class="form-check-label" for="Thursday"> {{ __('Thursday') }} </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" v-model="form.days.Fri" type="checkbox" value="Fri" id="Friday" />
                                        <label class="form-check-label" for="Friday"> {{ __('Friday') }} </label>
                                    </div>
                                </div>
                                <p class="m-0 fs-6 text-danger" v-if="form.errors.days">{{ form.errors.days }}</p>
                            </div>
                            <!-- Days -->

                            <!-- Minutes -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="minutes">{{ __('Training minutes') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="minutes" v-model="form.minutes" :placeholder="__('Training minutes')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.minutes">{{ form.errors.minutes }}</span>
                                </div>
                            </div>
                            <!-- Minutes -->

                            <!-- Seats -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="seats">{{ __('Seats') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="seats" v-model="form.seats">
                                            <option v-for="x in 1000" :key="x" :value="x">{{ x }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.seats">{{ form.errors.seats }}</span>
                                </div>
                            </div>
                            <!-- Seats -->

                            <!-- cost -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="cost">{{ __('Course cost') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="cost" v-model="form.cost">
                                            <option value="0">{{ __('Free') }}</option>
                                            <option value="1">{{ __('Paid in full') }}</option>
                                            <option value="2">{{ __('Certificate Paid') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.cost">{{ form.errors.cost }}</span>
                                </div>
                            </div>
                            <!-- cost -->

                            <!-- cost - data -->
                            <template v-if="form.cost != 0">
                                <div class="row">
                                    <div class="mb-3 col-12 col-sm-4">
                                        <label class="form-label" for="price">{{ __('Fees') }}</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" id="price" v-model="form.price" :placeholder="__('Fees')" />
                                        </div>
                                        <span class="fs-6 text-danger" v-if="form.errors.price">{{ form.errors.price }}</span>
                                    </div>
                                    <div class="mb-3 col-12 col-sm-4">
                                        <label class="form-label" for="currency">{{ __('Currency') }}</label>
                                        <div class="input-group">
                                            <select class="form-control m-select2-no" id="currency" v-model="form.currency">
                                                <option value="SAR">{{ __('SAR') }}</option>
                                            </select>
                                        </div>
                                        <span class="fs-6 text-danger" v-if="form.errors.currency">{{ form.errors.currency }}</span>
                                    </div>
                                    <div class="mb-3 col-12 col-sm-4">
                                        <label class="form-label" for="payment_method">{{ __('Payment method') }}</label>
                                        <div class="input-group">
                                            <select class="form-control m-select2-no" id="payment_method" v-model="form.payment_method">
                                                <option value="1">{{ __('Electronic') }}</option>
                                            </select>
                                        </div>
                                        <span class="fs-6 text-danger" v-if="form.errors.payment_method">{{ form.errors.payment_method }}</span>
                                    </div>
                                </div>
                            </template>
                            <!-- cost - data -->

                            <!-- images -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="images">{{ __('Images') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="file" @change="handleImages" multiple />
                                    </div>
                                    <p class="fs-6 text-danger" v-if="form.errors.images">{{ form.errors.images }}</p>
                                    <div class="images border p-3" v-if="form.images.length">
                                        <img v-for="(img, i) in form.images" :key="i" :src="img" class="img-thumbnail d-inline mx-1" style="max-width: 120px" @click="form.images.splice(i, 1)" />
                                    </div>
                                </div>
                            </div>
                            <!-- images -->

                            <!-- Trainer -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="trainer">{{ __('Trainer') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="trainer" v-model="form.trainer" :placeholder="__('Trainer')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.trainer">{{ form.errors.trainer }}</span>
                                </div>
                            </div>
                            <!-- Trainer -->

                            <!-- Summary -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="summary">{{ __('Summary') }}</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="summary" v-model="form.summary" :placeholder="__('Summary')"></textarea>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.summary">{{ form.errors.summary }}</span>
                                </div>
                            </div>
                            <!-- Summary -->

                            <!-- Content -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="content">{{ __('Content') }}</label>
                                    <div class="input-group">
                                        <textarea rows="15" class="form-control" id="content" v-model="form.content" :placeholder="__('Content')"></textarea>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.content">{{ form.errors.content }}</span>
                                </div>
                            </div>
                            <!-- Content -->

                            <!-- Zoom & Youtube link -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="zoom">{{ __('Zoom link') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="url" id="zoom" v-model="form.zoom" :placeholder="__('Zoom link')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.zoom">{{ form.errors.zoom }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="youtube">{{ __('Youtube link') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="url" id="youtube" v-model="form.youtube" :placeholder="__('Youtube link')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.youtube">{{ form.errors.youtube }}</span>
                                </div>
                            </div>
                            <!-- Zoom & Youtube link -->

                            <!-- Template & Questionnaire -->
                            <div class="row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="template_id">{{ __('Template') }}</label>
                                    <select class="form-control m-select2-no" id="template_id" v-model="form.template_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(template, k) in templates" :key="k" :value="template.id">{{ __(template.name) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.template_id">{{ form.errors.template_id }}</p>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="questionnaire_id">{{ __('Questionnaire') }}</label>
                                    <select class="form-control m-select2-no" id="questionnaire_id" v-model="form.questionnaire_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        <option v-for="(questionnaire, k) in questionnaires" :key="k" :value="questionnaire.id">{{ __(questionnaire.name_ar) }}</option>
                                    </select>
                                    <p class="fs-6 text-danger" v-if="form.errors.questionnaire_id">{{ form.errors.questionnaire_id }}</p>
                                </div>
                            </div>
                            <!-- Template & Questionnaire -->

                            <!-- Attendance end -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="attendance_mins">{{ __('(in minutes) The duration of the preparation period') }}</label>
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            type="number"
                                            id="attendance_mins"
                                            v-model="form.attendance_mins"
                                            :placeholder="__('(in minutes) The duration of the preparation period')"
                                        />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.attendance_mins">{{ form.errors.attendance_mins }}</span>
                                </div>
                            </div>
                            <!-- Attendance end -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2" :disabled="form.processing">{{ __('Create') }}</button>
                                <Link :href="route('admin.courses.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Member information -->
            </div>
            <!--/ Member Content -->
        </div>
    </div>
    <!-- / Content -->
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(function () {
            $('#us3').locationpicker({
                location: {
                    latitude: 27.0001404,
                    longitude: 49.6574203,
                },
                radius: 10,
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.SATELLITE,
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {},
            });
        });
    },
};
</script>
