<script setup>
defineProps({
    member: Object,
});
</script>

<template>
    <div class="card mb-4" v-if="!member.can_pay">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">{{ __('PAID') }}</span>
                <div class="d-flex justify-content-center">
                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">{{ __('SAR') }}</sup>
                    <h1 class="fw-semibold mb-0 text-primary">{{ member.invoice.amount }}</h1>
                </div>
            </div>
            <ul class="ps-3 g-2 my-3">
                <li class="mb-2">
                    <b>تاريخ الدفع:</b>
                    {{ member.invoice.created_at }}
                </li>
                <li class="mb-2">
                    <b>رقم الفاتورة:</b>
                    #{{ member.invoice.invoice_number }}
                </li>
            </ul>
            <div class="d-grid w-100 mt-4">
                <Link :href="route('admin.invoices.show', member.invoice.id)" class="btn btn-primary">{{ __('Go to invoice') }}</Link>
            </div>
        </div>
    </div>
</template>
