<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        @media print {
            body {
                padding-top: 0;
            }

            #action-area {
                display: none;
            }
        }

        @media screen and (min-width: 1025px) {
            .btn-download {
                display: none !important;
            }

            .btn-back {
                display: none !important;
            }
        }

        @media screen and (max-width: 1024px) {
            .content-area>div {
                width: auto !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 720px) {
            .content-area>div {
                width: auto !important;
            }
        }

        @media screen and (max-width: 420px) {
            .content-area>div {
                width: 790px !important;
            }
        }

        @media screen and (max-width: 430px) {
            .content-area {
                transform: scale(0.59) translate(-35%, -35%)
            }

            .content-area>div {
                width: 720px !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 380px) {
            .content-area {
                transform: scale(0.45) translate(-58%, -62%);
            }

            .content-area>div {
                width: 790px !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 320px) {
            .content-area>div {
                width: 700px !important;
            }
        }
    </style>
</head>

<body style="font-family: open sans, tahoma, sans-serif; margin: 0; -webkit-print-color-adjust: exact; padding-top: 60px;">

    <div id="action-area">
        <div id="navbar-wrapper"
            style="padding: 12px 16px;font-size: 0;line-height: 1.4; box-shadow: 0 -1px 7px 0 rgba(0, 0, 0, 0.15); position: fixed; top: 0; left: 0; width: 100%; background-color: #FFF; z-index: 100;">
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px;">
                <div class="btn-back" onclick="window.close();">
                    <img src="https://ecs7.tokopedia.net/img/back-invoice.png" width="20px" alt="Back"
                        style="display: inline-block; vertical-align: middle;" />
                    <span
                        style="display: inline-block; vertical-align: middle; margin-left: 16px; font-size: 16px; font-weight: bold; color: rgba(49, 53, 59, 0.96);">Invoice</span>
                </div>
            </div>
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px; text-align: right;">
                <a class="btn-download" href="javascript:window.print()"
                    style="display: inline-block; vertical-align: middle;">
                    <img src="https://ecs7.tokopedia.net/img/download-invoice.png" alt="Download" width="20px" ; />
                </a>
                <a class="btn-print" href="javascript:window.print()"
                    style="height: 100%; display: inline-block; vertical-align: middle;">
                    <button id="print-button"
                        style="border: none; height: 100%; cursor: pointer;padding: 8px 40px;border-color: #03AC0E;border-radius: 8px;background-color: #03AC0E;margin-left: 16px;color: #fff;font-size: 12px;line-height: 1.333;font-weight: 700;">Print</button>
                </a>
            </div>
        </div>
    </div>


    <div class="content-area">
            {{-- <div style="background: url(https://ecs7.tokopedia.net/img/invoice/paid-stamp.png) center no-repeat; background-size: contain; margin: auto; width: 790px;"> --}}
            <div style="background-size: contain; margin: auto; width: 790px;">
                <table width="100%" cellspacing="0" cellpadding="0" style="width: 100%; padding: 25px 32px; color: #343030;">
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="padding-bottom: 20px; border-bottom: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 57%; vertical-align: top;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('img\logo\tes.png') }}"
                                                        alt="Sunrise Steel" style="margin-bottom: 15px; width: 147px;">
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <span style="font-weight: 800; font-size: 16px;">PT. Sunrise Steel</span>
                                                    <br>
                                                    <span style="font-size: 12px; padding-bottom: 20px;">
                                                    By Pass Km 54 Sby, Jampirogo, Sooko - Mojokerto 61361<br>
                                                    East Java - Indonesia<br>
                                                    Phone/Fax : +62 321 333833 / 332550
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>

                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 43%; vertical-align: top; padding-left: 15px;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-weight: 600; font-size: 12px;padding-bottom: 8px;">
                                                    <span>BookId</span><br>
                                                    <span>Cust.Po.Num</span><br>
                                                    <span>QuoteId</span><br>
                                                    <span>OrderId</span><br>
                                                    <span>Date</span>
                                                    <br>
                                                    <br>
                                                    <span>Payment</span>
                                                </td>
                                                <td style="font-weight: 600; font-size: 12px;padding-bottom: 8px;">
                                                    <span>:</span><br>
                                                    <span>:</span><br>
                                                    <span>:</span><br>
                                                    <span>:</span><br>
                                                    <span>:</span>
                                                    <br>
                                                    <br>
                                                    <span>:</span>
                                                </td>
                                                <td style="font-size: 12px;padding-bottom: 8px;">
                                                    <span>&nbsp;{{$bookId}}</span><br>
                                                    <span>&nbsp;{{$custPoNum}}</span><br>
                                                    <span>&nbsp;{{$quouteId}}</span><br>
                                                    <span>&nbsp;{{$orderId}}</span><br>
                                                    <span>&nbsp;{{$tr_date}}</span>
                                                    <br>
                                                    <br>
                                                    <span>&nbsp;{{$payment}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <table width="100%" cellspacing="0" cellpadding="0"
                                    style="padding-bottom: 20px; border-bottom: thin dashed #cccccc;">
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding: 8px 0;">
                                                Bill To:
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td style="font-size: 12px; font-weight: 600; padding: 8px 0;">
                                                Shipping To:
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                Buyer
                                            </td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$buyer}}
                                            </td>
                                            <td></td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$shipto}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                NPWP
                                            </td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$npwp}}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                Attn
                                            </td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$attn}}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                Address
                                            </td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$address}}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                Phone/Fax
                                            </td>
                                            <td style="font-size: 12px; padding-bottom: 6px;">
                                                {{$phone}}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </tr>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; padding: 25px 32px;">
                                <tr
                                    style="background-color: rgba(242, 242, 242, 0.74); font-size: 12px; font-weight: 600;">
                                    <td style="padding: 10px 15px;">Item Descr</td>
                                    <td style="padding: 10px 15px; text-align: center;">Weight</td>
                                    <td style="padding: 10px 15px; text-align: center;">Unit Price</td>
                                    <td style="padding: 10px 15px; text-align: center;">Subtotal</td>
                                </tr>


                                <!-- Item List -->
                                @foreach($detail as $a)
                                <tr style="font-size: 12px;">
                                    <td width="400" style="padding: 15px; font-weight: 600; word-break: break-word;">
                                        {{ $a->descr }}
                                        @if (($a->remark))
                                        <div style="margin: 1px 0 0; font-size: 10px; font-weight: 100; display: block">
                                            {{ "Remark: ".$a->remark }}
                                        </div>
                                        @else
                                        <div style="margin: 1px 0 0; font-size: 10px; font-weight: 100; display: none">
                                        </div>
                                        @endif
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center;">
                                        {{ number_format($a->wgt,0,',','.')."KG" }}
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center; white-space: nowrap;">
                                        {{ "IDR " . number_format($a->unit_price,2,',','.')}}
                                    </td>
                                    <td valign="top" style="padding: 15px; white-space: nowrap; text-align: center;">
                                        {{ "IDR " . number_format($a->amt_net,2,',','.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="padding: 0 15px;">
                                        <div style="border-bottom: thin solid #e0e0e0"></div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- End Item List -->

                                <tr>
                                    <td></td>
                                    <td colspan="4">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                            style="padding-right: 15px; font-size: 12px; font-weight: 600;">
                                            {{-- <tr>
                                                <td colspan="2">
                                                    <div style="border-bottom: thin solid #e0e0e0"></div>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td style="padding: 15px;">Subtotal</td>
                                                <td style="padding: 15px 0 15px 15px; text-align: right;">
                                                    {{ "IDR " . number_format($amt_net,2,',','.')}}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- refactor div float left and right in case order is kelontong -->
                    <tr>
                        <td>
                            {{-- <div id="container_invoice_qr" style="float:left; margin-top:-5px; padding: 5px; width: 335px">
                                <span style="font-size :9px; font-weight: bold;">NOTES:</span><br>
                                <span style="font-size :9px;">
                                    - Prices are franco Tangerang, Includes slitting, Inc. VAT 10 %<br>
                                    - Delivery Order: 4th week of Jan, 2018- Term Of Payment   : Cash Before Delivery<br>
                                    - Quantity Tolerance : 20 % per item and 10 % per total item<br>
                                    - Please kindly fax Quotation document after signed to PT.SUNRISE STEEL+62 31-5019987 and Down Payment receipt<br>
                                    - Original invoice and tax receipt will be delivered after the payment are fullyreceived in PT. Sunrise-Steel account<br>
                                    - Validity          :   2 days<br>
                                    # Expired date for this  Quotation 90 days with all conditions #<br>
                                    # In case, seller didn't receive the payment within 90 days after due dateseller is entitled to take the goods #
                                </span>
                            </div> --}}

                            <div style="float:right; margin-top:-5px;">
                                <table>
                                    <!-- subtotal ongkir -->
                                    <tr>
                                        <td>
                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="width: 50%;"></td>
                                                    <td style="width: 50%;">
                                                        @if(isset($check))
                                                        @if($check == "T")
                                                        <table width="100%"
                                                            style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; border: thin dashed #cccccc; font-size: 12px; font-weight: 600;">
                                                            <tr style="font-weight: normal; font-size: 12px;">
                                                                <td style="padding-bottom: 10px;">
                                                                    V.A.T
                                                                </td>
                                                                <td
                                                                    style="padding-bottom: 10px;text-align: right; white-space: nowrap; vertical-align: top;">
                                                                    10%</td>
                                                            </tr>
                                                            <!-- show this in invoice section subtotal ongkos kirim -->

                                                            <tr>
                                                                <td
                                                                    style="border-top: thin solid #e0e0e0; padding-top: 10px;">
                                                                    Tax Amount</td>
                                                                <td
                                                                    style="border-top: thin solid #e0e0e0; padding-top: 10px; text-align: right; white-space: nowrap;">
                                                                    {{ "IDR " . number_format(((10/100)*$amt_net),2,',','.')}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- subtotal biaya lain -->


                                    <!-- total belanja -->


                                    <!-- subtotal nilai tukar tambah -->



                    <!-- subtotal nilai promo -->


                    <!-- total invoice -->
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="width: 50%;"></td>
                                    <td style="width: 50%;">
                                        <table width="100%"
                                            style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; border: thin solid rgba(0, 0, 0, 0.54); font-size: 12px; font-weight: 600;">
                                            <tr>
                                                <td>Total</td>
                                                <td style="text-align: right;">
                                                    @if(isset($check))
                                                        @if($check == "T")
                                                        {{ "IDR " . number_format((((10/100)*$amt_net)+$amt_net),2,',','.')}}</td>
                                                        @else
                                                        {{ "IDR " . number_format($amt_net,2,',','.')}}</td>
                                                        @endif
                                                    @else
                                                    {{ "IDR " . number_format($amt_net,2,',','.')}}</td>
                                                    @endif
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Keterangan -->

                </table>
            </div>
            </td>
            </tr>
            </table>
        </div>
    </div>

<script type="text/javascript" >var _cf = _cf || []; _cf.push(['_setFsp', true]);  _cf.push(['_setBm', true]); _cf.push(['_setAu', '/assets/31d6ac86158b5d209c8a1b8205d6']); </script><script type="text/javascript"  src="/assets/31d6ac86158b5d209c8a1b8205d6"></script></body>

<script src="https://cdn.tokopedia.net/built/d1dd3126ee9ae2b8381ed123ca34b2a2.js" type="text/javascript"></script>
<script src="https://cdn.tokopedia.net/built/6b42e5043225d4bd57fb1d885f07b835.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (event) {

        var qrcode = new QRCode("invoice_qr", {
            text: "",
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        $('#invoice_qr').on('contextmenu', 'img', function (e) {
            return false;
        });
    });
</script>

</html>
