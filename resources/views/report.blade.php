<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Biaya | PCC</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #8BC34A;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>NAMA TOKO</h3>
                <pre>
                    Tanggal:  {{ date('d-m-Y') }}

                    Pukul: {{ date('H:i:s') }}
                </pre>
            </td>
            <td align="center">
                <img src="{{ asset('images/user-img-background.jpg') }}" alt="Logo" width="64" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">
                <h3>{{ strtoupper(Auth::user()->name) }} | PCC</h3>
                <pre>
                    Production Cost Counter

                    &copy; {{ date('Y') }} - All rights reserved.
                </pre>
            </td>
        </tr>
    </table>
</div>

<br/>

<div class="invoice">
    <h3>Invoice specification #123</h3>
    <table width="100%">
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Item 1</td>
            <td>1</td>
            <td align="left">€15,-</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="left">Total</td>
            <td align="left" class="gray">€15,-</td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
