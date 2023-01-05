<template>
    <div class="members site-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="signing-form">
                        <!-- ADD TOASTR FOR LOGIN ERRORS -->

                        <h5>{{ __('Members login') }}</h5>

                        <form action="<?php echo  base_url();?>members/login" method="post" class="needs-validation">
                            <div class="form-group">
                                <label for="userEmail">{{ __('National ID number') }}</label>

                                <input type="text" name="identity" class="form-control" id="userEmail" :placeholder="__('National ID number')" required />
                            </div>

                            <div class="form-group">
                                <label for="userPassword">{{ __('Password') }}</label>

                                <input type="password" name="password" class="form-control" id="userPassword" placeholder="********" required />

                                <a href="<?php echo base_url(); ?>members/forget_password" class="text-muted form-text">{{ __('Forgot your password?') }}</a>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="signing-intro">
                        <div>
                            <i class="fas fa-user-edit"></i>

                            <h4>{{ __('New membership') }}</h4>

                            <p>{{ __('You can register for membership through the following link') }}</p>

                            <a href="<?php echo base_url(); ?>members/register">{{ __('Click here to register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
