<script setup>
import Sidebar from '../Sidebar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import NavTabs from './NavTabs.vue';

const props = defineProps({
    userAuth: Object,
});

const form = useForm({
    license_photo: '',
});
</script>

<template>
    <Head :title="__('Newspaper license')" />
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <Sidebar />
                </div>

                <div class="col-md-9">
                    <!-- page content -->
                    <div class="registration-form">
                        <nav-tabs />

                        <!-- Tab content -->
                        <div class="tab-content text-start" id="myTabContent">
                            <div class="tab-pane fade show text-start pt-4 active" role="tabpanel" aria-labelledby="home-tab">
                                <!-- I stopped here! -->
                                <form @submit.prevent="form.post(route('member.profile.license'))">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Photo rules -->
                                            <h5 class="mt-2">{{ __('Important instructions') }}</h5>
                                            <ul class="list-unstyled">
                                                <li class="text-muted mt-1">
                                                    <i class="fas fa-caret-left"></i>
                                                    {{ __('The image must be of good quality') }}
                                                </li>
                                                <li class="text-muted mt-1">
                                                    <i class="fas fa-caret-left"></i>
                                                    {{ __('Image extension must be only jpg, gif or png') }}
                                                </li>

                                                <li class="text-muted mt-1">
                                                    <i class="fas fa-caret-left"></i>
                                                    {{ __('Maximum picture size is 2 Migabytes') }}
                                                </li>

                                                <li class="text text-danger mt-1" v-if="userAuth.status >= 1">
                                                    <i class="fas fa-caret-left"></i>
                                                    {{ __('Photo cannot be modified after branch approval') }}
                                                </li>
                                            </ul>
                                            <!-- Photo rules -->

                                            <!-- The upload button -->
                                            <div class="mt-4">
                                                <input type="file" class="form-control" @change="form.license_photo = $event.target.files[0]" v-if="userAuth.status < 1" />
                                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                                <p class="text text-danger text-sm" v-if="form.errors.license_photo">{{ form.errors.license_photo }}</p>

                                                <button type="submit" class="d-block mt-3 btn btn-success" :disabled="form.processing || userAuth.status >= 1">
                                                    {{ __('Upload') }}
                                                </button>
                                            </div>
                                            <!-- The upload button -->
                                        </div>

                                        <!-- preview -->

                                        <div class="col-md-4 text-center">
                                            <span class="d-block">
                                                <img class="img-fluid" :src="userAuth.license_photo || '/img/letter.png'" />
                                            </span>
                                        </div>
                                        <!-- preview -->
                                    </div>
                                    <!-- Row -->
                                </form>
                            </div>
                        </div>
                        <!-- Tab content -->
                    </div>
                    <!-- page content -->
                </div>
            </div>
        </div>
    </div>
</template>
