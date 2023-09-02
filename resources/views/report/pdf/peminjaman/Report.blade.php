<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <style>
        .table-border1 {
            border: 1pt solid #000;
            border-collapse: collapse;
        }

        .table-border1 tr {
            border: 1pt solid #000;
            border-collapse: collapse;
        }

        .table-border1 td {
            border: 1pt solid #000;
            border-collapse: collapse;
            text-align: center;
        }

        .table-border1 th {
            border: 1pt solid #000;
            border-collapse: collapse;
        }

        html * {
            font-family: Arial !important;
        }

        br {
            display: block;
            margin: 4px 0;
        }
    </style>
</head>


<body>
    <table width="100%">
        <tr>
            <td><img src="{{public_path('logo.png')}}" alt="" width="150"></td>
            <td><span style="font-size: 16pt; font-weight: bold; padding: 10px; padding-right: 0px;">POLITEKNIK PENERBANGAN SURABAYA</span><br>
                <span style="font-size: 16pt; font-weight: bold; padding: 10px; padding-right: 0px;"> FORMULIR PEMINJAMAN & PENGEMBALIAN LAB </span><br>
                <span style="font-size: 16pt; font-weight: bold; padding: 10px; padding-right: 0px;"> Unit : LABORATORIUM DAN SIMULATOR </span>
            </td>
        </tr>

    </table>

    <table width="100%" style="margin: 0px; padding:0px">
        <tr>
            <td>
                <div style="text-align: right; margin: 0px;padding:0px">FORM-LBS-01</div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="text-align: right; margin: 0px; padding:0px">02 JANUARI 2019 </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="text-align: right;padding:0px">REVISI 04</div>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 10px; padding-left:20px;">
        <tr>
            <td>Nama Peminjam</td>
            <td>:</td>
            <td>{{$transaction->user->name}}</td>
            <td>Course</td>
            <td>:</td>
            <td>{{$transaction->user->course}}</td>
        </tr>
        <tr>
            <td>Hari/Tanggal</td>
            <td>:</td>
            <td>{{$transaction->trx_date}}</td>
            <td>Laboratorium</td>
            <td>:</td>
            <td>{{$transaction->item->name}}</td>
        </tr>
    </table>
    <br>
    <table class="table table-border1" width="100%">
        <thead>
            <tr>
                <th rowspan="2">
                    No
                </th>
                <th rowspan="2">
                    <strong>MATA KULIAH</strong>
                </th>
                <th colspan="2">
                    <strong>JAM</strong>
                </th>
                <th rowspan="2">
                    <strong>PRAKTIKUM</strong>
                </th>
                <th rowspan="2">
                    <strong>KETERANGAN</strong><span style="font-weight: normal;display: block;">
                        (diisi jika terdapat</span>
                    <span style="font-weight: normal;display: block;">permasalahan di</span>
                        <span style="font-weight: normal;display: block;">Laboratorium)
                        </span>
                </th>
            </tr>
            <tr>
                <th>
                    <strong>MULAI</strong>
                </th>
                <th>
                    <strong>SELESAI</strong>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td style="border-bottom:1pt solid black;">
                    1
                </td>
                <td style="border-bottom:1pt solid black;">
                    {{$transaction->course}}
                </td>
                <td style="border-bottom:1pt solid black;">
                    {{substr($transaction->start_time,0,5)}}
                </td>
                <td style="border-bottom:1pt solid black;">
                    {{substr($transaction->end_time,0,5)}}
                </td>
                <td style="border-bottom:1pt solid black;">
                    {{$transaction->name}}
                </td>
                <td style="border-bottom:1pt solid black;">
                    {{$transaction->description}}
                </td>
            </tr>
        </tbody>
    </table>
    <p><i>Catatan Tambahan : </i></p>

    <table width="100%">
        <tr>
            <td>
                <div style="float:left;"></div>

            </td>
            <td>
                <div style="text-align:right">Surabaya, {{now()->format('d-m-Y')}}</div>
                <div style="text-align:right; margin-right:22px;">Mengetahui,</div>
            </td>

        </tr>
        <tr>
            <td>
                <div">Pengelola Lab dan Simulator</div>

            </td>
            <td>
                <div style="text-align:right; margin-right:15px;">Dosen Pengajar</div>
            </td>


        </tr>
        <br>
        <br>
        <br>
        <tr>
            <td>
                <div style="float:left;">___________________</div>

            </td>
            <td>
                <div style="text-align:right">___________________</div>
            </td>


        </tr>
    </table>
</body>

</html>