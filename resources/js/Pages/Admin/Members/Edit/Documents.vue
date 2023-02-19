<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    member: Object,
    nationalities: Object,
    branches: Object,
});
const form = useForm({
    profile_photo: '',
    national_id_photo: '',
    statement_photo: '',
    contract_photo: '',
    license_photo: '',
    _method: 'PUT',
});
</script>

<template>
    <Head :title="__('Edit member')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Member Content -->
            <div class="col-12 order-0 order-md-1">
                <!-- Pills -->
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Index' }" :href="route('admin.members.edit', member.id)">
                            <i class="ti ti-check ti-xs me-1"></i>{{ __('Member info') }}
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Experiences' }" :href="route('admin.members.edit.experiences', member.id)">
                            <i class="ti ti-language ti-xs me-1"></i>
                            {{ __('Experiences & Fields') }}
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/Edit/Documents' }" :href="route('admin.members.edit.documents', member.id)">
                            <i class="ti ti-files ti-xs me-1"></i>{{ __('Documents') }}
                        </Link>
                    </li>
                </ul>
                <!-- Pills -->

                <!-- Member information -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Documents') }}</h5>
                    <div class="card-body">
                        <form @submit.prevent="form.post(route('admin.members.update.documents', member.id))" enctype="multipart/form-data">
                            <!-- Profile picture -->
                            <div class="card mb-3 py-3">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Profile picture') }}</h5>
                                            <input type="file" class="form-control" @change="form.profile_photo = $event.target.files[0]" />
                                            <p class="text text-sm text-danger mt-1" v-if="form.errors.profile_photo">{{ form.errors.profile_photo }}</p>
                                            <p class="text text-sm text-muted mt-1" v-else>{{ __("Leave empty if you don't want to change") }}</p>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a :href="member.profile_photo" target="_blank">
                                            <img
                                                class="card-img card-img-right"
                                                :src="member.profile_photo || `/img/user-dark.png`"
                                                onerror="this.src = '/img/user-dark.png';"
                                                style="max-width: 200px"
                                            />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile picture -->
                            <!-- ID photo -->
                            <div class="card mb-3 py-3">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('ID photo') }}</h5>
                                            <input type="file" class="form-control" @change="form.national_id_photo = $event.target.files[0]" />
                                            <p class="text text-sm text-danger mt-1" v-if="form.errors.national_id_photo">{{ form.errors.national_id_photo }}</p>
                                            <p class="text text-sm text-muted mt-1" v-else>{{ __("Leave empty if you don't want to change") }}</p>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a :href="member.national_id_photo" target="_blank">
                                            <img class="card-img card-img-right" :src="member.national_id_photo || `/img/card.png`" onerror="this.src = '/img/card.png';" style="max-width: 200px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /ID photo -->
                            <!-- Statement photo -->
                            <div class="card mb-3 py-3">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Employment statement') }}</h5>
                                            <input type="file" class="form-control" @change="form.statement_photo = $event.target.files[0]" />
                                            <p class="text text-sm text-danger mt-1" v-if="form.errors.statement_photo">{{ form.errors.statement_photo }}</p>
                                            <p class="text text-sm text-muted mt-1" v-else>{{ __("Leave empty if you don't want to change") }}</p>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a :href="member.statement_photo" target="_blank">
                                            <img class="card-img card-img-right" :src="member.statement_photo || `/img/letter.png`" onerror="this.src = '/img/letter.png';" style="max-width: 200px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Statement photo -->
                            <!-- License photo -->
                            <div class="card mb-3 py-3">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Newspaper license') }}</h5>
                                            <input type="file" class="form-control" @change="form.license_photo = $event.target.files[0]" />
                                            <p class="text text-sm text-danger mt-1" v-if="form.errors.license_photo">{{ form.errors.license_photo }}</p>
                                            <p class="text text-sm text-muted mt-1" v-else>{{ __("Leave empty if you don't want to change") }}</p>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a :href="member.license_photo" target="_blank">
                                            <img class="card-img card-img-right" :src="member.license_photo || `/img/letter.png`" onerror="this.src = '/img/letter.png';" style="max-width: 200px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /License photo -->
                            <!-- Contract photo -->
                            <div class="card mb-3 py-3" v-if="member.subscription?.num == 3">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Job contract') }}</h5>
                                            <input type="file" class="form-control" @change="form.contract_photo = $event.target.files[0]" />
                                            <p class="text text-sm text-danger mt-1" v-if="form.errors.contract_photo">{{ form.errors.contract_photo }}</p>
                                            <p class="text text-sm text-muted mt-1" v-else>{{ __("Leave empty if you don't want to change") }}</p>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a :href="member.contract_photo" target="_blank">
                                            <img class="card-img card-img-right" :src="member.contract_photo || `/img/letter.png`" onerror="this.src = '/img/letter.png';" style="max-width: 200px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Contract photo -->

                            <div>
                                <button type="submit" class="btn btn-primary me-2">{{ __('Update') }}</button>
                                <Link :href="route('admin.members.index')" as="button" type="reset" class="btn btn-label-secondary me-2">{{ __('Cancel') }}</Link>
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
