@inject('carbon', 'Carbon\Carbon')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan PDF</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <center>
        <div class="d-flex items-center">
            <img src="{{ asset('img/logo65.png') }}" alt="" width="100" height="100">
            <h5>Laporan Perpustakaan 65</h4>
        </div>
    </center>

    <div class="">
        <table>
            <tr>
                <td>
                    Dicetak Oleh
                </td>
                <td>
                    : {{ auth()->guard('admin')->user()->f_nama }}
                </td>
            </tr>
            @if ($fromDate != null)
                <tr>
                    <td>
                        Laporan Dari Tanggal
                    </td>
                    <td>:
                        {{ $carbon::parse($fromDate)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y') }}
                    </td>
                </tr>
            @else
            @endif
            @if ($endDate != null)
                <tr>
                    <td>
                        Hingga Tanggal
                    </td>
                    <td>:
                        {{ $carbon::parse($endDate)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y') }}
                    </td>
                </tr>
            @else
            @endif
        </table>
    </div>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Petugas</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowBooks as $borrowBook)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowBook->member->f_nama }}</td>
                    <td>{{ $borrowBook->detailPeminjaman->detailBook->book->f_judul }}</td>
                    <td>{{ $borrowBook->admin->f_nama }}</td>
                    <td>{{ $borrowBook->f_tanggalpeminjaman }}</td>
                    <td>{{ $borrowBook->detailPeminjaman->f_tanggalkembali ?? 'Belum Dikembalikan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
