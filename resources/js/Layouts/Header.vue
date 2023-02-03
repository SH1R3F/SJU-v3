<script></script>
<template>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <Link :href="route('home')">
                        <img src="/img/logo.png" :alt="__('Saudi journalists association')" class="logo" />
                    </Link>
                </div>

                <div class="col-6">
                    <Link as="button" v-if="!$page.props.userAuth" class="login-btn" data-toggle="modal" data-target="#LoginModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45.485" height="39.798" viewBox="0 0 45.485 39.798">
                            <g id="user_6_" data-name="user (6)" transform="translate(0 -0.008)">
                                <path
                                    id="Path_3"
                                    data-name="Path 3"
                                    d="M94.808,18.959a9.476,9.476,0,1,1,9.476-9.475A9.486,9.486,0,0,1,94.808,18.959Zm0-16.109a6.633,6.633,0,1,0,6.633,6.633A6.64,6.64,0,0,0,94.808,2.851Zm0,0"
                                    transform="translate(-77.752)"
                                    fill="#fff"
                                />

                                <path
                                    id="Path_4"
                                    data-name="Path 4"
                                    d="M32.691,273.064H1.421A1.422,1.422,0,0,1,0,271.643V265.01a9.012,9.012,0,0,1,9-9H25.111a9.012,9.012,0,0,1,9,9v6.633A1.422,1.422,0,0,1,32.691,273.064ZM2.843,270.221H31.27V265.01a6.166,6.166,0,0,0-6.159-6.159H9a6.166,6.166,0,0,0-6.159,6.159Zm0,0"
                                    transform="translate(0 -233.258)"
                                    fill="#fff"
                                />

                                <path
                                    id="Path_5"
                                    data-name="Path 5"
                                    d="M316.2,189.518H300.089a1.421,1.421,0,1,1,0-2.843H316.2a1.421,1.421,0,1,1,0,2.843Zm0,0"
                                    transform="translate(-272.136 -170.085)"
                                    fill="#fff"
                                />

                                <path
                                    id="Path_6"
                                    data-name="Path 6"
                                    d="M396.093,119.312a1.422,1.422,0,0,1-1-2.428l6.576-6.576-6.576-6.576a1.422,1.422,0,1,1,2.011-2.011l7.581,7.58a1.422,1.422,0,0,1,0,2.011l-7.581,7.58A1.413,1.413,0,0,1,396.093,119.312Zm0,0"
                                    transform="translate(-359.611 -92.298)"
                                    fill="#fff"
                                />
                            </g>
                        </svg>

                        <span>{{ __('Login') }}</span>
                    </Link>
                    <!-- Login button, Modal trigger -->

                    <Link as="span" v-else :href="$page.props.userHome">
                        <button class="login-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45.485" height="39.798" viewBox="0 0 45.485 39.798">
                                <g id="user_6_" data-name="user (6)" transform="translate(0 -0.008)">
                                    <path
                                        id="Path_3"
                                        data-name="Path 3"
                                        d="M94.808,18.959a9.476,9.476,0,1,1,9.476-9.475A9.486,9.486,0,0,1,94.808,18.959Zm0-16.109a6.633,6.633,0,1,0,6.633,6.633A6.64,6.64,0,0,0,94.808,2.851Zm0,0"
                                        transform="translate(-77.752)"
                                        fill="#fff"
                                    />

                                    <path
                                        id="Path_4"
                                        data-name="Path 4"
                                        d="M32.691,273.064H1.421A1.422,1.422,0,0,1,0,271.643V265.01a9.012,9.012,0,0,1,9-9H25.111a9.012,9.012,0,0,1,9,9v6.633A1.422,1.422,0,0,1,32.691,273.064ZM2.843,270.221H31.27V265.01a6.166,6.166,0,0,0-6.159-6.159H9a6.166,6.166,0,0,0-6.159,6.159Zm0,0"
                                        transform="translate(0 -233.258)"
                                        fill="#fff"
                                    />
                                </g>
                            </svg>

                            <span>{{ __('My account') }}</span>
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade login-modal" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Log into Saudi journalists association') }}</h5>
                </div>

                <div class="modal-body">
                    <div class="row align-items-center">
                        <!-- Subscribers -->
                        <div class="col-lg-4 mb-1">
                            <div class="trainees">
                                <div class="title">{{ __('Subscribers') }}</div>

                                <div class="row">
                                    <div class="col-12">
                                        <a :href="route('subscriber.login')">
                                            <button class="btn btn-success w-100 login mb-2 text-light">{{ __('Login') }}</button>
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <a :href="route('subscriber.register')">
                                            <button class="btn w-100 register text-success">{{ __('Register') }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Members -->
                        <div class="col-lg-4 mb-1">
                            <div class="members">
                                <div class="title">{{ __('Members') }}</div>

                                <div class="row">
                                    <div class="col-12">
                                        <a :href="route('member.login')">
                                            <button class="btn w-100 login mb-2 text-light">{{ __('Login') }}</button>
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <a :href="route('member.register')">
                                            <button class="btn w-100 register text-success">{{ __('Register') }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Volunteers -->
                        <div class="col-lg-4 mb-1">
                            <div class="trainees">
                                <div class="title">{{ __('Volunteers') }}</div>

                                <div class="row">
                                    <div class="col-12">
                                        <a :href="route('volunteer.login')">
                                            <button class="btn btn-success w-100 login mb-2 text-light">{{ __('Login') }}</button>
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <a :href="route('volunteer.register')">
                                            <button class="btn w-100 register text-success">{{ __('Register') }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal -->
</template>
