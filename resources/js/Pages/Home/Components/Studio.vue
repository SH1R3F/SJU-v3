<script setup>
defineProps({
    photos: Object,
    videos: Object,
});
</script>

<template>
    <div class="section media-center">
        <div class="container">
            <div class="row">
                <h2 class="col-10">{{ __('Studio') }}</h2>
            </div>

            <div class="row mt-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">{{ __('All') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="false">{{ __('Photos') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">{{ __('Videos') }}</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="row mt-3">
                            <div class="col-md-4 mb-3" v-for="photo in photos">
                                <div class="post img-popup" :style="`background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('${photo.path}')`" :src="photo.path">
                                    <div class="category">
                                        <span>{{ __('Photo') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3" v-for="video in videos">
                                <iframe
                                    class=""
                                    width="352"
                                    height="260"
                                    :src="video.path"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
                        <div class="row mt-3">
                            <div class="col-md-4 mb-3" v-for="photo in photos">
                                <div class="post img-popup" :style="`background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('${photo.path}')`" :src="photo.path">
                                    <div class="category">
                                        <span>{{ __('Photo') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                        <div class="row mt-3">
                            <div class="col-md-4 mb-3" v-for="video in videos">
                                <iframe
                                    class=""
                                    width="352"
                                    height="260"
                                    :src="video.path"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal" class="modal extend">
            <span class="close">&times;</span>

            <img class="modal-content" />

            <div class="caption"></div>
        </div>
    </div>
</template>

<style>
.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
    background-color: #007c42;
    transition: all 0.3s;
}
.nav-pills .nav-link:hover {
    background-color: #0aa75d;
    transition: all 0.3s;
    color: #fff;
}
</style>

<script defer>
export default {
    mounted() {
        $(function () {
            $('.img-popup').click(function () {
                openPopUp($('#modal'), $(this).attr('src'), 'Caption');
            });

            $('#modal > .close').click(function () {
                closePopUp();
            });
        });

        function openPopUp(modal, src, alt) {
            $('#modal').css('display', 'block');

            $('#modal > .modal-content').attr('src', src);

            $('#modal > .caption').html(alt);
        }

        function closePopUp() {
            $('#modal').css('display', 'none');
        }
    },
};
</script>
