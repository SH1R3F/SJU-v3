<?php

namespace App\Http\Middleware;

use App\Models\Ad;
use App\Models\Url;
use App\Models\Page;
use App\Models\Admin;
use App\Models\Media;
use App\Models\Member;
use App\Models\Article;
use App\Models\Invoice;
use Inertia\Middleware;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Volunteer;
use App\Models\Invitation;
use App\Models\SiteOption;
use App\Models\Subscriber;
use App\Models\Competition;
use App\Models\TrainingBag;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Template;
use App\Models\MembershipTransfer;
use Spatie\Permission\Models\Role;
use App\Models\Course\Questionnaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdminResource;
use App\Http\Resources\MemberResource;
use App\Models\TechnicalSupportTicket;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\VolunteerResource;
use App\Http\Resources\SubscriberResource;
use App\Models\Candidate;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    public function rootView(Request $request)
    {
        if ($request->is('admin*')) {
            return 'admin';
        }
        return parent::rootView($request);
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $notifications = [];
        if ($request->is('admin*') && Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            if (!!$admin->roles && Employee::find($admin->id)?->hasRole('Employee')) {
                $auth = (new EmployeeResource(Employee::find($admin->id)))->additional(['can_view' => $this->adminPermissions($admin)]);
            } else {
                $auth = (new AdminResource($admin))->additional(['can_view' => $this->adminPermissions($admin)]);
            }

            $notifications = $admin->unreadNotifications()->orderBy('created_at', 'DESC')->get();
        }
        if (Auth::guard('member')->check()) {
            $user = new MemberResource(Auth::guard('member')->user()->load('subscription'));
            $home = Member::HOME;
        } else if (Auth::guard('subscriber')->check()) {
            $user = new SubscriberResource(Auth::guard('subscriber')->user());
            $home = Subscriber::HOME;
        } else if (Auth::guard('volunteer')->check()) {
            $user = new VolunteerResource(Auth::guard('volunteer')->user());
            $home = Volunteer::HOME;
        }

        return array_merge(parent::share($request), [
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    base_path('lang/' . app()->getLocale() . '.json')
                );
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'error' => fn () => $request->session()->get('error')
            ],
            'authUser' => isset($auth) ? $auth : null, // Admin
            'userAuth' => isset($user) ? $user : null, // User
            'userHome' => isset($home) ? $home : null, // User
            'notifications' => $notifications
        ]);
    }


    /**
     * List shared admin permissions for viewing things in admin panel
     */
    private function adminPermissions(Admin $admin)
    {
        if (!!$admin->roles && Employee::find($admin->id)?->hasRole('Employee')) {
            $admin = Employee::find($admin->id);
        }
        return [
            'options' => $admin->can('manage', SiteOption::class),
            'roles' => $admin->can('viewAny', Role::class),
            'admins' => $admin->can('viewAny', Admin::class),
            'employees' => $admin->can('viewAny', Employee::class),
            'acceptedMembers' => $admin->can('viewAny', Member::class),
            'branchApproval' => $admin->can('viewBranch', Member::class),
            'adminApproval' => $admin->can('viewAcceptance', Member::class),
            'refusedMembers' => $admin->can('viewRefused', Member::class),
            'statsMembers' => $admin->can('export', Member::class),
            'subscribers' => $admin->can('viewAny', Subscriber::class),
            'volunteers' => $admin->can('viewAny', Volunteer::class),
            'invoices' =>  $admin->can('viewAny', Invoice::class),
            'transactions' =>  $admin->can('viewAny', Transaction::class),
            'transfers' =>  $admin->can('viewAny', MembershipTransfer::class),
            // Technical support
            'support_members' =>  $admin->can('viewMembers', TechnicalSupportTicket::class),
            'support_subscribers' =>  $admin->can('viewSubscribers', TechnicalSupportTicket::class),
            'support_volunteers' =>  $admin->can('viewVolunteers', TechnicalSupportTicket::class),
            // Courses
            'courses' =>  $admin->can('viewAny', Course::class),
            'templates' =>  $admin->can('viewAny', Template::class),
            'questionnaires' =>  $admin->can('viewAny', Questionnaire::class),
            'categories' =>  $admin->can('viewAny', Category::class),

            'pages' =>  $admin->can('viewAny', Page::class),
            'articles' =>  $admin->can('viewAny', Article::class),
            'ads' =>  $admin->can('viewAny', Ad::class),
            'urls' =>  $admin->can('viewAny', Url::class),
            'studio' =>  $admin->can('viewAny', Media::class),
            'invitations' =>  $admin->can('viewAny', Invitation::class),
            'training_bag' =>  $admin->can('viewAny', TrainingBag::class),
            'competitions' =>  $admin->can('viewAny', Competition::class),
            'candidates' =>  $admin->can('viewAny', Candidate::class),
        ];
    }
}
