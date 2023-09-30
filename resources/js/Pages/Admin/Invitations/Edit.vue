<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    invitation: Object,
});

const form = useForm({
    name: props.invitation.name || '',
    variables: props.invitation.variables || {
        field: '{اسم المدعو}',
        height: 0,
        width_type: 'center',
        width: 0,
        fontsize: 40,
        fontcolor: '#deb43b',
    },
    welcome_message: props.welcome_message || 'يسرنا دعوتكم حضور ندوة ثقافية',
    file: props.invitation.file || '',
    preview: props.invitation.preview || '',
    qr_position: props.invitation.qr_position || 'none',
    qr_position_x: props.invitation.qr_position_x || 0,
    qr_position_y: props.invitation.qr_position_y || 0,
    qr_size: props.invitation.qr_size || 200,
    _method: 'PUT',
});
</script>

<template>
    <Head :title="__('Edit invitation')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Edit invitation') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.invitations.update', invitation.id), {
                            onSuccess: () => ($refs.previewer.src = invitation.preview),
                        })
                            ">
                            <!-- Name -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name" :placeholder="__('Name')"
                                            v-model="form.name" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <!-- Name -->

                            <!-- Welcome message -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="welcome_message">{{ __('Welcome message') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="welcome_message"
                                            :placeholder="__('Welcome message')" v-model="form.welcome_message" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.welcome_message">{{
                                        form.errors.welcome_message }}</span>
                                </div>
                            </div>
                            <!-- Welcome message -->

                            <!-- File -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="file">{{ __('File') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" accept="image/*" type="file" id="file"
                                            @change="form.file = $event.target.files[0]" />
                                    </div>
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{
                                        form.progress.percentage }}%</progress>
                                    <span class="fs-6 text-danger" v-if="form.errors.file">{{ form.errors.file }}</span>
                                </div>
                            </div>
                            <!-- File -->

                            <!-- Upload button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                            </div>
                            <!-- Upload button -->

                            <!-- File preview -->
                            <div class="row">
                                <label class="form-label fs-3" for="layout">{{ __('Preview') }}</label>
                                <iframe ref="previewer" class="border" :src="form.preview" width="100%"
                                    height="700"></iframe>
                            </div>
                            <!-- File preview -->

                            <hr />

                            <!-- Variables to be added -->
                            <div class="row">
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" for="field">{{ __('Field name') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" :value="form.variables.field" readonly />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" for="height">{{ __('Height') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="height"
                                            v-model="form.variables.height" :placeholder="__('Height')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" for="width_type">{{ __('Width type') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="width_type"
                                            v-model="form.variables.width_type">
                                            <option value="specify">{{ __('Specify') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2" v-if="form.variables.width_type === 'specify'">
                                    <label class="form-label" for="width">{{ __('Width') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="width" v-model="form.variables.width"
                                            :placeholder="__('Width')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" for="fontsize">{{ __('Font size') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="fontsize" v-model="form.variables.fontsize" :placeholder="__('Font size')" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-2">
                                    <label class="form-label" for="fontcolor">{{ __('Font color') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" style="height: 38px" type="color" :id="`fontcolor`"
                                            v-model="form.variables.fontcolor" :placeholder="__('Font color')" />
                                    </div>
                                </div>
                            </div>
                            <!-- Variables to be added -->
                            <hr />

                            <!-- QR code position -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="qr_position">{{ __('Verification code') }}</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2-no" id="qr_position"
                                            v-model="form.qr_position">
                                            <option value="none">{{ __('Without') }}</option>
                                            <option value="top-right">{{ __('Top right') }}</option>
                                            <option value="top">{{ __('Top center') }}</option>
                                            <option value="top-left ">{{ __('Top left') }}</option>
                                            <option value="bottom-right">{{ __('Bottom right') }}</option>
                                            <option value="bottom">{{ __('Bottom center') }}</option>
                                            <option value="bottom-left">{{ __('Bottom left') }}</option>
                                        </select>
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_position">{{ form.errors.qr_position
                                    }}</span>
                                </div>
                            </div>
                            <!-- QR code position -->

                            <!-- Qr margins -->
                            <div class="row" v-if="form.qr_position !== 'none'">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_position_x">{{ __('QR horizontal margin') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_position_x"
                                            v-model="form.qr_position_x" :placeholder="__('QR horizontal margin')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_position_x">{{
                                        form.errors.qr_position_x }}</span>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label class="form-label" for="qr_position_y">{{ __('QR vertical margin') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_position_y"
                                            v-model="form.qr_position_y" :placeholder="__('QR vertical margin')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_position_y">{{
                                        form.errors.qr_position_y }}</span>
                                </div>
                                <div class="mb-3 col-12 ">
                                    <label class="form-label" for="qr_size">{{ __('QR size') }}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="qr_size" v-model="form.qr_size"
                                            :placeholder="__('QR size')" />
                                    </div>
                                    <span class="fs-6 text-danger" v-if="form.errors.qr_size">{{
                                        form.errors.qr_size }}</span>
                                </div>
                            </div>
                            <!-- Qr margins -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.invitations.index')" as="button" type="reset"
                                    class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
