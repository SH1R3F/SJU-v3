<script setup>
const props = defineProps({
    media: Object,
});
</script>

<template>
    <Head :title="__('Studio')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Invoices List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-3">{{ __('Studio') }}</h5>
            </div>
            <div class="card-datatable table-responsive pb-0">
                <div class="row me-2 py-3 text-center">
                    <div class="col-12 mb-1">
                        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column gap-1 mb-3 mb-md-0">
                            <div class="dt-buttons">
                                <Link v-if="media.can_create" :href="route('admin.media.create')" type="button" class="dt-button add-new btn btn-primary me-1">
                                    <span>
                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                        <span class="d-none d-sm-inline-block">{{ __('Upload') }}</span>
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 mt-1">
            <div class="col" v-for="item in media.data">
                <div class="card h-100">
                    <img class="card-img-top h-100" v-if="item.type == 'photo'" :src="item.path" />

                    <iframe
                        v-if="item.type == 'video'"
                        width="352"
                        height="270"
                        class="card-img-top"
                        :src="item.path"
                        frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>

                    <div class="card-body text-center">
                        <Link :href="route('admin.media.destroy', item.id)" method="DELETE" as="button" class="btn btn-danger col-md-6">{{ __('Delete') }}</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</template>
