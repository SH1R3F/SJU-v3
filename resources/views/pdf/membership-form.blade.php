<!DOCTYPE html>
<html dir="rtl">

<head>
    <title>{{ __('Membership form') }}</title>
    <style>
        @page {
            background: url("{{ asset('/img/form-template.png') }}") no-repeat 0 0;
            background-image-resize: 6;
        }

        body {
            text-align: center;
            font-family: 'almarai', sans-serif;
        }

        .photo {
            position: absolute;
            top: 156px;
            left: 72px;
            width: 101px;
            height: 120px;
            background-size: 100% 100%;
        }

        .num {
            position: absolute;
            top: 153px;
            font-size: 21px;
            text-align: center;
            font-weight: bold;
        }

        .num-1 {
            left: 245px;
        }

        .num-2 {
            left: 287px;
        }

        .num-3 {
            left: 317px;
        }

        .num-4 {
            left: 348px;
        }

        .num-5 {
            left: 379px;
        }

        .name-ar {
            top: 218px;
            right: 59px;
            font-size: 18px;
            position: absolute;
        }

        table.name-table {
            border-spacing: 7px;
        }

        td.name {
            width: 124px;
            text-align: center;
            font-weight: bold;
        }

        .name-en {
            top: 232px;
            left: 242px;
            font-size: 18px;
            position: absolute;
        }

        .line-3 {
            position: absolute;
            top: 281px;
            font-size: 18px;
            font-weight: bold;
        }

        .nat {
            font-size: 17px;
            right: 120px;
        }

        .birthday-h {
            position: absolute;
            top: 287px;
            font-size: 14px;
            right: 503px;
            font-weight: bold;
        }

        .birthday-m {
            position: absolute;
            top: 287px;
            font-size: 14px;
            right: 646px;
            font-weight: bold;
        }

        .id {
            position: absolute;
            top: 310px;
            font-size: 14px;
            right: 253px;
            font-weight: bold;
        }

        .source {
            position: absolute;
            top: 310px;
            font-size: 14px;
            right: 450px;
            font-weight: bold;
        }

        .date {
            position: absolute;
            top: 312px;
            font-size: 14px;
            right: 633px;
            font-weight: bold;
        }

        .title {
            position: absolute;
            top: 334px;
            font-size: 14px;
            right: 198px;
            font-weight: bold;
        }

        .employer {
            position: absolute;
            top: 334px;
            font-size: 12px;
            right: 315px;
            width: 110px;
        }

        .non-title {
            position: absolute;
            top: 336px;
            font-size: 14px;
            right: 590px;
            font-weight: bold;
            width: auto;
        }

        .non-employer {
            position: absolute;
            top: 336px;
            font-size: 12px;
            right: 688px;
            width: auto;
        }

        .type {
            position: absolute;
            top: 358px;
            font-size: 16px;
            font-weight: bold;
            width: auto;
        }

        .workphone {
            position: absolute;
            top: 387px;
            right: 124px;
            font-size: 14px;
            font-weight: bold;
            width: 125px;
            text-align: center;
        }

        .workphone-ext {
            position: absolute;
            top: 387px;
            width: 57px;
            text-align: center;
            right: 290px;
            font-size: 13px;
            white-space: nowrap;
        }

        .mobile {
            position: absolute;
            top: 387px;
            width: 124px;
            text-align: center;
            right: 390px;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
        }

        .fax {
            position: absolute;
            top: 410px;
            right: 110px;
            font-size: 14px;
            font-weight: bold;
            width: 135px;
            text-align: center;
        }

        .fax-ext {
            position: absolute;
            top: 410px;
            width: 57px;
            text-align: center;
            right: 290px;
            font-size: 13px;
            white-space: nowrap;
        }

        .postbox {
            position: absolute;
            top: 435px;
            right: 195px;
            width: 62px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .postcode {
            position: absolute;
            top: 435px;
            right: 333px;
            width: 59px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .postcity {
            position: absolute;
            top: 435px;
            right: 445px;
            width: 66px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .email {
            position: absolute;
            top: 480px;
            left: 75px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .experiences {
            position: absolute;
            top: 503px;
            right: 200px;
            width: 520px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .qualification {
            position: absolute;
            top: 592px;
            right: 160px;
            width: 235px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .major {
            position: absolute;
            top: 592px;
            right: 460px;
            width: 255px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .fields {
            position: absolute;
            top: 613px;
            right: 295px;
            width: 425px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .languages {
            position: absolute;
            top: 635px;
            right: 148px;
            width: 570px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- Profile Picture --}}
    <div class="photo" style="background: url('{{ Storage::url($member->profile_photo) }}')"></div>
    {{-- Profile Picture --}}

    @if ($member->membership_number)
        <div class="num num-1">{{ $member->membership_number[0] }}</div>
        <div class="num num-2">{{ $member->membership_number[2] }}</div>
        <div class="num num-3">{{ $member->membership_number[3] }}</div>
        <div class="num num-4">{{ $member->membership_number[4] }}</div>
        <div class="num num-5">{{ $member->membership_number[5] }}</div>
    @endif

    {{-- Arabic Name --}}
    <div class="name-ar">
        <table class="name-table">
            <tr>
                <td class="name">{{ $member->fname_ar }}</td>
                <td class="name">{{ $member->sname_ar }}</td>
                <td class="name">{{ $member->tname_ar }}</td>
                <td class="name">{{ $member->lname_ar }}</td>
            </tr>
        </table>
    </div>
    {{-- Arabic Name --}}

    {{-- English Name --}}
    <h5 class="name-en">{{ $member->full_name_en }}</h5>
    {{-- English Name --}}

    {{-- line 3 --}}
    <div class="line-3 nat">{{ __(config('sju.nationalities')[$member->nationality], [], 'ar') }}</div>
    <div class="line-3" style="right: {{ $member->gender ? '365px' : '297px' }}">x</div>
    <div class="birthday-h">{{ $member->birthday_h->format('Y/m/d') }}</div>
    <div class="birthday-m">{{ $member->birthday_m->format('Y/m/d') }}</div>

    {{-- line 4 --}}
    <div class="id">{{ $member->national_id }}</div>
    <div class="source">{{ $member->national_id_source }}</div>
    <div class="date">{{ $member->national_id_date->format('Y/m/d') }}</div>

    {{-- line 5 --}}
    <div class="title">{{ $member->journalistic_profession }}</div>
    <div class="employer">{{ $member->journalistic_employer }}</div>
    <div class="non-title">{{ $member->non_journalistic_profession }}</div>
    <div class="non-employer">{{ $member->journalistic_employer }}</div>

    {{-- Subscription type --}}
    <div class="type"
        style="right: {{ $member->subscription->type == 1 ? '72px' : ($member->subscription->type == 2 ? '166px' : '268px') }}">
        x
    </div>

    {{-- line 7 --}}
    <div class="workphone">{{ $member->workphone }}</div>
    <div class="workphone-ext">{{ $member->workphone_ext }} </div>
    <div class="mobile">{{ $member->mobile }} </div>

    {{-- line 8 --}}
    <div class="fax">{{ $member->fax }}</div>
    <div class="fax-ext">{{ $member->fax_ext }} </div>

    {{-- line 9 --}}
    <div class="postbox">{{ $member->postbox }}</div>
    <div class="postcode">{{ $member->postcode }} </div>
    <div class="postcity">{{ $member->postcity }} </div>

    {{-- line 10 --}}
    <div class="email" dir="ltr">{{ $member->email }} </div>

    {{-- line 11 --}}
    @if ($member->exp_flds_lngs && in_array('experiences', $member->exp_flds_lngs))
        <div class="experiences">
            @foreach ($member->exp_flds_lngs['experiences'] as $exp)
                {{ $exp['title'] }}: {{ $exp['years'] }},
            @endforeach
        </div>
    @endif

    {{-- line 12 --}}
    <div class="qualification">{{ $member->qualification }} </div>
    <div class="major">{{ $member->major }} </div>

    {{-- line 13 --}}
    @if ($member->exp_flds_lngs && in_array('fields', $member->exp_flds_lngs))
        <div class="fields">
            @foreach ($member->exp_flds_lngs['fields'] as $fld)
                {{ $fld['title'] }},
            @endforeach
        </div>
    @endif

    {{-- line 14 --}}
    @if ($member->exp_flds_lngs && in_array('languages', $member->exp_flds_lngs))
        <div class="languages">
            @foreach ($member->exp_flds_lngs['languages'] as $lng)
                {{ $lng['title'] }}: {{ $lng['level'] }},
            @endforeach
        </div>
    @endif

</body>

</html>
