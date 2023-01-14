<?php

namespace App\Http\Resources;

use App\Http\Controllers\Admin\MemberController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'national_id' => $this->national_id,
            'national_id_source' => $this->national_id_source,
            'national_id_date' => $this->national_id_date->format('Y/m/d'),
            'mobile' => $this->mobile,
            'phone_number' => $this->prepareMobileForSms(),
            'fname_ar' => $this->fname_ar,
            'sname_ar' => $this->sname_ar,
            'tname_ar' => $this->tname_ar,
            'lname_ar' => $this->lname_ar,
            'fname_en' => $this->fname_en,
            'sname_en' => $this->sname_en,
            'tname_en' => $this->tname_en,
            'lname_en' => $this->lname_en,
            'fullName' => app()->getLocale() == 'ar' ? $this->full_name_ar : $this->full_name_en,
            'fullNameAr' => $this->full_name_ar,
            'fullNameEn' => $this->full_name_en,
            'gender' => $this->gender,
            'birthday_h' => $this->birthday_h->format('Y/m/d'),
            'birthday_m' => $this->birthday_m->format('Y-m-d'),
            'nationality' => $this->nationality,
            'qualification' => $this->qualification,
            'major' => $this->major,
            'journalistic_profession' => $this->journalistic_profession,
            'journalistic_employer' => $this->journalistic_employer,
            'non_journalistic_profession' => $this->non_journalistic_profession,
            'non_journalistic_employer' => $this->non_journalistic_employer,
            'workphone' => $this->workphone,
            'workphone_ext' => $this->workphone_ext,
            'fax' => $this->fax,
            'fax_ext' => $this->fax_ext,
            'postbox' => $this->postbox,
            'postcode' => $this->postcode,
            'postcity' => $this->postcity,
            'email' => $this->email,
            'branch_id' => $this->branch_id,
            'branch' => $this->whenLoaded('branch'),
            'delivery_option' => $this->delivery_option,
            'delivery_address' => $this->delivery_address,

            'subscription' => new SubscriptionResource($this->whenLoaded('subscription')),
            'membership_number' => $this->membership_number,
            'can_pay'      => $this->canPay(),

            'newspaper_type' => $this->newspaper_type,

            'profile_photo' => $this->when($this->profile_photo, Storage::url($this->profile_photo), $this->profile_photo),
            'national_id_photo' => $this->when($this->national_id_photo, Storage::url($this->national_id_photo), $this->national_id_photo),
            'statement_photo' => $this->when($this->statement_photo, Storage::url($this->statement_photo), $this->statement_photo),
            'license_photo' => $this->when($this->license_photo, Storage::url($this->license_photo), $this->license_photo),
            'contract_photo' => $this->when($this->contract_photo, Storage::url($this->contract_photo), $this->contract_photo),

            'exp_flds_lngs' => $this->exp_flds_lngs,
            'exp_flds_lngs_complete' => $this->exp_flds_lngs_complete(),
            'status' => $this->status,
            'refusal_reason' => $this->refusal_reason === 'unsatisfy' ? __("Not fulfilling the conditions") : $this->refusal_reason,
            'created_at' => $this->created_at?->translatedFormat('l jS F Y'),

            // Authorization
            $this->merge($this->withAuthorization($request))
        ];
    }

    private function withAuthorization($request)
    {
        $action = explode('@', $request->route()->getActionName());
        $controller = $action[0];
        $method = $action[1];

        // Only for admin panel member's resource
        if ($controller === MemberController::class && in_array($method, ['index', 'branch', 'acceptance', 'refused'])) {
            return [
                'acceptable' => $request->user()->can('accept', $this->resource),
                'toggleable' => $request->user()->can('toggle', $this->resource),
                'viewable'   => $request->user()->can('view', $this->resource),
                'editable'   => $request->user()->can('update', $this->resource),
                'deleteable' => $request->user()->can('delete', $this->resource),
                'approveable' => $request->user()->can('approve', $this->resource),
                'disapproveable' => $request->user()->can('disapprove', $this->resource),
                'refuseable' => $request->user()->can('refuse', $this->resource),
            ];
        }
        return [];
    }
}
