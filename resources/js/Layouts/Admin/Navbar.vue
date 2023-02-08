<script></script>
<template>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i
                            class="fi fis rounded-circle me-1 fs-3"
                            :class="{
                                'fi-sa': $page.props.locale === 'ar',
                                'fi-gb': $page.props.locale === 'en',
                            }"
                        ></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" :href="route('language', 'ar')" data-language="sa">
                                <i class="fi fi-sa fis rounded-circle me-1 fs-3"></i>
                                <span class="align-middle">العربية</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" :href="route('language', 'en')" data-language="en">
                                <i class="fi fi-gb fis rounded-circle me-1 fs-3"></i>
                                <span class="align-middle">English</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ Language -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="ti ti-bell ti-md"></i>
                        <span class="badge bg-danger rounded-pill badge-notifications" v-if="$page.props.notifications?.length">{{ $page.props.notifications?.length }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto">{{ __('Notifications') }}</h5>
                                <Link
                                    as="span"
                                    method="post"
                                    :href="route('read-all-notifications')"
                                    class="dropdown-notifications-all text-body"
                                    data-bs-placement="top"
                                    :title="__('Mark all as read')"
                                >
                                    <i class="ti ti-mail-opened fs-4"></i>
                                </Link>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-action dropdown-notifications-item" v-for="notification in $page.props.notifications">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0">{{ notification.data.message }}</p>
                                            <small class="text-muted">{{ arabic_date(notification.created_at) }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <Link method="post" as="span" :href="route('read-notification', notification.id)" class="dropdown-notifications-archive"
                                                ><span class="ti ti-x"></span
                                            ></Link>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-action dropdown-notifications-item" v-if="!$page.props.notifications?.length">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0">{{ __("You don't have any unseen notifications") }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="/img/admin.png" class="h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="/img/admin.png" class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ $page.props.authUser?.data?.fullName }}</span>
                                        <small class="text-muted">{{ __($page.props.authUser?.data?.role) }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <Link class="dropdown-item" :href="route('admin.my-profile')">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">{{ __('My profile') }}</span>
                            </Link>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <Link class="dropdown-item" :href="route('admin.logout')" method="post" as="button">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle">{{ __('Log Out') }}</span>
                            </Link>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
</template>
