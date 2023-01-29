<script setup>
import { computed } from 'vue';

const props = defineProps({
    course: Object,
});

const all = computed(() => {
    return props.course.members?.length || 0 + props.course.subscribers?.length || 0 + props.course.volunteers?.length || 0;
});
const passed = computed(() => {
    return (
        props.course.members?.reduce((total, current) => {
            return current.pivot?.attendance;
        }, 0) ||
        0 +
            props.course.subscribers?.reduce((total, current) => {
                return current.pivot?.attendance;
            }, 0) ||
        0 +
            props.course.volunteers?.reduce((total, current) => {
                return current.pivot?.attendance;
            }, 0) ||
        0
    );
});
const unpassed = computed(() => {
    return all.value - passed.value;
});
</script>

<template>
    <Head :title="__('View course')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Course Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="course.image || '/img/course.png'" height="200" width="200" alt="Course" />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ course.title_ar }}</h4>
                                    <h4 class="mb-2">{{ course.title_en }}</h4>
                                    <span class="badge bg-label-secondary mt-1">{{ course.course_number }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Details') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Training minutes') }}</span>
                                    <span>{{ course.minutes }} {{ __('Minute') }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Passing percentage') }}</span>
                                    <span>{{ course.percentage }}%</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Course date') }}</span>
                                    <span>{{ course.date_from }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Region') }}</span>
                                    <span>{{ course.region }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Type') }}</span>
                                    <span>{{ course.course_type }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Location') }}</span>
                                    <span class="badge bg-label-secondary">{{ course.course_place }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Gender') }} </span>
                                    <span>{{ course.course_gender }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Category') }}</span>
                                    <span>{{ course.course_category }}</span>
                                </li>
                            </ul>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Course statistics') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Total attendance') }}</span>
                                    <span>{{ course.members?.length || 0 + course.subscribers?.length || 0 + course.volunteers?.length || 0 }} {{ __('Users') }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Passed number') }}</span>
                                    <span>{{ passed }} {{ __('Users') }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Non-Passed number') }}</span>
                                    <span>{{ unpassed }} {{ __('Users') }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Attendance duration') }}</span>
                                    <span>{{ course.attendance_mins ? `${course.attendance_mins} ${__('Minute')}` : __('Unspecified') }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Attendance link') }}</span>
                                    <a :href="route('courses.attend', course.id)">{{ route('courses.attend', course.id) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Course Sidebar -->

            <!-- Course Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- Coursables table -->
                <div class="card mb-4 p-4">
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project border-top">
                            <thead>
                                <tr>
                                    <th class="cell-fit">#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Mobile') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Passed') }}</th>
                                    <th class="cell-fit">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(member, i) in course.members" :key="member.id">
                                    <td>{{ i + 1 }}</td>
                                    <td>
                                        <Link :href="route('admin.members.show', member.id)">{{ member.fullName }}</Link>
                                    </td>
                                    <td>{{ __('Member') }}</td>
                                    <td>966{{ member.mobile }}</td>
                                    <td>{{ member.email }}</td>
                                    <td>
                                        <Link
                                            :href="route('admin.courses.attendance.toggle', { course: course.id, type: 'member', id: member.id })"
                                            method="post"
                                            as="span"
                                            preserve-scroll
                                            class="cursor-pointer"
                                            data-bs-placement="top"
                                            data-bs-toggle="tooltip"
                                            :data-bs-original-title="member.pivot?.attendance ? __('Passed') : __('Didn\'t pass')"
                                            :class="{ 'text-success': member.pivot?.attendance, 'text-body': !member.pivot?.attendance }"
                                        >
                                            <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': member.pivot?.attendance, 'ti-toggle-left': !member.pivot?.attendance }"></i>
                                        </Link>
                                    </td>
                                    <td>
                                        <Link
                                            :href="route('admin.courses.attendance.delete', { course: course.id, type: 'member', id: member.id })"
                                            method="DELETE"
                                            as="span"
                                            data-bs-toggle="tooltip"
                                            class="text-body"
                                            data-bs-placement="top"
                                            :aria-label="__('Delete')"
                                            :data-bs-original-title="__('Delete')"
                                        >
                                            <i class="ti ti-trash mx-2 ti-sm cursor-pointer"></i>
                                        </Link>
                                    </td>
                                </tr>

                                <!-- Add subscribers and volunteers here too -->

                                <tr v-if="!all">
                                    <td colspan="7" class="text-muted text-center p-3">
                                        {{ __('No one registered for this course') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Coursables table -->
            </div>
            <!--/ Course Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
