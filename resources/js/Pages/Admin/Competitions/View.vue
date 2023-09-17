<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    competition: Object,
});

const perPage = 50;
const page = ref(1);
const pages = Math.ceil(props.competition.submissions.length / perPage);
const pageSubmissions = computed(() => props.competition.submissions.slice((page.value - 1) * perPage, ((perPage - 1) * page.value) + 1));

let counter = computed(() => (row) => ((page.value - 1) * perPage) + row);

const paginate = (p) => {
    page.value = p
};
</script>

<template>
    <Head :title="__('View competition')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Competition Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ competition.name }}</h4>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">{{ __('Details') }}</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-2 d-inline-block">{{ __('Status') }}</span>
                                    <span>{{ competition.status ? __('Active') : __('Inactive') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Competition Sidebar -->

            <!-- Competition Content -->
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Coursables table -->
                <div class="card mb-4 p-4">
                    <div class="table-responsive">
                        <table class="table datatable-project border-top mb-2">
                            <thead>
                                <tr>
                                    <th class="cell-fit">#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th class="cell-fit">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, i) in pageSubmissions" :key="user.id">
                                    <td>{{ counter(i+1) }}</td>
                                    <td>
                                        <Link
                                            v-if="user.userable"
                                            :href="route(user.userable_type.includes('Member') ? 'admin.members.show' : (user.userable_type.includes('Subscriber') ? 'admin.subscribers.show' : 'admin.volunteers.show'), user.userable.id)"
                                            style="display: inline-block; max-width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis">
                                        {{ user.userable.fullName }}</Link>
                                        <Link
                                            v-else
                                            style="display: inline-block; max-width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis">
                                        {{ __('Guest') }}</Link>
                                    </td>
                                    <td>{{ __(user.userable_type?.split('\\')[2]) ?? __('Guest') }}</td>
                                    <td>
                                        <Link
                                            :href="route('admin.competitions.submission.show', user.id)"
                                            class="text-body" data-bs-placement="top"
                                            :aria-label="__('Show')" :title="__('Show')">
                                        <i class="ti ti-eye mx-2 ti-sm cursor-pointer"></i>
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="!props.competition.submissions.length">
                                    <td colspan="7" class="text-muted text-center p-3">
                                        {{ __('No one submitted for this competition') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation">
                            <ul class="pagination mb-0">
                                <li :class="{'page-item': true, 'disabled': page === 1}"><a class="page-link" @click.prevent="paginate(page-1)" :disabled="page === 1" href="#">{{ __('Previous') }}</a></li>
                                <li :class="{'page-item': true, 'disabled': page === p}" v-for="p in pages" :key="p" @click.prevent="paginate(p)">
                                    <a href="#" :class="{ 'page-link': true, 'active': page === p }" :disabled="page === p">
                                        {{ p }}
                                    </a>
                                </li>
                                <li :class="{'page-item': true, 'disabled': page === pages}"><a class="page-link" @click.prevent="paginate(page+1)" :disabled="page === pages" href="#">{{ __('Next') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /Coursables table -->
            </div>
            <!--/ Competition Content -->
        </div>
    </div>
    <!-- / Content -->
</template>
