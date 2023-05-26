<script setup>
const props = defineProps({
    meta: Object,
});
</script>

<template>
    <div class="row mx-2 pt-2 align-items-center text-center text-md-start">
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_info" v-if="meta.total">
                {{ __('Showing :start to :end of :total entries', { start: meta.from, end: meta.to, total: meta.total }) }}
            </div>
            <div v-else>
                {{ __('No entries') }}
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="d-flex justify-content-center justify-content-md-end align-items-center">
                <ul class="pagination m-0">
                    <li v-for="link in meta.links" :key="link.label" class="paginate_button page-item text-nowrap"
                        :class="{ active: link.active, disabled: link.url == null || link.active }">
                        <Link :href="link.url" class="page-link" v-html="link.label">
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
