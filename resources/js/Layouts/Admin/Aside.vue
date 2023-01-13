<template>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="/img/logo.png" style="height: 100%" />
                </span>
                <span class="app-brand-text demo menu-text fs-5 fw-bold">{{ __('SJU') }}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item" :class="{ active: $page.component == 'Admin/Dashboard' }">
                <Link :href="route('admin.dashboard')" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div>{{ __('Dashboard') }}</div>
                </Link>
            </li>

            <!-- Roles and moderators -->
            <li class="menu-item" :class="{ 'active open': $page.component.startsWith('Admin/Roles') || $page.component.startsWith('Admin/Admins') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-key"></i>
                    <div>{{ __('Roles & moderators') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item" :class="{ active: $page.component.startsWith('Admin/Roles') }">
                        <Link :href="route('admin.roles.index')" class="menu-link">
                            <div>{{ __('Roles & permissions') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.component.startsWith('Admin/Admins') }">
                        <Link :href="route('admin.admins.index')" class="menu-link">
                            <div>{{ __('Moderators') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Members -->
            <li class="menu-item" :class="{ 'active open': $page.component.startsWith('Admin/Members') || $page.component.startsWith('Admin/Admins') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{ __('Members') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item" :class="{ active: $page.component == 'Admin/Members/Accepted' }">
                        <Link :href="route('admin.members.index')" class="menu-link">
                            <div>{{ __('Members') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.component == 'Admin/Members/BranchApproval' }">
                        <Link :href="route('admin.members.branch-approval')" class="menu-link">
                            <div>{{ __('Branch approval') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.component == 'Admin/Members/Admin' }">
                        <Link :href="route('admin.members.index')" class="menu-link">
                            <div>{{ __('Admin approval') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</template>
