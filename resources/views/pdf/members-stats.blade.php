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

        .table {
            padding: 180px 30px 0;
            text-align: center;
            z-index: 9;
        }

        table {
            margin: 30px 0;
        }
    </style>
</head>

<body>

    <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0; z-index: -1;">
        <img src="{{ asset('/img/members-stats-export-template.png') }}"style="width: 210mm; height: 297mm; margin: 0;">
    </div>

    <div class="table">
        <table cellpadding="0" cellspacing="0" width="640" align="center" border="1">
            <tr style="background: #62963e;">
                <th height="45" style="padding: 8px 11px;" colspan="2">الأعضاء الحاليين</th>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المتفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$fulltime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المتفرغين بإنتظار الدفع
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$ft_waiting}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    الغير متفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$parttime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    الغير متفرغين بإنتظار الدفع
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$pt_waiting}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المنتسبين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$affiliate}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المنتسبين بإنتظار الدفع
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$af_waiting}}
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" width="640" align="center" border="1">
            <tr style="background: #62963e;">
                <th height="45" style="padding: 8px 11px;" colspan="2">بإنتظار موافقة الفروع</th>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المتفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$branch_waitlist_fulltime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    الغير متفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$branch_waitlist_parttime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المنتسبين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$branch_waitlist_affiliate}}
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" width="640" align="center" border="1">
            <tr style="background: #62963e;">
                <th height="45" style="padding: 8px 11px;" colspan="2">بإنتظار الموافقة النهائية</th>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المتفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$admin_waitlist_fulltime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    الغير متفرغين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$admin_waitlist_parttime}}
                </td>
            </tr>
            <tr>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #a7d08c">
                    المنتسبين
                </td>
                <td height="45"
                    style="overflow-wrap: break-word; text-align:center; padding: 8px 11px; background: #FFF;">
                    {{$admin_waitlist_affiliate}}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
