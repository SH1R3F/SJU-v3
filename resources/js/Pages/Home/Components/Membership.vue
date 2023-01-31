<template>
    <div class="section membership">
        <div class="container">
            <h2>{{ __('Authority membership') }}</h2>

            <div class="row mt-5">
                <div class="col-md-5 mb-5">
                    <p>{{ __('Everyone who practices journalistic work has the right to apply for membership in the commission') }}</p>

                    <Link :href="route('member.register')">
                        <button>{{ __('Apply for a membership') }}</button>
                    </Link>
                </div>

                <div class="col-md-7">
                    <h4 class="mb-3">{{ __('Conditions for applying for membership') }}</h4>

                    <ol class="types">
                        <li>
                            <div class="heading">
                                <b>{{ __('Full-time member') }}</b>

                                <i class="fas fa-caret-up"></i>
                            </div>

                            <ol class="active">
                                <li>{{ __('Every Saudi journalist is dedicated to the profession of journalism') }}</li>

                                <li>
                                    {{
                                        __(
                                            'Every accredited and full-time journalist to work as a reporter or office manager according to a written agreement for any of the local and non-local media outlets in exchange for a fixed salary and he does not practice any other profession'
                                        )
                                    }}
                                </li>

                                <li>
                                    {{ __('That the media in which he works shall fulfill all the conditions for a journalistic profession and the arts of journalistic editing, chiefly news.') }}
                                </li>
                            </ol>
                        </li>

                        <li>
                            <div class="heading">
                                <b>{{ __('Part-time member') }}</b>

                                <i class="fas fa-caret-down"></i>
                            </div>

                            <ol>
                                <li>{{ __('Every Saudi journalist partially practices journalistic work') }}</li>

                                <li>{{ __('It includes Saudi journalists who occupy governmental or non-governmental jobs and who work alongside their perpetrators') }}</li>
                            </ol>
                        </li>

                        <li>
                            <div class="heading">
                                <b>{{ __('Affiliate member') }}</b>

                                <i class="fas fa-caret-down"></i>
                            </div>

                            <ol>
                                <li>{{ __('Every non-Saudi journalist residing in the Kingdom and working in the journalistic field under a work contract.') }}</li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
export default {
    mounted() {
        $(document).ready(function () {
            $('.membership .types .heading').click(function () {
                // Deactive other items
                $(this)
                    .parent('li')
                    .siblings()
                    .each(function () {
                        $(this).find('ol').removeClass('active');
                        $(this).find('i').attr('class', 'fas fa-caret-down');
                    });

                // Active current item
                $(this).siblings('ol').addClass('active');
                $(this).find('i').attr('class', 'fas fa-caret-up');
            });
        });
    },
};
</script>
