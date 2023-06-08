<!DOCTYPE html>
<html dir="rtl">

<head>
    <title>{{ __('Members') }}</title>
    <style>
        body {
            text-align: center;
            font-family: 'almarai', sans-serif;
            font-size: 15px;
        }

        .title {
            top: 108px;
            right: 615px;
            font-weight: bold;
            font-size: 28px;
            position: absolute;
            color: green
        }

        .table {
            padding: 200px 30px 0;
            text-align: center;
            z-index: 9;
        }
    </style>
</head>

<body>

    <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0; z-index: -1;">
        <img src="{{ asset('/img/members-export-template.png') }}"style="width: 210mm; height: 297mm; margin: 0;">
    </div>

    <div class="title">{{ $type }}</div>
    <div class="table">
        <table cellpadding="0" cellspacing="0" width="640" align="center" border="1">
            <tr style="background: #a4ce4c;">
                <th height="48" style="padding: 8px 11px;">م</th>
                <th height="48" style="padding: 8px 11px;">اسم العضو</th>
                <th height="48" style="padding: 8px 11px;">البريد الإلكتروني</th>
                <th height="48" style="padding: 8px 11px;">رقم الجوال</th>
                <th height="48" style="padding: 8px 11px;">المدينة</th>
                <th height="48" style="padding: 8px 11px;">الجهة</th>
                <th height="48" style="padding: 8px 11px;">الحالة</th>
            </tr>
            @foreach ($members as $k => $member)
                <tr>
                    <td height="48"
                        style="width: 40px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #d0f383">
                        {{ $member->counter }}</td>
                    <td height="48"
                        style="width: 240px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->full_name_ar }}
                    </td>
                    <td height="48"
                        style="width: 270px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->email }}
                    </td>
                    <td height="48" dir="ltr"
                        style="width: 100px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->mobile }}
                    </td>
                    <td height="48"
                        style="width: 120px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->branch?->name }}
                    </td>
                    <td height="48" dir="ltr"
                        style="width: 130px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->journalistic_employer }}
                    </td>
                    <td height="48" dir="ltr"
                        style="width: 130px; overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                        {{ $member->status() }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
