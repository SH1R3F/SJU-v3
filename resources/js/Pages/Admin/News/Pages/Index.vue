<script setup>
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import Pagination from '../../Components/Pagination.vue';
import { debounce } from '../../../../helpers';

const props = defineProps({
    pages: Object,
    filters: Object,
});

/**
 * Filters
 */
const perPage = ref(props.filters.perPage || 10);
const name = ref(props.filters.name || '');
const title = ref(props.filters.title || '');

const appended = ref({
    perPage: perPage.value,
    name: name.value,
    title: title.value,
    order: props.filters.order,
    dir: props.filters.dir,
});

const filterReq = debounce(() => Inertia.get(route('admin.pages.index'), appended.value, { preserveState: true, replace: true }), 500);
watch(
    () => [name.value, title.value, perPage.value],
    ([name, title, perPage]) => {
        appended.value.name = name;
        appended.value.title = title;
        appended.value.perPage = perPage;
        filterReq();
    }
);

const sortBy = (column) => {
    appended.value.order = column;
    appended.value.dir = props.filters.dir == 'desc' ? 'asc' : 'desc';
    Inertia.get(route('admin.pages.index'), appended.value, { preserveState: true, replace: true });
};
</script>

<template>
    <Head :title="__('Pages')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Pages') }}</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" :placeholder="__('Title')" v-model="title" />
                    </div>
                    <div class="col-md-6 mb-2">
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
                                <Link v-if="pages.can_create" :href="route('admin.pages.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create page') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th @click.prevent="sortBy('title')" :class="{ 'link-primary': filters.order == 'title' }" class="cursor-pointer cell-fit">{{ __('Title') }}</th>
                            <th @click.prevent="sortBy('slug')" :class="{ 'link-primary': filters.order == 'slug' }" class="cursor-pointer cell-fit">{{ __('Name') }}</th>
                            <th class="cell-fit">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="page in pages.data">
                            <td class="cell-fit">{{ page.title }}</td>
                            <td class="cell-fit">{{ page.slug }}</td>
                            <td class="cell-fit">
                                <div class="d-flex align-items-center">
                                    <Link v-if="page.editable" :href="route('admin.pages.edit', page.id)" class="text-body" data-bs-placement="top" :aria-label="__('Edit')" :title="__('Edit')">
                                        <i class="ti ti-edit mx-2 ti-sm"></i>
                                    </Link>
                                    <Link
                                        v-if="page.deleteable"
                                        :href="route('admin.pages.destroy', page.id)"
                                        method="DELETE"
                                        as="span"
                                        class="text-body"
                                        data-bs-placement="top"
                                        :aria-label="__('Delete')"
                                        :title="__('Delete')"
                                    >
                                        <i class="ti ti-trash mx-2 ti-sm cursor-pointer"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :meta="pages.meta" />
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
