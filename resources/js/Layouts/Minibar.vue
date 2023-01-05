<template>
    <div class="mini-bar">
        <div class="container">
            <ul class="text-end">
                <li>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>

                <li>
                    <a href="https://twitter.com/sju_ksa" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>

                <li>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </li>

                <li class="dropdown">
                    <span class="dropdown-toggle" id="languageMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $page.props.locale === 'ar' ? 'العربية' : 'English' }}</span>

                    <ul class="dropdown-menu" aria-labelledby="languageMenu">
                        <li class="dropdown-item" :class="{ active: $page.props.locale === 'ar' }"><a :href="route('language', 'ar')">العربية</a></li>

                        <li class="dropdown-item" :class="{ active: $page.props.locale === 'en' }"><a :href="route('language', 'en')">English</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>
