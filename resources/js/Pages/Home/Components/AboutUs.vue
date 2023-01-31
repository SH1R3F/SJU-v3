<script></script>
<template>
    <div class="section about-organization">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-last">
                    <img src="/img/about-organization.jpg" :alt="__('About authority')" class="img-fluid w-100" />
                </div>

                <div class="col-lg-6 order-lg-first about-us pt-4">
                    <h2>{{ __('About authority') }}</h2>

                    <p>
                        {{
                            __(
                                'The Saudi Journalists Association for Professional Performance in the Kingdom of Saudi Arabia was established according to Article No. 27 of the Press Institutions Law by Royal Decree No. (M / 20) on 05/08/1422 AH, and its regulations were approved at the first meeting of the Association, which was held on the date corresponding to 4/19 / 1425 AH corresponding to 7/7/2004 Minister of Culture and Information, these regulations are in accordance with Resolution No. (M / F / 383) dated 11/8/1425 AH. The establishment of the foundation stems from a real desire to serve membership in the Kingdom of Saudi Arabia.'
                            )
                        }}
                    </p>

                    <Link href="/about-us">
                        <Link as="button" :href="route('pages.show', 'about-authority')" class="read-more">{{ __('Read more') }}</Link>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
