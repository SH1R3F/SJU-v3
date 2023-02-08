<script setup>
defineProps({
    member: Object,
});
</script>
<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    <img
                        class="img-fluid rounded mb-3 pt-1 mt-4"
                        :src="member.profile_photo || '/img/user-dark.png'"
                        onerror="this.src = '/img/user-dark.png';"
                        height="200"
                        width="200"
                        alt="User avatar"
                    />
                    <div class="user-info text-center">
                        <h4 class="mb-2">{{ member.fullNameAr }}</h4>
                        <h4 class="mb-2">{{ member.fullNameEn }}</h4>
                        <span class="badge bg-label-secondary mt-1">{{ member.subscription?.type }}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center flex-wrap mt-3 pt-3 pb-4 border-bottom" v-if="false">
                <a href="javascript:;" data-bs-placement="top" :title="member.status == -1 ? __('Enable') : __('Disable')" class="btn btn-label-warning btn-sm me-2">
                    <i class="ti ti-sm" :class="{ 'ti-toggle-right': member.active != -1, 'ti-toggle-left': member.active == -1 }"></i>
                </a>
                <a href="javascript:;" data-bs-placement="top" :title="__('Edit')" class="btn btn-label-primary btn-sm me-2">
                    <i class="ti ti-edit ti-sm"></i>
                </a>
                <a href="javascript:;" data-bs-placement="top" :title="__('Delete')" class="btn btn-label-danger btn-sm">
                    <i class="ti ti-trash ti-sm"></i>
                </a>
            </div>
            <p class="mt-4 small text-uppercase text-muted">{{ __('Details') }}</p>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-semibold me-2 d-inline-block">{{ __('National ID number') }}</span>
                        <span>{{ member.national_id }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-semibold me-2 d-inline-block">{{ __('Membership number') }}</span>
                        <span>{{ member.membership_number }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-semibold me-2 d-inline-block">{{ __('Membership Status') }}</span>
                        <span class="badge bg-label-secondary">{{ member.membership_status }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-semibold me-2 d-inline-block">{{ __('Branch') }} </span>
                        <span>{{ member.branch.name }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-semibold me-2 d-inline-block">{{ __('Registration date') }}</span>
                        <span>{{ member.created_at }}</span>
                    </li>
                </ul>
            </div>
            <div class="d-grid w-100 mt-4">
                <a v-if="!member.can_pay" :href="route('admin.members.card', member.id)" target="_blank" class="btn btn-success mb-2">{{ __('Membership card') }}</a>
                <a :href="route('admin.members.form', member.id)" target="_blank" class="btn btn-primary">{{ __('Membership form') }}</a>
            </div>
        </div>
    </div>
</template>
