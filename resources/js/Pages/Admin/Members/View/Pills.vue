<script setup>
defineProps({
    member: Object,
});
</script>

<template>
    <ul class="nav nav-pills flex-column flex-md-row mb-4">
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/View/Index' }" :href="route('admin.members.show', member.id)"
                ><i class="ti ti-check ti-xs me-1"></i>{{ __('Member info') }}</Link
            >
        </li>
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/View/Contact' }" :href="route('admin.members.show.contact', member.id)"
                ><i class="ti ti-phone-call ti-xs me-1"></i>{{ __('Contact info') }}</Link
            >
        </li>
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/View/Experiences' }" :href="route('admin.members.show.experiences', member.id)"
                ><i class="ti ti-language ti-xs me-1"></i>{{ __('Experiences & Fields') }}</Link
            >
        </li>
        <li class="nav-item">
            <Link class="nav-link" :class="{ active: $page.component == 'Admin/Members/View/Documents' }" :href="route('admin.members.show.documents', member.id)"
                ><i class="ti ti-files ti-xs me-1"></i>{{ __('Documents') }}</Link
            >
        </li>
    </ul>
</template>
