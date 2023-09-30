<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    mode: 'ar',
    layout: 'A4',
    variables: [
        {
            field: '{free_text}',
            text: ' ',
            height: 0,
            width_type: 'specify',
            width: 0,
            fontsize: 40,
            fontcolor: '#000000',
            fontfamily: 'gess',
        },
    ],
    with_title: true,
    male_title: '',
    female_title: '',
    qr_position: 'none',
    qr_margin_top: 0,
    qr_margin_right: 0,
    qr_margin_bottom: 0,
    qr_margin_left: 0,
    file: '',
    preview: '',
});

const variable = {
    field: '{free_text}',
    text: ' ',
    height: 0,
    width_type: 'specify',
    width: 0,
    fontsize: 40,
    fontcolor: '#000000',
    fontfamily: 'gess',
};
</script>

<template>
    <Head :title="__('Create Template')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Create Template') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.templates.store'))">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name" :placeholder="__('Name')" v-model="form.name" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <!-- Name -->
                            <!-- File -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="file">{{ __('File') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="file" id="file" @change="form.file = $event.target.files[0]" />
                                    </div>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                    <span class="fs-6 text-danger" v-if="form.errors.file">{{ form.errors.file }}</span>
                                </div>
                            </div>
                            <!-- File -->

                            <!-- Language -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="mode">{{ __('Language') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="mode" v-model="form.mode">
                                            <option value="ar">{{ __('Arabic') }}</option>
                                            <option value="en">{{ __('English') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.mode">{{ form.errors.mode }}</span>
                                </div>
                            </div>
                            <!-- Language -->

                            <!-- Layout options -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="layout">{{ __('Layout options') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="layout" v-model="form.layout">
                                            <option value="A4">{{ __('A4 portrait') }}</option>
                                            <option value="A4-L">{{ __('A4 landscape') }}</option>
                                            <option value="Letter">{{ __('Letter portrait') }}</option>
                                            <option value="Letter-L">{{ __('Letter landscape') }}</option>
                                            <option value="A3">{{ __('A3 portrait') }}</option>
                                            <option value="A3-L">{{ __('A3 landscape') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.layout">{{ form.errors.layout }}</span>
                                </div>
                            </div>
                            <!-- Layout options -->

                            <!-- Upload button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                            </div>
                            <!-- Upload button -->

                            <!-- File preview -->
                            <div class="row">
                                <label class="form-label fs-3" for="layout">{{ __('Preview') }}</label>
                                <iframe class="border" :src="form.preview" width="100%" height="700"></iframe>
                            </div>
                            <!-- File preview -->

                            <hr />

                            <!-- Variables to be added -->
                            <div class="row" v-for="(variable, i) in form.variables" :key="i">
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" :for="`field-${i}`">{{ __('Field name') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" :id="`field-${i}`" v-model="variable.field">
                                            <option value="{free_text}">{{ __('Free text') }}</option>
                                            <option value="{اسم_الفعالية}">{{ __('Course name') }}</option>
                                            <option value="{اسم_المتدرب}">{{ __('Trainee name') }}</option>
                                            <option value="{اليوم}">{{ __('Day') }}</option>
                                            <option value="{الموافق}">{{ __('Corresponding') }}</option>
                                            <option value="{المدة}">{{ __('Duration') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2" v-if="variable.field === '{free_text}'">
                                    <label class="form-label" :for="`text-${i}`">{{ __('Text') }}</label>
                                    <div class="input-group">
                                        <textarea class="form-control" :id="`text-${i}`" v-model="variable.text" rows="1" :placeholder="__('Text')"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label" :for="`height-${i}`">{{ __('Height') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" :id="`height-${i}`" v-model="variable.height" :placeholder="__('Height')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label" :for="`width_type-${i}`">{{ __('Width type') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" :id="`width_type-${i}`" v-model="variable.width_type">
                                            <option value="specify">{{ __('Specify') }}</option>
                                            <option value="width: 100%; text-align:center;">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1" v-if="variable.width_type === 'specify'">
                                    <label class="form-label" :for="`width-${i}`">{{ __('Width') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" :id="`width-${i}`" v-model="variable.width" :placeholder="__('Width')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label" :for="`fontsize-${i}`">{{ __('Font size') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" :id="`fontsize-${i}`" v-model="variable.fontsize" :placeholder="__('Font size')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label" :for="`fontcolor-${i}`">{{ __('Font color') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" style="height: 38px" type="color" :id="`fontcolor-${i}`" v-model="variable.fontcolor" :placeholder="__('Font color')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label" :for="`fontfamily-${i}`">{{ __('Font family') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" :id="`fontfamily-${i}`" v-model="variable.fontfamily">
                                            <option value="cairo">{{ __('Cairo Arabic') }}</option>
                                            <option value="gess">{{ __('gess Arabic') }}</option>
                                            <option value="almarai">{{ __('almarai Arabic') }}</option>
                                            <option value="tajawal">{{ __('tajawal Arabic') }}</option>
                                            <option value="amiri">{{ __('amiri Arabic') }}</option>
                                            <option value="xbriyaz">{{ __('xbriyaz Arabic') }}</option>
                                            <option value="pointart">{{ __('Pointart Arabic') }}</option>
                                            <option value="khayma">{{ __('khayma Arabic') }}</option>
                                            <option value="diwani">{{ __('Diwani Arabic') }}</option>
                                            <option value="lemonada">{{ __('Lemonada Arabic') }}</option>
                                            <option value="kufam">{{ __('Kufam Arabic') }}</option>
                                            <option value="marhey">{{ __('Marhey Arabic') }}</option>
                                            <option value="rakkas">{{ __('Rakkas Arabic') }}</option>
                                            <option value="dejavusans">{{ __('dejavusans English') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-md-1">
                                    <label class="form-label"></label>
                                    <div class="input-group">
                                        <button class="btn btn-link btn-label-danger" @click="form.variables.splice(i, 1)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" @click.prevent="form.variables.push(JSON.parse(JSON.stringify(variable)))">{{ __('Add field') }}</button>
                            <!-- Variables to be added -->
                            <hr />

                            <!-- With title -->
                            <div class="row">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" v-model="form.with_title" type="checkbox" id="with_title" />
                                    <label class="form-check-label" for="with_title"> {{ __('Add title before name') }} </label>
                                </div>
                                <p class="fs-6 text-danger" v-if="form.errors.with_title">{{ form.errors.with_title }}</p>
                            </div>
                            <!-- With title -->

                            <!-- Male & Female title -->
                            <div class="row" v-if="form.with_title">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="male_title">{{ __('Title for male') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="male_title" v-model="form.male_title" :placeholder="__('Longitude')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.male_title">{{ form.errors.male_title }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="female_title">{{ __('Title for female') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="female_title" v-model="form.female_title" :placeholder="__('Latitude')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.female_title">{{ form.errors.female_title }}</span>
                                </div>
                            </div>
                            <!-- Male & Female title -->

                            <hr />

                            <!-- QR code position -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="qr_position">{{ __('Verification code') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="qr_position" v-model="form.qr_position">
                                            <option value="none">{{ __('Without') }}</option>
                                            <option value="top:1mm;right:1mm">{{ __('Top right') }}</option>
                                            <option value="top:1mm;right:50%">{{ __('Top center') }}</option>
                                            <option value="top:1mm;left:1mm">{{ __('Top left') }}</option>
                                            <option value="bottom:1mm;right:1mm">{{ __('Bottom right') }}</option>
                                            <option value="bottom:1mm;right:50%">{{ __('Bottom center') }}</option>
                                            <option value="bottom:1mm;left:1mm">{{ __('Bottom left') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_position">{{ form.errors.qr_position }}</span>
                                </div>
                            </div>
                            <!-- QR code position -->

                            <!-- Qr margins -->
                            <div class="row" v-if="form.qr_position !== 'none'">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_margin_top">{{ __('QR margin top') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_margin_top" v-model="form.qr_margin_top" :placeholder="__('QR margin top')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_margin_top">{{ form.errors.qr_margin_top }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_margin_bottom">{{ __('QR margin bottom') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_margin_bottom" v-model="form.qr_margin_bottom" :placeholder="__('QR margin bottom')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_margin_bottom">{{ form.errors.qr_margin_bottom }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_margin_right">{{ __('QR margin right') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_margin_right" v-model="form.qr_margin_right" :placeholder="__('QR margin right')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_margin_right">{{ form.errors.qr_margin_right }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_margin_left">{{ __('QR margin left') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_margin_left" v-model="form.qr_margin_left" :placeholder="__('QR margin left')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_margin_left">{{ form.errors.qr_margin_left }}</span>
                                </div>
                            </div>
                            <!-- Qr margins -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Create') }}</button>
                                <Link :href="route('admin.templates.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
