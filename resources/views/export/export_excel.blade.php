<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Produk</title>
</head>

<body>
    <table>
        <tr>
            <td colspan="6" style="font-size:15px;"><b>Report Produk</b></td>
        </tr>
        <tr>
            <td colspan="6">Date : {{ $from_date . ' to ' . $until_date }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr style="height: 21px;">
            <th style="font-size: 11px;">&nbsp;N0</th>
            <th style="font-size: 11px;">&nbsp;Nama Produk</th>
            <th style="font-size: 11px;">&nbsp;Kategori Produk</th>
            <th style="font-size: 11px;">&nbsp;Harga Barang</th>
            <th style="font-size: 11px;">&nbsp;Harga Jual</th>
            <th style="font-size: 11px;">&nbsp;Stok</th>
        </tr>
        {{-- @foreach ($transaksi as $a => $b)
            <tr>
                <td style="font-size: 11px;text-align:center;">{{ $loop->iteration }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->no_transaksi }}</td>
                <td style="font-size: 11px;text-align:left;">{{ $b->NIS }}-{{ $b->nama_santri }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->kode_barang }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->nama_barang }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->kategori }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->harga_jual }}</td>
                <td style="font-size: 11px;text-align:left;">{{ $b->qty }}</td>
                <td style="font-size: 11px;text-align:center;">{{ $b->jumlah_harga }}</td>
            </tr>
        @endforeach --}}
        <tr>
            <td colspan="6">Total : Rp. {{ $total }}</td>
        </tr>
    </table>
</body>

</html>
