<script></script>
<template>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <Link :href="route('admin.dashboard')" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="/img/logo.png" style="height: 100%" />
            </span>
            <span class="app-brand-text demo menu-text fs-5 fw-bold">{{ __('SJU') }}</span>
            </Link>

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
            <!-- Dashboard -->

            <!-- Site options -->
            <li v-if="$page.props.authUser?.can_view?.options" class="menu-item"
                :class="{ active: $page.component == 'Admin/SiteOptions/Index' }">
                <Link :href="route('admin.site.options')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-tool"></i>
                <div>{{ __('Site options') }}</div>
                </Link>
            </li>
            <!-- Site options -->

            <!-- Roles and moderators -->
            <li v-if="$page.props.authUser?.can_view?.roles || $page.props.authUser?.can_view?.admins || $page.props.authUser?.can_view?.employees" class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Roles') || $page.component.startsWith('Admin/Admins') || $page.component.startsWith('Admin/Employees') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-key"></i>
                    <div>{{ __('Roles & moderators') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.roles" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Roles') }">
                        <Link :href="route('admin.roles.index')" class="menu-link">
                        <div>{{ __('Roles & permissions') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.admins" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Admins') }">
                        <Link :href="route('admin.admins.index')" class="menu-link">
                        <div>{{ __('Moderators') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.employees" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Employees') }">
                        <Link :href="route('admin.employees.index')" class="menu-link">
                        <div>{{ __('Employees') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Members -->
            <li v-if="$page.props.authUser?.can_view?.acceptedMembers ||
                $page.props.authUser?.can_view?.branchApproval ||
                $page.props.authUser?.can_view?.adminApproval ||
                $page.props.authUser?.can_view?.refusedMembers ||
                $page.props.authUser?.can_view?.invoices ||
                $page.props.authUser?.can_view?.transactions ||
                $page.props.authUser?.can_view?.transfers ||
                $page.props.authUser?.can_view?.statsMembers
                " class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Members') || $page.component.startsWith('Admin/Invoices') || $page.component.startsWith('Admin/Transactions') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{ __('Members') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.acceptedMembers" class="menu-item"
                        :class="{ active: $page.component == 'Admin/Members/Accepted' }">
                        <Link :href="route('admin.members.index')" class="menu-link">
                        <div>{{ __('Members') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.branchApproval" class="menu-item"
                        :class="{ active: $page.component == 'Admin/Members/BranchApproval' }">
                        <Link :href="route('admin.members.branch-approval')" class="menu-link">
                        <div>{{ __('Branch approval') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.adminApproval" class="menu-item"
                        :class="{ active: $page.component == 'Admin/Members/AdminAcceptance' }">
                        <Link :href="route('admin.members.admin-acceptance')" class="menu-link">
                        <div>{{ __('Admin approval') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.refusedMembers" class="menu-item"
                        :class="{ active: $page.component == 'Admin/Members/Refused' }">
                        <Link :href="route('admin.members.refused')" class="menu-link">
                        <div>{{ __('Refused members') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.transfers" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Transfers') }">
                        <Link :href="route('admin.members.transfers')" class="menu-link">
                        <div>{{ __('Member transfers') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.invoices" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Invoices') }">
                        <Link :href="route('admin.invoices.index')" class="menu-link">
                        <div>{{ __('Invoices') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.transactions" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Transactions') }">
                        <Link :href="route('admin.transactions.index')" class="menu-link">
                        <div>{{ __('Payment attempts') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.statsMembers" class="menu-item">
                        <a :href="route('admin.members.stats.pdf')" class="menu-link">
                            <div>{{ __('Members statistics') }}</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Subscribers -->
            <li v-if="$page.props.authUser?.can_view?.subscribers" class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Subscribers') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{ __('Subscribers') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"
                        :class="{ active: $page.url.includes('admin/subscribers/active') || $page.url == '/admin/subscribers' }">
                        <Link :href="route('admin.subscribers.index', 'active')" class="menu-link">
                        <div>{{ __('Active subscribers') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.url.includes('admin/subscribers/inactive') }">
                        <Link :href="route('admin.subscribers.index', 'inactive')" class="menu-link">
                        <div>{{ __('Inactive subscribers') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Volunteers -->
            <li v-if="$page.props.authUser?.can_view?.volunteers" class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Volunteers') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{ __('Volunteers') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"
                        :class="{ active: $page.url.includes('admin/volunteers/active') || $page.url == '/admin/volunteers' }">
                        <Link :href="route('admin.volunteers.index', 'active')" class="menu-link">
                        <div>{{ __('Active volunteers') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.url.includes('admin/volunteers/inactive') }">
                        <Link :href="route('admin.volunteers.index', 'inactive')" class="menu-link">
                        <div>{{ __('Inactive volunteers') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Courses -->
            <li v-if="$page.props.authUser?.can_view?.courses || $page.props.authUser?.can_view?.templates || $page.props.authUser?.can_view?.questionnaires"
                class="menu-item" :class="{ 'active open': $page.component.startsWith('Admin/Courses') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-certificate"></i>
                    <div>{{ __('Courses') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.courses" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Courses') && !$page.component.includes('Templates') && !$page.component.includes('Questionnaires') }">
                        <Link :href="route('admin.courses.index')" class="menu-link">
                        <div>{{ __('Courses') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.templates" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Courses/Templates') }">
                        <Link :href="route('admin.templates.index')" class="menu-link">
                        <div>{{ __('Templates') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.questionnaires" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Courses/Questionnaires') }">
                        <Link :href="route('admin.questionnaires.index')" class="menu-link">
                        <div>{{ __('Questionnaires') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- News section -->
            <li v-if="$page.props.authUser?.can_view?.categories ||
                $page.props.authUser?.can_view?.pages ||
                $page.props.authUser?.can_view?.articles ||
                $page.props.authUser?.can_view?.ads ||
                $page.props.authUser?.can_view?.urls
                " class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/News') || $page.component.startsWith('Admin/Ads') || $page.component.startsWith('Admin/Urls') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-news"></i>
                    <div>{{ __('News section') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.categories" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/News/Categories') }">
                        <Link :href="route('admin.categories.index')" class="menu-link">
                        <div>{{ __('Categories') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.pages" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/News/Pages') }">
                        <Link :href="route('admin.pages.index')" class="menu-link">
                        <div>{{ __('Pages') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.articles" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/News/Articles') }">
                        <Link :href="route('admin.articles.index')" class="menu-link">
                        <div>{{ __('Articles') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.ads" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Ads') }">
                        <Link :href="route('admin.ads.index')" class="menu-link">
                        <div>{{ __('Ads') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.urls" class="menu-item"
                        :class="{ active: $page.component.startsWith('Admin/Urls') }">
                        <Link :href="route('admin.urls.index')" class="menu-link">
                        <div>{{ __('Urls') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>
            <!-- News section -->

            <!-- Studio -->
            <li v-if="$page.props.authUser?.can_view?.studio" class="menu-item"
                :class="{ 'active open': $page.component.startsWith('Admin/Media') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-camera-plus"></i>
                    <div>{{ __('Studio') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item"
                        :class="{ active: $page.url.includes('admin/studio/photo') || $page.url.endsWith('admin/studio') }">
                        <Link :href="route('admin.media.index', 'photo')" class="menu-link">
                        <div>{{ __('Photos') }}</div>
                        </Link>
                    </li>
                    <li class="menu-item" :class="{ active: $page.url.includes('admin/studio/video') }">
                        <Link :href="route('admin.media.index', 'video')" class="menu-link">
                        <div>{{ __('Videos') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>
            <!-- Studio -->

            <!-- Technical support -->
            <li v-if="$page.props.authUser?.can_view?.support_members || $page.props.authUser?.can_view?.support_subscribers || $page.props.authUser?.can_view?.support_volunteers"
                class="menu-item" :class="{ 'active open': $page.component.startsWith('Admin/TechnicalSupport') }">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-headset"></i>
                    <div>{{ __('Technical support') }}</div>
                </a>
                <ul class="menu-sub">
                    <li v-if="$page.props.authUser?.can_view?.support_members" class="menu-item"
                        :class="{ active: $page.component == 'Admin/TechnicalSupport/Managers' }">
                        <Link :href="route('admin.tickets.managers')" class="menu-link">
                        <div>{{ __('Branch managers tickets') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.support_members" class="menu-item"
                        :class="{ active: $page.component == 'Admin/TechnicalSupport/Members' }">
                        <Link :href="route('admin.tickets.index')" class="menu-link">
                        <div>{{ __('Members tickets') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.support_subscribers" class="menu-item"
                        :class="{ active: $page.component == 'Admin/TechnicalSupport/Subscribers' }">
                        <Link :href="route('admin.tickets.subscribers')" class="menu-link">
                        <div>{{ __('Subscribers tickets') }}</div>
                        </Link>
                    </li>
                    <li v-if="$page.props.authUser?.can_view?.support_volunteers" class="menu-item"
                        :class="{ active: $page.component == 'Admin/TechnicalSupport/Volunteers' }">
                        <Link :href="route('admin.tickets.volunteers')" class="menu-link">
                        <div>{{ __('Volunteers tickets') }}</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Invitations -->
            <li v-if="$page.props.authUser?.can_view?.invitations" class="menu-item"
                :class="{ active: $page.component.startsWith('Admin/Invitations') }">
                <Link :href="route('admin.invitations.index')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail-opened"></i>
                <div>{{ __('Invitations') }}</div>
                </Link>
            </li>
            <!-- Invitations -->

            <!-- Training bags -->
            <li v-if="$page.props.authUser?.can_view?.training_bag" class="menu-item"
                :class="{ active: $page.component.startsWith('Admin/TrainingBag') }">
                <Link :href="route('admin.training-bag.index')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div>{{ __('Training bag') }}</div>
                </Link>
            </li>
            <!-- Training bags -->

            <!-- Competitions -->
            <li v-if="$page.props.authUser?.can_view?.competitions" class="menu-item"
                :class="{ active: $page.component.startsWith('Admin/Competitions') }">
                <Link :href="route('admin.competitions.index')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-award"></i>
                <div>{{ __('Competitions') }}</div>
                </Link>
            </li>
            <!-- Competitions -->

            <!-- Technical support for branch managers -->
            <li v-if="$page.props.authUser?.data.role === 'Branch manager'" class="menu-item"
                :class="{ active: $page.component.startsWith('Admin/BranchTechnicalSupport') }">
                <Link :href="route('admin.branch-issues.index')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-headset"></i>
                <div>{{ __('Technical support') }}</div>
                </Link>
            </li>
            <!-- Technical support for branch managers -->

            <!-- Candidates -->
            <li v-if="$page.props.authUser?.can_view?.candidates" class="menu-item"
                :class="{ active: $page.component.startsWith('Admin/Candidates') }">
                <Link :href="route('admin.candidates.index')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-star"></i>
                <div>{{ __('Elections') }}</div>
                </Link>
            </li>
            <!-- Candidates -->
        </ul>
    </aside>
</template>
