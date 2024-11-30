<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f8f9fa;
        }
        .receipt {
            border: 1px solid #000;
            padding: 20px;
            margin: 20px auto;
            width: 660px; /* Atur lebar sesuai kebutuhan */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px; /* Mengurangi ukuran font di footer */
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h5 class="font-weight-bold">NOTA APLIKASI POSMate</h5>
            <p>SMKTI PELITA NUSANTARA</p>
            <hr>
        </div>
        
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga/Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailPenjualan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->NamaProduk }}</td>
                        <td>{{ rupiah($item->harga) }}</td>
                        <td>{{ $item->JumlahProduk }}</td>
                        <td>{{ rupiah($item->SubTotal) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Total Harga</td>
                    <td>{{ rupiah($penjualans->TotalHarga) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Jumlah Bayar</td>
                    <td>{{ rupiah($totalBayar) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Kembalian</td>
                    <td>{{ rupiah($kembalian) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Kasir</td>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="receipt-footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <button class="btn btn-dark no-print" onclick="window.print()">Cetak Nota</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
