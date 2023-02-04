<script setup>
const props = defineProps({
    status: Number,
});
</script>

<template>
    <Head>
        <title>الصفحة غير موجودة</title>
        <link rel="stylesheet" href="/assets/vendor/css/pages/page-misc.css" />
    </Head>
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper" v-if="status == 404">
            <h2 class="mb-3 mt-4">الصفحة غير موجودة :(</h2>
            <p class="mb-4 mx-2">لم يتم العثور على عنوان URL المطلوب على هذا الخادم. 😖</p>
            <a :href="route('home')" class="btn btn-success mb-4 waves-effect waves-light">عودة للصفحة الرئيسية</a>
        </div>
        <div class="misc-wrapper" v-if="status == 403">
            <h2 class="mb-3 mt-4">غير مصرح لك بدخول هذه الصفحة !</h2>
            <p class="mb-4 mx-2">ليس لديك إذن لعرض هذه الصفحة باستخدام بيانات الاعتماد التي قدمتها أثناء تسجيل الدخول. يرجى الاتصال بمسؤول الموقع.</p>
            <a :href="route('home')" class="btn btn-success mb-4 waves-effect waves-light">عودة للصفحة الرئيسية</a>
        </div>
        <div class="misc-wrapper" v-else>
            <h2 class="mb-3 mt-4">خطأ غير مقصود</h2>
            <p class="mb-4 mx-2">حدث خطأ أثناء عرض هذه الصفحة، إذا تكرر هذا الخطأ يرجى الإتصال بمسؤول الموقع</p>
            <a :href="route('home')" class="btn btn-success mb-4 waves-effect waves-light">عودة للصفحة الرئيسية</a>
        </div>
    </div>
</template>
<script>
export default {
    layout: null,
};
</script>
