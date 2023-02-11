<script setup>
const props = defineProps({
    meta: Object,
    preserveScroll: {
        type: Boolean,
    },
});
</script>

<template>
    <div class="sju-pagination">
        <ul class="pagination">
            <li class="page-item" v-for="link in meta.links" :key="link.label" :class="{ active: link.active, disabled: link.url == null || link.active }">
                <Link :href="link.url" class="page-link" v-html="link.label" :preserve-scroll="preserveScroll"></Link>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.sju-pagination .active .page-link {
    color: #fff;
}
</style>
