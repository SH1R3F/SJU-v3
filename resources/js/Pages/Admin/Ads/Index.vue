<script setup>
const props = defineProps({
    ads: Object,
});
</script>

<template>
    <Head :title="__('Ads')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Ads') }}</h5>
            </div>
            <div class="card-datatable table-responsive pb-0">
                <div class="row me-2 py-3 text-center">
                    <div class="col-12 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="ads.can_create" :href="route('admin.ads.create')" type="button" class="dt-button add-new btn btn-primary me-1">
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
            <div class="col" v-for="ad in ads.data">
                <div class="card h-100">
                    <img class="card-img-top h-100" :src="ad.path" style="object-fit: contain" />
                    <div class="card-body text-center">
                        <h5>{{ ad.title }}</h5>
                        <div>
                            <Link :href="route('admin.ads.edit', ad.id)" as="span" class="mx-1 cursor-pointer btn btn-sm btn-label-light text-primary">
                                <i class="ti ti-edit ti-sm me-2"></i>
                            </Link>
                            <Link
                                :href="route('admin.ads.toggle', ad.id)"
                                method="post"
                                as="span"
                                class="mx-1 cursor-pointer btn btn-sm btn-label-light"
                                preserve-scroll
                                :title="ad.status ? __('Disable') : __('Enable')"
                                :class="{ 'text-success': ad.status, 'text-warning': !ad.status }"
                            >
                                <i class="ti ti-sm me-2" :class="{ 'ti-toggle-right': ad.status, 'ti-toggle-left': !ad.status }"></i>
                            </Link>
                            <Link :href="route('admin.ads.destroy', ad.id)" method="DELETE" as="span" class="mx-1 cursor-pointer btn btn-sm btn-label-light text-danger">
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
