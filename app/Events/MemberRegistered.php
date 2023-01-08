<?php

namespace App\Events;

use App\Models\Member;
use Illuminate\Queue\SerializesModels;

class MemberRegistered
{
    use SerializesModels;

    /**
     * The authenticated member.
     *
     * @var \App\Models\Member
     */
    public $member;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }
}
