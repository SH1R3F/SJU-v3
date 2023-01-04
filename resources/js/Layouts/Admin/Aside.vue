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
            <li class="menu-item" :class="{ 'active open': $page.component.startsWith('Admin/Roles') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-key"></i>
                    <div>{{ __('Roles & moderators') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item" :class="{ active: $page.component == 'Admin/Roles/Index' }">
                        <Link :href="route('admin.roles.index')" class="menu-link">
                            <div>{{ __('Roles & permissions') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item">
                        <a href="dashboards-crm.html" class="menu-link">
                            <div>{{ __('Moderators') }}</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</template>
