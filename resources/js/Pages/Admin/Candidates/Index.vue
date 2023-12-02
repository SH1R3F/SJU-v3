<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../Components/Pagination.vue';
import { debounce } from '../../../helpers';

const props = defineProps({
    candidates: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.candidates.index', props.status), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, perPage.value],
    ([name, pp]) => {
        appended.value.name = name;
        appended.value.perPage = pp;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.candidates.index', props.status), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Candidates management')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Candidates management') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-12 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Name')" v-model="name" />
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <div class="row me-2 py-3 text-center">
                    <div class="col-md-2 mb-1">
                        <div class="me-3">
                            <div class="dataTables_length">
                                <label>
                                    <select class="form-select" v-model="perPage">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <a
                                    v-if="candidates.can_export"
                                    :href="route('admin.candidates.export', { status: status, ...queryParams() })"
                                    class="dt-button buttons-collection btn btn-label-secondary me-1"
                                    type="button"
                                >
                                    <span>
                                        <i class="ti ti-screen-share me-1 ti-xs"></i>
                                        {{ __('Export') }}
                                    </span>
                                </a>
                                <Link v-if="candidates.can_create" :href="route('admin.candidates.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create candidate') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('name')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'name' }">{{ __('User') }}</th>
                            <th @click.prevent="sortBy('votes')" class="cursor-pointer" :class="{ 'link-primary': filters.order == 'votes' }">{{ __('Votes') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="candidate in candidates.data" :key="candidate.id">
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img :src="candidate.candidate.profile_photo || '/img/user-dark.png'" alt="Avatar" onerror="this.src = '/img/user-dark.png';" class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Link :href="route('admin.members.show', candidate.candidate_id)" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ candidate.candidate.fullName }}</span>
                                        </Link>

                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ candidate.votes_count }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <Link
                                        v-if="candidate.deleteable"
                                        :href="route('admin.candidates.destroy', candidate.id)"
                                        preserve-scroll
                                        as="span"
                                        method="delete"
                                        class="text-body cursor-pointer"
                                    >
                                        <i class="ti ti-trash ti-sm me-2"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="candidates.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
