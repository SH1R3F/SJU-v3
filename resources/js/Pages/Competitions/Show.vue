<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    competition: Object,
    registered: Boolean
});

const form = useForm({
    title: '',
    competition_fields: props.competition.fields.map(function (field) {
        field.answer = '';
        return field
    })
});
</script>

<template>
    <Head :title="competition.name" />
    <div class="sjupage eventspage">
        <!-- News Header -->

        <div class="section page-header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('home')">{{ __('Home') }}</Link>
                        </li>

                        <li class="breadcrumb-item">
                            <Link :href="route('competitions.show', competition.id)">{{ __('Competitions') }}</Link>
                        </li>
                    </ul>
                </nav>
                <div class="desc">
                    <h3>{{ competition.name }}</h3>
                </div>

                <div class="options">
                    <div class="buttons">
                        <Link :href="route('competitions.show', competition.id)" target="_blank">
                        <svg id="share" xmlns="http://www.w3.org/2000/svg" width="16.412" height="16.412"
                            viewBox="0 0 16.412 16.412">
                            <path id="Path_97" data-name="Path 97"
                                d="M162.223,0h-4.261a.427.427,0,1,0,0,.855H161.2l-8.313,8.393a.427.427,0,0,0,.607.6l8.3-8.383V4.689a.427.427,0,1,0,.855,0V.427A.427.427,0,0,0,162.223,0Zm0,0"
                                transform="translate(-146.238)" fill="#fff" />

                            <path id="Path_98" data-name="Path 98"
                                d="M13.853,56.9a.427.427,0,0,0-.427.427v4.68a1.284,1.284,0,0,1-1.282,1.282H2.137A1.284,1.284,0,0,1,.855,62.007V52a1.284,1.284,0,0,1,1.282-1.282h4.68a.427.427,0,1,0,0-.855H2.137A2.139,2.139,0,0,0,0,52V62.007a2.139,2.139,0,0,0,2.137,2.137H12.144a2.139,2.139,0,0,0,2.137-2.137v-4.68A.427.427,0,0,0,13.853,56.9Zm0,0"
                                transform="translate(0 -47.732)" fill="#fff" />
                        </svg>
                        </Link>

                        <a href="#" onclick="page2pdf('eventspage')" v-if="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15.465" height="16.412"
                                viewBox="0 0 15.465 16.412">
                                <g id="pdf" transform="translate(0)">
                                    <g id="Group_59" data-name="Group 59" transform="translate(0)">
                                        <g id="Group_58" data-name="Group 58">
                                            <path id="Path_85" data-name="Path 85"
                                                d="M30.146,4.441,25.965.1a.316.316,0,0,0-.227-.1H19.506a1.266,1.266,0,0,0-1.265,1.264V5.681H15.715a.947.947,0,0,0-.946.946v4.736a.947.947,0,0,0,.946.946h2.525V15.15a1.265,1.265,0,0,0,1.265,1.262h9.464a1.265,1.265,0,0,0,1.265-1.261V4.66A.316.316,0,0,0,30.146,4.441ZM25.816.852l3.432,3.567H25.816Zm-10.1,10.826a.315.315,0,0,1-.315-.315V6.627a.315.315,0,0,1,.315-.315h8.523a.315.315,0,0,1,.315.315v4.736a.315.315,0,0,1-.315.315ZM29.6,15.151a.633.633,0,0,1-.634.63H19.506a.633.633,0,0,1-.634-.631V12.309h5.366a.947.947,0,0,0,.946-.946V6.627a.947.947,0,0,0-.946-.946H18.872V1.264a.634.634,0,0,1,.634-.633h5.679v4.1a.316.316,0,0,0,.316.316h4.1Z"
                                                transform="translate(-14.769)" fill="#fff" />
                                        </g>
                                    </g>

                                    <g id="Group_61" data-name="Group 61" transform="translate(1.853 7.704)">
                                        <g id="Group_60" data-name="Group 60">
                                            <path id="Path_86" data-name="Path 86"
                                                d="M74.516,240.652a.711.711,0,0,0-.39-.265,3.185,3.185,0,0,0-.651-.041H72.6v2.711h.547v-1.023H73.5a3.123,3.123,0,0,0,.568-.039.793.793,0,0,0,.284-.129.743.743,0,0,0,.23-.267.884.884,0,0,0,.091-.42A.842.842,0,0,0,74.516,240.652Zm-.469.746a.359.359,0,0,1-.171.133,1.415,1.415,0,0,1-.433.043h-.3V240.8h.264a2.625,2.625,0,0,1,.394.019.378.378,0,0,1,.22.12.35.35,0,0,1,.087.244A.364.364,0,0,1,74.047,241.4Z"
                                                transform="translate(-72.596 -240.346)" fill="#fff" />
                                        </g>
                                    </g>

                                    <g id="Group_63" data-name="Group 63" transform="translate(4.378 7.704)">
                                        <g id="Group_62" data-name="Group 62">
                                            <path id="Path_87" data-name="Path 87"
                                                d="M153.53,241.087a1.185,1.185,0,0,0-.259-.439.907.907,0,0,0-.409-.25,1.954,1.954,0,0,0-.516-.052h-1v2.711h1.03a1.655,1.655,0,0,0,.485-.057.962.962,0,0,0,.385-.216,1.2,1.2,0,0,0,.29-.479,1.782,1.782,0,0,0,.083-.577A2,2,0,0,0,153.53,241.087ZM153,242.2a.574.574,0,0,1-.143.262.505.505,0,0,1-.221.113,1.491,1.491,0,0,1-.331.026h-.409v-1.8h.246a2.48,2.48,0,0,1,.449.026.521.521,0,0,1,.253.128.62.62,0,0,1,.155.263,1.619,1.619,0,0,1,.055.483A1.769,1.769,0,0,1,153,242.2Z"
                                                transform="translate(-151.346 -240.346)" fill="#fff" />
                                        </g>
                                    </g>

                                    <g id="Group_65" data-name="Group 65" transform="translate(7.118 7.704)">
                                        <g id="Group_64" data-name="Group 64">
                                            <path id="Path_88" data-name="Path 88"
                                                d="M238.7,240.8v-.459h-1.859v2.711h.547V241.9h1.132v-.459h-1.132V240.8Z"
                                                transform="translate(-236.846 -240.346)" fill="#fff" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>

                        <a href="#" onclick="window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16.412" height="16.412"
                                viewBox="0 0 16.412 16.412">
                                <g id="printer" transform="translate(0)">
                                    <path id="Path_89" data-name="Path 89"
                                        d="M14.7,14.206H12.651a.342.342,0,0,1,0-.684H14.7A1.027,1.027,0,0,0,15.728,12.5V7.71A1.027,1.027,0,0,0,14.7,6.684H1.71A1.027,1.027,0,0,0,.684,7.71V12.5A1.027,1.027,0,0,0,1.71,13.522H3.761a.342.342,0,0,1,0,.684H1.71A1.712,1.712,0,0,1,0,12.5V7.71A1.712,1.712,0,0,1,1.71,6H14.7a1.712,1.712,0,0,1,1.71,1.71V12.5A1.712,1.712,0,0,1,14.7,14.206Z"
                                        transform="translate(0 -1.897)" fill="#fff" />

                                    <path id="Path_90" data-name="Path 90"
                                        d="M12.445,20.684h-4.1a.342.342,0,0,1,0-.684h4.1a.342.342,0,1,1,0,.684Z"
                                        transform="translate(-2.529 -6.323)" fill="#fff" />

                                    <path id="Path_91" data-name="Path 91"
                                        d="M12.445,18.684h-4.1a.342.342,0,0,1,0-.684h4.1a.342.342,0,1,1,0,.684Z"
                                        transform="translate(-2.529 -5.691)" fill="#fff" />

                                    <path id="Path_92" data-name="Path 92"
                                        d="M9.71,16.684H8.342a.342.342,0,0,1,0-.684H9.71a.342.342,0,1,1,0,.684Z"
                                        transform="translate(-2.529 -5.059)" fill="#fff" />

                                    <path id="Path_93" data-name="Path 93"
                                        d="M14.232,4.787a.342.342,0,0,1-.342-.342V1.71A1.027,1.027,0,0,0,12.864.684H6.71A1.027,1.027,0,0,0,5.684,1.71V4.445a.342.342,0,1,1-.684,0V1.71A1.712,1.712,0,0,1,6.71,0h6.155a1.712,1.712,0,0,1,1.71,1.71V4.445A.342.342,0,0,1,14.232,4.787Z"
                                        transform="translate(-1.581)" fill="#fff" />

                                    <path id="Path_94" data-name="Path 94"
                                        d="M12.864,20.522H6.71A1.712,1.712,0,0,1,5,18.813V13.342A.342.342,0,0,1,5.342,13h8.89a.342.342,0,0,1,.342.342v5.471A1.712,1.712,0,0,1,12.864,20.522Zm-7.18-6.838v5.129A1.027,1.027,0,0,0,6.71,19.838h6.155a1.027,1.027,0,0,0,1.026-1.026V13.684Z"
                                        transform="translate(-1.581 -4.11)" fill="#fff" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- News Header -->

        <div class="page-content">
            <div class="container">
                <div class="event-content">
                    <div class="signing-form fw-bold" v-if="registered">{{ __("You've already submitted once") }}</div>
                    <div class="signing-form" v-else>
                        <form method="post" @submit.prevent="form.post(route('competitions.submit', competition.id), { onSuccess: () => form.reset() })">

                            <!-- Competition Field -->
                            <div class="form-row" v-for="(competition_field, i) in form.competition_fields"
                                :key="competition_field.id">
                                <div class="form-group col-sm-12">
                                    <label :for="`field-${competition_field.id}`">
                                        {{ competition_field.title }}
                                        <span class="text-danger" v-if="competition_field.required">*</span>
                                    </label>

                                    <template v-if="competition_field.type === 'text'">
                                        <textarea type="text" class="form-control"
                                        :id="`field-${competition_field.id}`" :name="`field-${competition_field.id}`"
                                        v-model="competition_field.answer"
                                        :required="competition_field.required"
                                        rows="1"></textarea>
                                    </template>

                                    <template v-else-if="competition_field.type === 'file'">
                                        <input type="file" class="form-control test"
                                        :id="`field-${competition_field.id}`" :name="`field-${competition_field.id}`"
                                        @change="competition_field.answer = $event.target.files[0]"
                                        :required="competition_field.required"/>
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                    </template>

                                    <template v-else>
                                        <input :type="competition_field.type" class="form-control"
                                        :id="`field-${competition_field.id}`" :name="`field-${competition_field.id}`"
                                        v-model="competition_field.answer"
                                        :required="competition_field.required"/>
                                    </template>

                                    <p class="text text-danger text-sm" v-if="form.errors.title">{{
                                        form.errors[`competition_fields.${i}.answer`] }}</p>
                                </div>
                            </div>
                            <!-- Competition Field -->

                            <button type="submit" class="btn btn-sm btn-success p-2" :disabled="form.processing">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() { },
};
</script>
