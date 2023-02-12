<script setup>
const props = defineProps({
    transaction: Object,
});
</script>

<template>
    <Head :title="__('Payment attempt')" />
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="table-responsive border-top" dir="ltr" style="text-align: left">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>{{ __('Key') }}</th>
                                    <th>{{ __('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in transaction.response">
                                    <td class="text-nowrap">{{ key }}</td>
                                    <td>
                                        <span style="white-space: break-spaces; word-break: break-all">
                                            {{ value }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->
        </div>
        <!-- /Offcanvas -->
    </div>
    <!-- / Content -->
</template>
