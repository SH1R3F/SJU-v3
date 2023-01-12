<script setup>
defineProps({
    member: Object,
});
</script>

<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">مدفوعة \ بانتظار الدفع</span>
                <div class="d-flex justify-content-center">
                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">{{ __('SAR') }}</sup>
                    <h1 class="fw-semibold mb-0 text-primary">250</h1>
                </div>
            </div>
            <ul class="ps-3 g-2 my-3">
                <li class="mb-2">تاريخ الدفع م</li>
                <li class="mb-2">رقم الفاتورة</li>
            </ul>
            <div class="d-grid w-100 mt-4">
                <button class="btn btn-primary">{{ __('Go to invoice') }}</button>
            </div>
        </div>
    </div>
</template>
