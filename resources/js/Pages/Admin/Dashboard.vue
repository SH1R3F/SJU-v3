<script setup>
defineProps({
    authUser: Object,
});
</script>

<template>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-5">
            <div v-if="authUser?.can_view?.options" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Site options') }}</h5>
                        <p class="card-text">{{ __('Here you can find and modify the options used over the website') }}</p>
                        <Link :href="route('admin.site.options')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-tool"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.roles" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Roles & permissions') }}</h5>
                        <p class="card-text">{{ __('Control the roles and powers of controlling those who manage the site.') }}</p>
                        <Link :href="route('admin.roles.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-settings"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.admins" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Moderators') }}</h5>
                        <p class="card-text">{{ __('Adding, modifying or deleting accounts for managing the site.') }}</p>
                        <Link :href="route('admin.admins.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-users"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.acceptedMembers" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Members') }}</h5>
                        <p class="card-text">{{ __('Managing the members involved in the Saudi Journalists Association.') }}</p>
                        <Link :href="route('admin.members.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-users"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.subscribers" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Subscribers') }}</h5>
                        <p class="card-text">{{ __('Managing the subscribers involved in the Saudi Journalists Association.') }}</p>
                        <Link :href="route('admin.subscribers.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-users"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.volunteers" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Volunteers') }}</h5>
                        <p class="card-text">{{ __('Managing the volunteers involved in the Saudi Journalists Association.') }}</p>
                        <Link :href="route('admin.volunteers.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-users"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.courses" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Courses') }}</h5>
                        <p class="card-text">{{ __('Events and training courses participating in the Saudi Journalists Association') }}</p>
                        <Link :href="route('admin.courses.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-certificate"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.articles" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Articles') }}</h5>
                        <p class="card-text">{{ __('Articles and news section of the Association') }}</p>
                        <Link :href="route('admin.articles.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-news"></i>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="authUser?.can_view?.support_members" class="col-md-6 col-lg-4 mb-3">
                <div class="card text-center mb-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Technical support') }}</h5>
                        <p class="card-text">{{ __('Technical support and problems solutions') }}</p>
                        <Link :href="route('admin.tickets.index')" class="btn btn-primary waves-effect waves-light">
                            <i class="menu-icon tf-icons ti mx-auto ti-headset"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '../../Layouts/Admin/App.vue';
export default {
    layout: Layout,
};
</script>
