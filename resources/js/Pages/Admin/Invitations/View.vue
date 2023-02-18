<script setup>
const props = defineProps({
    invitation: Object,
});
</script>

<template>
    <Head :title="__('View invitation')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Invitation Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="/img/invitation.png" height="200" width="200" alt="Invitation" />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ invitation.name }}</h4>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Invitation statistics') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Total invited') }}</span>
                                    <span>{{ invitation.invites.length }} {{ __('Users') }}</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('invitation link') }}</span>
                                    <a :href="route('invitation.show', invitation.id)">{{ route('invitation.show', invitation.id) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Invitation Sidebar -->

            <!-- Invitation Content -->
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Coursables table -->
                <div class="card mb-4 p-4">
                    <div class="row me-2 py-3 text-end">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="false" type="button" class="dt-button btn btn-light me-1">
                                    <!-- Left for later maybe used -->
                                    <span>
                                        <i class="ti ti-bell-ringing me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Button') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project border-top">
                            <thead>
                                <tr>
                                    <th class="cell-fit">#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th class="cell-fit">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(invite, i) in invitation.invites" :key="i">
                                    <td>{{ i + 1 }}</td>
                                    <td>
                                        <Link href="#" style="display: inline-block; max-width: 150px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis">{{
                                            invite.name
                                        }}</Link>
                                    </td>
                                    <td>
                                        <a :href="invite.invitation" as="span" target="_blank" class="cursor-pointer" data-bs-placement="top" :title="__('View')">
                                            <i class="ti ti-sm me-2 ti-eye"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr v-if="!invitation.invites.length">
                                    <td colspan="3" class="text-muted text-center p-3">
                                        {{ __('No one is invited yet') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Coursables table -->
            </div>
            <!--/ Invitation Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
