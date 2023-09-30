<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Samudera</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h3 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: left;
        }

        #company-logo {
            float: right;
            width: 90px;
        }

        #company span {
            color: #5D6975;
            text-align: left;
            width: 100px;
            display: inline-block;
            font-size: 0.8em;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        #company {
            float: right;
            text-align: left;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            text-align: center;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        footer span {
            margin-left: 80px;
        }

        .regard {
            width: 100px;
        }
    </style>
    @php
        $img = 'data:image;base64,' . base64_encode(@file_get_contents('logosamudera.png'));
        $img1 = 'data:image;base64,' . base64_encode(@file_get_contents('regardsamudera.png'));
    @endphp
    <header class="clearfix">
        <div id="logo">
            <img src="{{ $img }}">
        </div>
        <h3>INVOICE SAMUDERA</h3>
        <div id="company">
            <div>Samudera Biru Nusantara</div>
            <div>Jl Gatot subroto Royal Living Blok RA No 7
                Pondok Jaya,<br /> Kec Sepatan, Tangerang , Banten.15520</div>
            <div>081213229477</div>
            <div><a href="mailto:info@samuderatranslator.com">info@samuderatranslator.com</a></div>
        </div>
        <div id="project">
            <div><span>Name</span> {{ $name }} </div>
            <div><span>Translation Name</span> {{ $translation }} </div>
            <div><span>Total Sheets</span> {{ $total_sheet }} </div>
            <div><span>Total Price</span> Rp. {{ number_format($total_price) }} </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Translation Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Sheets</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="service">{{ $translation }}</td>
                    <td class="unit">{{ $description }}</td>
                    <td class="qty">{{ ucfirst($type) }}</td>
                    <td class="qty">{{ $total_sheet }}</td>
                    <td class="total">Rp. {{ number_format($total_price) }}</td>
                </tr>
                <tr>
                    <td colspan="4">Tax</td>
                    <td class="total">0%</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">Rp. {{ number_format($total_price) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="clearfix" style="margin-top: -10px; text-align:end; float: right;">
            <h4 style="margin-right: 12px;">Best Regard</h4>
            <img class="regard" src="{{ $img1 }}" alt="Logo Samudera">
        </div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">Pay with the appropriate nominal and not excessive!.</div>
        </div>
    </main>
    <footer>
        <span>Invoices are generated on a computer and are valid without a signature and stamp.</span>
    </footer>
</body>

</html>
