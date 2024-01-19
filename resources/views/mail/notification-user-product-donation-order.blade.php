<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice Email Template </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        margin: 0;
        padding: 0;
        background: #e1e1e1;
    }

    div,
    p,
    a,
    li,
    td {
        -webkit-text-size-adjust: none;
    }

    .ReadMsgBody {
        width: 100%;
        background-color: #ffffff;
    }

    .ExternalClass {
        width: 100%;
        background-color: #ffffff;
    }

    body {
        width: 100%;
        height: 100%;
        background-color: #e1e1e1;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
    }

    html {
        width: 100%;
    }

    p {
        padding: 0 !important;
        margin-top: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0 !important;
    }

    .visibleMobile {
        display: none;
    }

    .hiddenMobile {
        display: block;
    }

    @media only screen and (max-width: 600px) {
        body {
            width: auto !important;
        }

        table[class=fullTable] {
            width: 96% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 45% !important;
        }

        .erase {
            display: none;
        }
    }

    @media only screen and (max-width: 540px) {
        table[class=fullTable] {
            width: 100% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 100% !important;
            clear: both;
        }

        table[class=col] td {
            text-align: left !important;
        }

        .erase {
            display: none;
            font-size: 0;
            max-height: 0;
            line-height: 0;
            padding: 0;
        }

        .visibleMobile {
            display: block !important;
        }

        .hiddenMobile {
            display: none !important;
        }
    }
</style>

<!-- Header -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tr>
        <td height="20"></td>
    </tr>
    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>

                <tr>
                    <td>
                        <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="260" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                                            <tbody>
                                                <tr>
                                                    <td align="left">
                                                        <img src="{{ false ? url('/storage/settings/company-logo/' . $setting->company_logo) : 'https://kalasahan-admin.matursoft.com/storage/settings/company-logo/company-logo-AFPO-979820.png' }}" width="100" height="100" alt="logo" border="0" />
                                                    </td>
                                                </tr>
                                                <tr class="hiddenMobile">
                                                    <td height="30"></td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                                        {{ $setting->company_name }}<br> {{ $setting->company_address }}<br> No Telp:
                                                        {{ $setting->phone_number }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="260" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                            <tbody>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 21px; color: #FF7C08; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                                                        Invoice
                                                    </td>
                                                </tr>
                                                <tr>
                                                <tr class="hiddenMobile">
                                                    <td height="30"></td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 12px; color: #FF7C08; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: right;">
                                                        <small style="color: #5b5b5b">ORDER</small> #{{ $userDonation->order_id }}<br />
                                                        <small style="color: #5b5b5b">{{ $userDonation->created_at }}</small>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- /Header -->

<!-- Billing and Shipping info -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                            <td height="30"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="260" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                                <strong>INFORMASI DONATUR</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                {{ $userDonation->full_name }}<br> No Telp:
                                                                {{ $userDonation->whatsapp_number ? $userDonation->whatsapp_number : '-' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table width="260" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                                    <tbody>
                                                        <tr class="visibleMobile">
                                                            <td height="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; text-align: right;">
                                                                <strong>INFORMASI PENGIRIMAN</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b;
                        line-height: 20px; vertical-align: top; text-align: right; ">
                                                                {{ $userDonation->full_name }}<br> {{ $userDonation->destination_province }}, {{ $userDonation->destination_city }}, {{ $userDonation->destination_district }}, {{ $userDonation->destination_village }}, {{ $userDonation->home_office_address }} {{ $userDonation->postal_code }}<br> No Telp:
                                                                {{ $userDonation->whatsapp_number }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="hiddenMobile">
                            <td height="30"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="20"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Billing and Shipping info -->

<!-- Order Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                        <tr class="hiddenMobile">
                            <td height="40"></td>
                        </tr>
                        <tr class="visibleMobile">
                            <td height="30"></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 10px 7px 0;" width="52%" align="left">
                                                Produk Donasi
                                            </th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 0 7px;" align="left">
                                                Harga
                                            </th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 0 7px; text-align: center; " align="center">
                                                Jumlah
                                            </th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000000; font-weight:
                  normal; line-height: 1; vertical-align: top; padding: 0 0 7px; text-align: right; " align="right">
                                                Subtotal
                                            </th>
                                        </tr>
                                        @foreach ($userDonation->productOrders as $productOrder)
                                            <tr>
                                                <td height="1" style="background: #e4e4e4;" colspan="4"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                                                    {{ $productOrder->product->name }}
                                                </td>
                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height:
                  18px;  vertical-align: top; padding:10px 0;">Rp{{ number_format($productOrder->price, 0, '.', '.') }}</td>
                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height:
                  18px;  vertical-align: top; padding:10px 0; text-align: center;" align="center">{{ number_format($productOrder->qty, 0, '.', '.') }}</td>
                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height:
                  18px;  vertical-align: top; padding:10px 0;" align="right"><strong>Rp{{ number_format($productOrder->price * $productOrder->qty, 0, '.', '.') }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Order Details -->

<!-- Total -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>

                                <!-- Table Total -->
                                <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Subtotal
                                            </td>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;" width="80">
                                                Rp{{ number_format($userDonation->total, 0, '.', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Admin Bank
                                            </td>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Rp{{ number_format(4400, 0, '.', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Total</strong>
                                            </td>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Rp{{ number_format($userDonation->total + 4400, 0, '.', '.') }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /Table Total -->

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- /Total -->

<!-- Footer -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                <tr>
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>
                <td>
                    <table width="540" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                        <tbody>
                            <tr>
                                <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                    Terima Kasih <strong>{{ $userDonation->full_name }},</strong> <br> Atas donasi Anda yang luar biasa. Dengan kontribusi Anda, kita dapat memberikan bantuan yang sangat dibutuhkan kepada anak-anak yang terkena dampak konflik di Gaza. Semoga kebaikan ini membawa harapan dan pemulihan bagi mereka.
                                    <br>Terima kasih telah menjadi bagian dari upaya kemanusiaan ini. <br><br>

                                    <br><br>Hormat Kami,
                                    <br>{{ $setting->company_name }}. <br> <br>
                                    Email: {{ $setting->company_email }}.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
    </tr>
    <tr class="spacer">
        <td height="50"></td>
    </tr>

</table>
</td>
</tr>
<tr>
    <td height="20"></td>
</tr>
</table>
<!--/ Footer -->
