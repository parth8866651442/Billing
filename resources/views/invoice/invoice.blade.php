<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
    <style>
        .watermark {
            /* Used to position the watermark */
            position: relative;
            /* height:297mm; */
            width:210mm;
            margin-left: auto;
            margin-right: auto;
            z-index: 0;
        }

        .watermark__inner {
            /* Center the content */
            align-items: center;
            display: flex;
            justify-content: center;

            /* Absolute position */
            left: 0px;
            position: absolute;
            top: 0px;

            /* Take full size */
            height: 100%;
            width: 100%;
        }
        .watermark__body {
            /* Text color */
            color: rgba(0, 0, 0, 0.1);

            /* Text styles */
            font-size: 5rem;
            font-weight: bold;
            text-transform: uppercase;

            /* Rotate the text */
            transform: rotate(-45deg);

            /* Disable the selection */
            user-select: none;
        }
        .corner-ribbon__inner {
            /* Displayed at the top left corner */
            right: 0px;
            position: absolute;
            top: 0px;

            /* Size */
            height: 5rem;
            width: 5rem;

            /* Hide the part of its children which is displayed outside */
            overflow: hidden;
            z-index: 0;
        }
        .corner-ribbon__ribbon {
            /* Position */
            right: 1rem;
            position: absolute;
            top: 1rem;

            /* Size */
            height: 1.5rem;
            width: 110px;

            /* Displayed diagonally */
            /* transform: translate(-38px, -8px) rotate(-45deg); */
            transform: translate(45px, -1px) rotate(45deg);

            /* Background color */
            background-color: #d1d5db;

            /* Centerize the text content */
            text-align: center;
        }

        .ribbon {
            /* Center the content */
            display: inline-flex;
            align-items: center;
            justify-content: center;

            /* Size */
            height: 2rem;
            /* width: 10rem; */
            width: auto;

            /* Use to position the corners */
            position: relative;
            max-width: 260px;
        }

        .ribbon__content {
            /* Background color */
            background-color: #9ca3af;
            z-index: 1;

            height: 100%;
            width: 100%;
            text-align: center;
        }
        .ribbon__content span{
            vertical-align: -webkit-baseline-middle;
            padding: 5px;
            font-size: small;
            font-weight: 600;
        }
        .ribbon__side {
            bottom: -0.5rem;
            position: absolute;

            /* Displayed under the ribbon */
            z-index: 1;

            /* Background */
            border: 1rem solid #d1d5db;
        }

        .ribbon__side--l {
            /* Position */
            left: -1.5rem;
            border-color: #d1d5db #d1d5db #d1d5db transparent;
        }

        .ribbon__side--r {
            /* Position */
            right: -1.5rem;
            border-color: #d1d5db transparent #d1d5db #d1d5db;
        }

        .ribbon__triangle {
            position: absolute;
            top: 100%;

            border: 0.5rem solid transparent;
            border-bottom-width: 0;
            border-top-color: #6b7280;
            z-index: 1;
        }

        .ribbon__triangle--l {
            border-right-width: 0;
            left: 0;
        }

        .ribbon__triangle--r {
            border-left-width: 0;
            right: 0;
            z-index: 2;
        }
    </style>
</head>

<body>
@foreach($orders->orderItemsDetail as $i => $orderitems)
<div class="watermark">
    <!-- Watermark container -->
    <div class="watermark__inner">
        <!-- The watermark -->
        <div class="watermark__body">{{isset($settings->prefix_name_invoice) ? $settings->prefix_name_invoice : ''}}</div>
    </div>

    <div class="corner-ribbon__inner">
        <!-- The ribbon -->  <!-- estimate duplicate -->
        <div class="corner-ribbon__ribbon">Original</div>
    </div>

    <!-- Other content -->
    <table style="box-sizing: border-box; border: 1px solid #c8c8c8; position: relative; z-index: 1;" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td colspan="2">
          <table width="100%">
                <tr colspan="2">
                    <td width="33%"><img src="{{ imageUrl(isset($settings->logo_img) ? $settings->logo_img : '', 'setting','no_image.jpg','thumbnail') }}" width="219" height="60" /></td>
                    <td>
                        <div class="ribbon">
                            <!-- The left side -->
                            <div class="ribbon__side ribbon__side--l"></div>

                            <!-- The left triangle displayed below the content -->
                            <div class="ribbon__triangle ribbon__triangle--l"></div>

                            <!-- The right triangle displayed below the content -->
                            <div class="ribbon__triangle ribbon__triangle--r"></div>

                            <!-- The right side -->
                            <div class="ribbon__side ribbon__side--r"></div>

                            <!-- The content -->
                            <div class="ribbon__content">
                                <span>{{isset($settings->company_name) ? $settings->company_name : ''}}</span>
                            </div>
                        </div>
                    </td>
                    <td width="34%" style="padding: 10px; font-family: Verdana, Geneva, sans-serif; font-size: 13px;">
                        Phone No: +91 {{isset($settings->phone_no) ? $settings->phone_no : ''}} <br />
                        Email: {{isset($settings->email_id) ? $settings->email_id : ''}} <br />
                       Address: {{isset($settings->address) ? $settings->address : ''}}
                    </td>
                </tr>
            </table>
      </td>  
      </tr>
      <tr>
        <td height="31" colspan="2" style="padding-left: 10px; font-size: 20px; font-family: Verdana, Geneva, sans-serif;">
          <strong>INVOICE</strong>
        </td>
      </tr>
      <tr>
        <td width="61%" height="28">
          <table style=" box-sizing: border-box; border: 1px solid #c8c8c8; margin: 10px;" width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" height="25" style="padding-left: 10px; font-family: Verdana, Geneva, sans-serif; border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; font-size: 14px;">
                <strong>Name </strong>
              </td>
              <td width="75%" style="padding-left: 10px; font-family: Verdana, Geneva, sans-serif; border-bottom: 1px solid #c8c8c8; font-size: 14px;">
                Demo Name
              </td>
            </tr>
            <tr>
              <td height="25" style="padding-left: 10px; font-family: Verdana, Geneva, sans-serif; border-right: 1px solid #c8c8c8; font-size: 14px;">
                <strong>Address</strong>
              </td>
              <td style=" padding-left: 10px; font-family: Verdana, Geneva, sans-serif; font-size: 14px;">
                Lucknow, India
              </td>
            </tr>

            <tr>
              <td height="25" style="padding-left: 10px; font-family: Verdana, Geneva, sans-serif; border-right: 1px solid #c8c8c8; border-top: 1px solid #c8c8c8; font-size: 14px;">
                <strong>Mobile</strong>
              </td>
              <td style="padding-left: 10px; font-family: Verdana, Geneva, sans-serif; border-top: 1px solid #c8c8c8; font-size: 14px;">
                +91-88888888888
              </td>
            </tr>
          </table>
        </td>
        <td width="39%" align="right">
          <table style="box-sizing: border-box; border: 1px solid #c8c8c8; margin: 10px;" width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" align="right" style="padding-right: 10px; font-family: Verdana, Geneva, sans-serif; border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; font-size: 14px;">
                <strong>Order ID</strong> : #3DRT567
              </td>
            </tr>
            <tr>
              <td height="25" align="right" style="padding-right: 10px; font-family: Verdana, Geneva, sans-serif; border-right: 1px solid #c8c8c8; font-size: 14px;">
                <strong>Reciept No</strong> : #5674DFTRG
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td height="28" colspan="2"> </td>
      </tr>
      <tr>
        <td style="padding: 10px" height="28" colspan="2">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                <td width="22%" align="center" style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-top: #c8c8c8 1px solid; font-family: Verdana, Geneva, sans-serif; font-size: 13px;">
                    <strong>Item Description </strong>
                </td>
                <td width="26%" align="center" style=" border-bottom: 1px solid #c8c8c8;  border-right: 1px solid #c8c8c8; border-top: #c8c8c8 1px solid; font-family: Verdana, Geneva, sans-serif; font-size: 13px;">
                    <strong>Price</strong>
                </td>
                <td width="20%" align="center" style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-top: #c8c8c8 1px solid; font-family: Verdana, Geneva, sans-serif; font-size: 13px;">
                    <strong>Quantity</strong>
                </td>
                <td width="19%" align="center" style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-top: #c8c8c8 1px solid; font-family: Verdana, Geneva, sans-serif; font-size: 13px;">
                    <strong>Amount</strong>
                </td>
                </tr>
            </tbody>
            @foreach($orderitems as $key => $orderItem)
                <tr>
                <td style="border-bottom: 1px solid #c8c8c8;border-right: 1px solid #c8c8c8;" align="center">
                    {{$orderItem['product_id']}}
                </td>
                <td style="border-bottom: 1px solid #c8c8c8;border-right: 1px solid #c8c8c8;" align="center">
                    {{$orderItem['price']}}
                </td>
                <td style="border-bottom: 1px solid #c8c8c8;border-right: 1px solid #c8c8c8;" align="center">
                    {{$orderItem['qty']}}
                </td>
                <td style="border-bottom: 1px solid #c8c8c8;border-right: 1px solid #c8c8c8;" align="center">
                    {{$orderItem['amount']}}
                </td>
                </tr>
            @endforeach
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px" height="28" style="font-family: Verdana, Geneva, sans-serif; font-size: 13px">
          <strong>Bank Detail</strong> <br />
          {{isset($settings->bd_holdare_name) ? $settings->bd_holdare_name : ''}} {{isset($settings->bd_bank_name) ? '('.$settings->bd_bank_name.')' : ''}} <br />
          Account No : {{isset($settings->bd_account_no) ? $settings->bd_account_no : ''}} <br />
          IFSC Code : {{isset($settings->bd_ifsc_code) ? $settings->bd_ifsc_code : ''}}
          
        </td>
        <td style="padding: 10px" height="28">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-top: 1px solid #c8c8c8; border-left: 1px solid #c8c8c8; font-family: Verdana, Geneva, sans-serif; font-size: 13px; padding-left: 10px;" width="51%" height="29">
                <strong>Total Amount</strong>
              </td>
              <td width="49%" align="center" style=" border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-top: 1px solid #c8c8c8;">
                6000
              </td>
            </tr>
            <tr>
              <td style=" border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-left: 1px solid #c8c8c8; font-family: Verdana, Geneva, sans-serif; font-size: 13px; padding-left: 10px;" height="29">
                <strong>GST </strong>
              </td>
              <td align="center" style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8;">
                200
              </td>
            </tr>
            <tr>
              <td style=" border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-left: 1px solid #c8c8c8; font-family: Verdana, Geneva, sans-serif; font-size: 13px; padding-left: 10px;" height="29">
                <strong>Total Amount</strong>
              </td>
              <td align="center" style="border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8;">
                6200
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px" height="28" colspan="2" style="font-family: Verdana, Geneva, sans-serif; font-size: 13px">
          <strong>Add Terms & Conditions</strong> <br />
          {{isset($settings->terms_conditions) ? $settings->terms_conditions : ''}}
        </td>
      </tr>
    </table>
</div>
@endforeach
</body>

</html>