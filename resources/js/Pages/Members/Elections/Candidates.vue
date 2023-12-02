<script setup>
import Pagination from '../../Components/Pagination.vue';
import route from 'ziggy-js';
const props = defineProps({
    candidates: Object,
    vote: Number
});

console.log(props);
</script>

<template>
    <Head :title="__('Candidates')" />
    <div class="sjupage allnews">
        <div class="section page-header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('home')">{{ __('Home') }}</Link>
                        </li>
                    </ul>
                </nav>

                <h3>{{ __('Elections for the Saudi Journalists Association') }}</h3>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <template v-if="candidates.data.length">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-4" v-for="candidate in candidates.data" :key="candidate.id">

                                    <div class="card text-center h-100">
                                        <img class="card-img-top p-3" :src="candidate.candidate.profile_photo || '/img/user-dark.png'" :alt="candidate.candidate.fullName" onerror="this.src = '/img/user-dark.png';">
                                        <div class="card-body">
                                            <h5 style="height: 50px" class="card-title">
                                                {{ candidate.candidate.fullName }}
                                            </h5>
                                            <Link
                                                v-if='!vote || vote === candidate.id'
                                                :href="route('member.elections.vote', candidate.id)"
                                                method='post'
                                                class="btn btn-sm mt-2 ripple-surface"
                                                :class="{'btn-outline-success': vote, 'btn-success': !vote}"
                                                :disabled="vote">
                                                {{ vote === candidate.id ? __('Voted') : __('Vote') }}
                                            </Link>
                                        </div>
                                        <p class="card-text mb-2" v-if='false'>
                                            <small class="text-muted">{{ candidate.candidate.branch?.name }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Pagination v-if='candidates.meta.last_page > 1' :meta="candidates.meta" />
                </template>

                <div class="text-start" style="min-height: 400px" v-if="!candidates.data.length">
                    <p class="alert alert-info lead">{{ __('No records found...') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
import App from '../../../Layouts/App.vue';
export default {
    layout: App,
    mounted() { },
};
</script>
