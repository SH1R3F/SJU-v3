<script></script>
<template>
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade section news-slider" data-mdb-ride="carousel">
        <div class="container">
            <div class="carousel-inner">
                <div class="carousel-item slider" v-for="i in 9" :key="i" :class="{ active: i == 1 }">
                    <div class="row">
                        <div class="col-lg-8 order-lg-last">
                            <img
                                :src="i == 2 ? 'https://sju.org.sa/data/images/uploads/2022-12-27/abd4885d6a.jpeg' : 'https://sju.org.sa/data/images/uploads/2023-01-01/e93daac93a1.jpeg'"
                                alt="Name"
                            />
                        </div>
                        <div class="col-lg-4 order-lg-first description">
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, veritatis.</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore adipisci suscipit corrupti autem temporibus commodi, placeat quae ad enim magni.</p>
                            <a href="#">{{ __('Details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
