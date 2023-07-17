<html>

<head>

    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: Helvetica, Sans-Serif;
        }

        .test {
            line-height: 5px;
        }

        .content {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .title-laporan {
            line-height: 0px;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        h3 {
            line-height: 0px;
        }

        p {
            font-size: 15px;
        }

        hr {
            position: relative;
            border: none;
            height: 3px;
            background: black;
        }

        .data {
            border-collapse: collapse;
            width: 100%;

            font-size: 10px;
        }

        .data td,
        .data th {
            border: 0.6mm solid #000000;
            padding: 3px;
        }

        #customers td,
        #customers th {
            border: 1px solid #fff;
            padding: 8px;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #555555;
            color: white;
        }

        .footer {
            margin: 50px;
            font-weight: bold;
            font-size: 14px;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /** Extra personal styles **/
            background-color: #eaeaea;
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }

        .tableFooter {
            width: 100%;
            font-size: 13px;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <main>
        <div class="header">
            <table width='100%' padding=0>
                <tr>
                    <td align="center">
                        <div style="margin-top:20px;">
                            <h2 class="test">Njenggrik Coffee</h2>
                            <p class="test">Jl. Cianjur No.5, Penanggungan,</p>
                            <p class="test">Telp :
                                08123456789
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr size='7' />
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <div class="title-laporan">
                <h3>Laporan Transaksi</h3>
                <p>Tanggal 01-07-2023 s/d 31-07-2023</p>
            </div>
            <table class="data">
                <tr>
                    <th width="30px">No</th>
                    <th width="90px">No Transaksi</th>
                    <th width="80px">Tgl</th>
                    <th width="80px"> No Meja</th>
                    <th width="100px">Total</th>
                    <th width="100px">Cara Pembayaran</th>
                    <th width="100px">Otorisasi</th>
                </tr>
                <?php $n = 0; ?>
                @foreach ($data as $value)
                    <?php $n++; ?>
                    <tr>
                        <td align="center">{{ $n }}</td>
                        <td align="center">{{ $value['no_transaksi'] }}</td>
                        <td align="center">{{ date('d-m-Y', strtotime($value['tgl_transaksi'])) }}</td>
                        <td>{{ $value['no_meja'] }}</td>
                        <td align="right">{{ number_format($value['total']) }}</td>
                        <td>{{ $value['cara_pembayaran'] }}
                        </td>
                        <td>
                            @if ($value['status_pembayaran'] == 0)
                                Menunggu Otorisasi
                            @elseif ($value['status_pembayaran'] == 1)
                                Disetujui
                            @else
                                Ditolak
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="6" align="center">
                            <table id="customers">
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Notes</th>
                                </tr>
                                @foreach ($value['detail'] as $value1)
                                    <tr>
                                        <td>{{ $menu[$value1['id_menu']]['name'] }}</td>
                                        <td>{{ $value1['qty'] }}</td>
                                        <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}
                                        </td>
                                        <td>{{ number_format($value1['total']) }}</td>
                                        <td>{{ $value1['notes'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </main>

</body>

</html>
