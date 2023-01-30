<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Page;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Article;
use App\Models\Invoice;
use App\Policies\PagePolicy;
use App\Policies\RolePolicy;
use App\Models\Course\Course;
use App\Policies\AdminPolicy;
use App\Policies\CoursePolicy;
use App\Policies\MemberPolicy;
use App\Models\Course\Template;
use App\Policies\ArticlePolicy;
use App\Policies\InvoicePolicy;
use App\Policies\TemplatePolicy;
use Spatie\Permission\Models\Role;
use App\Models\Course\Questionnaire;
use App\Policies\QuestionnairePolicy;
use App\Models\TechnicalSupportTicket;
use App\Policies\TechnicalSupportPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Admin::class => AdminPolicy::class,
        Member::class => MemberPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Course::class => CoursePolicy::class,
        Template::class => TemplatePolicy::class,
        Questionnaire::class => QuestionnairePolicy::class,
        Page::class => PagePolicy::class,
        Article::class => ArticlePolicy::class,
        TechnicalSupportTicket::class => TechnicalSupportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
