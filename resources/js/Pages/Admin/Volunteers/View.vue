<script setup>
const props = defineProps({
    volunteer: Object,
});
</script>

<template>
    <Head :title="__('Volunteer file')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Volunteer sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img
                                    class="img-fluid rounded mb-3 pt-1 mt-4"
                                    :src="volunteer.profile_photo || '/img/user-dark.png'"
                                    onerror="this.src = '/img/user-dark.png';"
                                    height="200"
                                    width="200"
                                    alt="User avatar"
                                />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ volunteer.fullName_ar }}</h4>
                                    <h4 class="mb-2">{{ volunteer.fullName_en }}</h4>
                                    <span class="badge bg-label-secondary mt-1">{{ __(volunteer.gender) }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Details') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('National ID') }}</span>
                                    <span>{{ volunteer.national_id }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Country') }}</span>
                                    <span>{{ volunteer.country }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Nationality') }}</span>
                                    <span>{{ volunteer.nationality }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Marital status') }}</span>
                                    <span>{{ volunteer.marital_status }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Region') }}</span>
                                    <span>{{ volunteer.region }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Governorate') }}</span>
                                    <span>{{ volunteer.governorate }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Job title') }}</span>
                                    <span>{{ volunteer.job_title }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Mobile') }}</span>
                                    <span class="badge bg-label-secondary">{{ volunteer.phone_number }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Email') }} </span>
                                    <span>{{ volunteer.email }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="d-grid w-100 mt-4">
                            <button class="btn btn-success mb-2">{{ volunteer.state }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Volunteer sidebar -->

            <!-- Volunteer Content -->
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Volunteer Pills -->
                <ul class="nav nav-pills flex-column flex-md-row mb-1">
                    <li class="nav-item w-100">
                        <a href="#" class="nav-link active"> <i class="ti ti-clipboard ti-xs me-1"></i>{{ __('Enrolled courses') }} </a>
                    </li>
                </ul>
                <!--/ Volunteer Pills -->

                <!-- Courses table -->
                <div class="card mb-4 p-4">
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project border-top">
                            <thead>
                                <tr>
                                    <th class="fw-bold">{{ __('Course name') }}</th>
                                    <th class="fw-bold">{{ __('Status') }}</th>
                                    <th class="fw-bold"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="course in volunteer.courses">
                                    <td>
                                        <Link :href="route('admin.courses.show', course.id)">{{ course.title }}</Link>
                                    </td>
                                    <td>{{ course.pivot.attendance ? __('Passed') : __("Didn't pass") }}</td>
                                    <td>
                                        <a
                                            v-if="course.pivot.attendance"
                                            :href="route('admin.volunteers.certificate', { volunteer: volunteer.id, course: course.id })"
                                            target="_blank"
                                            class="btn btn-sm btn-success"
                                        >
                                            {{ __('Certificate') }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Courses table -->
            </div>
            <!--/ Volunteer Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
