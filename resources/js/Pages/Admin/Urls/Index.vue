<script setup>
const props = defineProps({
    urls: Object,
});
</script>

<template>
    <Head :title="__('Urls')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Urls') }}</h5>
            </div>
            <div class="card-datatable table-responsive pb-0">
                <div class="row me-2 py-3 text-center">
                    <div class="col-12 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="urls.can_create" :href="route('admin.urls.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Create') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 mt-1">
            <div class="col" v-for="url in urls.data">
                <div class="card h-100">
                    <img style="object-fit: none" class="card-img-top h-100" :src="url.path" />
                    <div class="card-body text-center">
                        <h5>{{ url.title }}</h5>
                        <p class="text-muted text text-sm">{{ url.group_name }}</p>
                        <div>
                            <Link :href="route('admin.urls.edit', url.id)" as="span" class="mx-1 cursor-pointer btn btn-sm btn-label-light text-primary">
                                <i class="ti ti-edit ti-sm me-2"></i>
                            </Link>
                            <Link
                                :href="route('admin.urls.toggle', url.id)"
                                method="post"
                                as="span"
                                class="mx-1 cursor-pointer btn btn-sm btn-label-light"
                                preserve-scroll
                                :title="url.status ? __('Disable') : __('Enable')"
                                :class="{ 'text-success': url.status, 'text-warning': !url.status }"
                            >
                                <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': url.status, 'ti-toggle-left': !url.status }"></i>
                            </Link>
                            <Link :href="route('admin.urls.destroy', url.id)" method="DELETE" as="span" class="mx-1 cursor-pointer btn btn-sm btn-label-light text-danger">
                                <i class="ti ti-trash ti-sm me-2"></i>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
