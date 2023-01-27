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
            <li
                v-if="$page.props.authUser?.can_view?.roles || $page.props.authUser?.can_view?.admins"
                class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Roles') || $page.component.startsWith('Admin/Admins') }"
            >
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-key"></i>
                    <div>{{ __('Roles & moderators') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.roles" class="menu-item" :class="{ active: $page.component.startsWith('Admin/Roles') }">
                        <Link :href="route('admin.roles.index')" class="menu-link">
                            <div>{{ __('Roles & permissions') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.admins" class="menu-item" :class="{ active: $page.component.startsWith('Admin/Admins') }">
                        <Link :href="route('admin.admins.index')" class="menu-link">
                            <div>{{ __('Moderators') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Members -->
            <li
                v-if="
                    $page.props.authUser?.can_view?.acceptedMembers ||
                    $page.props.authUser?.can_view?.branchApproval ||
                    $page.props.authUser?.can_view?.adminApproval ||
                    $page.props.authUser?.can_view?.refusedMembers ||
                    $page.props.authUser?.can_view?.invoices
                "
                class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Members') || $page.component.startsWith('Admin/Invoices') }"
            >
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{ __('Members') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.acceptedMembers" class="menu-item" :class="{ active: $page.component == 'Admin/Members/Accepted' }">
                        <Link :href="route('admin.members.index')" class="menu-link">
                            <div>{{ __('Members') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.branchApproval" class="menu-item" :class="{ active: $page.component == 'Admin/Members/BranchApproval' }">
                        <Link :href="route('admin.members.branch-approval')" class="menu-link">
                            <div>{{ __('Branch approval') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.adminApproval" class="menu-item" :class="{ active: $page.component == 'Admin/Members/AdminAcceptance' }">
                        <Link :href="route('admin.members.admin-acceptance')" class="menu-link">
                            <div>{{ __('Admin approval') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.refusedMembers" class="menu-item" :class="{ active: $page.component == 'Admin/Members/Refused' }">
                        <Link :href="route('admin.members.refused')" class="menu-link">
                            <div>{{ __('Refused members') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.invoices" class="menu-item" :class="{ active: $page.component.startsWith('Admin/Invoices') }">
                        <Link :href="route('admin.invoices.index')" class="menu-link">
                            <div>{{ __('Invoices') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Courses -->
            <li
                v-if="$page.props.authUser?.can_view?.courses || $page.props.authUser?.can_view?.templates || $page.props.authUser?.can_view?.questionnaires"
                class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Courses') }"
            >
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-certificate"></i>
                    <div>{{ __('Courses') }}</div>
                </a>
                <ul class="menu-sub">
                    <li
                        v-if="$page.props.authUser?.can_view?.courses"
                        class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Courses') && !$page.component.includes('Templates') && !$page.component.includes('Questionnaires') }"
                    >
                        <Link :href="route('admin.courses.index')" class="menu-link">
                            <div>{{ __('Courses') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.templates" class="menu-item" :class="{ active: $page.component.startsWith('Admin/Courses/Templates') }">
                        <Link :href="route('admin.templates.index')" class="menu-link">
                            <div>{{ __('Templates') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.questionnaires" class="menu-item" :class="{ active: $page.component.startsWith('Admin/Courses/Questionnaires') }">
                        <Link :href="route('admin.questionnaires.index')" class="menu-link">
                            <div>{{ __('Questionnaires') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Technical support -->
            <li
                v-if="$page.props.authUser?.can_view?.support_members || $page.props.authUser?.can_view?.support_subscribers || $page.props.authUser?.can_view?.support_volunteers"
                class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/TechnicalSupport') }"
            >
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-headset"></i>
                    <div>{{ __('Technical support') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.support_members" class="menu-item" :class="{ active: $page.component == 'Admin/TechnicalSupport/Members' }">
                        <Link :href="route('admin.tickets.index')" class="menu-link">
                            <div>{{ __('Members tickets') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.support_subscribers" class="menu-item" :class="{ active: $page.component == 'Admin/TechnicalSupport/Subscribers' }">
                        <Link :href="route('admin.tickets.subscribers')" class="menu-link">
                            <div>{{ __('Subscribers tickets') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.support_volunteers" class="menu-item" :class="{ active: $page.component == 'Admin/TechnicalSupport/Volunteers' }">
                        <Link :href="route('admin.tickets.volunteers')" class="menu-link">
                            <div>{{ __('Volunteers tickets') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</template>
