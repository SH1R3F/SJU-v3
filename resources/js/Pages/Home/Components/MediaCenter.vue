<template>
    <div class="section media-center">
        <div class="container">
            <div class="row">
                <h2 class="col-10">{{ __('Media center') }}</h2>
                <Link href="/news" class="col-2 text-end">{{ __('More') }}</Link>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 mb-3" v-for="x in 3">
                    <div class="post" style="background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('https://sju.org.sa/data/images/uploads/2022-12-29/a8f54abee6.jpeg')">
                        <div class="category">
                            <Link href="/news/?catid=1">
                                {{ __('Uncategorized') }}
                            </Link>
                        </div>
                        <div class="desc">
                            <h5>فرع هيئة الصحفيين السعوديين بمنطقة الجوف يقيم محاضرة بعنوان "صناعة المحتوى الإعلامي"</h5>
                            <span>Wednesday 28 / 12 / 20221</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
