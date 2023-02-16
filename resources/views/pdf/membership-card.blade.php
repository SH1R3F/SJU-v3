<!DOCTYPE html>
<html>

<head>
    <title>{{ __('Membership card') }}</title>
    <style>
        body {
            text-align: center;
            font-family: 'almarai', sans-serif;
        }

        .profile-picture {
            position: absolute;
            top: 32.8mm;
            left: 14.50mm;
            width: 45.16mm;
            height: 45.08mm;
            background-size: 100% 100%;
        }

        .info {
            position: absolute;
            top: 305px;
            width: 100%;
        }

        .membership-number {
            position: absolute;
            top: 368px;
            left: 125px;
        }

        .date {
            position: absolute;
            bottom: 6px;
            color: #FFF;
            font-weight: bold;
            left: 110px;
            margin: 0;
            font-size: 11.5px;
        }

        h5 {
            margin: 0;
        }
    </style>
</head>

<body>
    <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
        <img src="{{ asset('/img/card-template.png') }}"style="width: 74mm; height: 120mm; margin: 0;">
    </div>

    <div class="profile-picture" style="background: url('{{ Storage::url($member->profile_photo) }}')"></div>

    <div class="info">
        <h5 style="margin: 9px 0 9px;">{{ $member->fullNameAr }}</h5>
        <h5>{{ $member->fullNameEn }}</h5>
    </div>
    <h5 class="membership-number">{{ $member->membership_number }}</h5>

    <h6 class="date">{{ $member->subscription->end_date->format('d/m/Y') }}</h6>
    <pagebreak />

    <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
        <img src="{{ asset('/img/card-bg.png') }}"style="width: 74mm; height: 120mm; margin: 0;">
    </div>

</body>

</html>
