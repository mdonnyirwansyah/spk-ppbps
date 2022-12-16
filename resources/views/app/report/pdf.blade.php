<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 2em;
            text-align: center;
            text-transform: uppercase;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header h2 {
            margin: 0;
            font-size: 14px;
        }
        .table {
            font-size: 10px;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }
        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }
        .table td, .table th {
            border: 1px solid black;
            padding: 8px;
        }
        .signature {
            font-size: 12px;
            position: fixed;
            float: right;
            bottom: 10%;
        }
        .signature-top {
            margin-bottom: 50px;
        }

    </style>
</head>
<body>
    <main>
        <div class="header">
            <h1><b>Badan Pusat Statistik Kota Pekanbaru</b></h1>
            <h2><b>Laporan {{ $recruitment->title }}</b></h2>
        </div>
        <table class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align: middle;">Rank.</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama</th>
                    <th colspan="{{ $recruitment->criterias->count() }}" style="text-align: center;">Kriteria</th>
                    <th rowspan="2" style="vertical-align: middle;">Skor</th>
                    <th rowspan="2" style="vertical-align: middle;">Status</th>
                </tr>
                <tr>
                    @foreach ($recruitment->criterias as $criteria)
                        <th>{{ $criteria->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($sawResults as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result['name'] }}</td>
                        @foreach ($result['criteria'] as $key => $criteria)
                            <td>
                                {{ $criteria['result'] }}
                            </td>
                        @endforeach
                        <td>
                            {{ $result['score'] }}
                        </td>
                        <td>{{ $result['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="signature">
            <div class="signature-top">
                <p>Pekanbaru, {{ date('d F Y', strtotime(now())) }}</p>
            </div>
            <div class="signature-bottom">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>
    </main>
</body>
</html>
