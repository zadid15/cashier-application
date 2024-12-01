<x-header />

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Modal -->
    <div class="modal fade" id="modalTambahStok" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Stok
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahStok" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_produk" id="id_produk">
                        <label for="">Jumlah Stok</label>
                        <input type="number" name="Stok" id="nilaiTambahStok" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Stok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<x-sidebar />

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Daftar {{ $title }}</h3>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-warning float-right" style="color: black;"><i class="nav-icon fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailpenjualan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->NamaProduk }}</td>
                                        <td>{{ rupiah($item->harga) }}</td>
                                        <td>{{ $item->JumlahProduk }}</td>
                                        <td>{{ rupiah($item->SubTotal) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right">Total Harga</td>
                                    <td><input type="text" name="totalHarga" id="totalHarga"
                                            value="{{ rupiah($penjualan->TotalHarga) }}" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right">Jumlah Bayar</td>
                                    <td><input type="number" name="JumlahBayar" id="JumlahBayar" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right">Kembalian</td>
                                    <td><input type="number" name="Kembalian" id="Kembalian" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="btnSimpan" class="btn btn-primary float-right mt-2">Simpan</button>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

<x-footer />    

    <script>
        $(document).ready(function() {
            $('#JumlahBayar').on('input', function() {
                var totalHarga = $('#totalHarga').val();

                var totalHarga = totalHarga.replace(/[^0-9,]/g, '').replace(",", ".");
                console.log(totalHarga);
                
                var JumlahBayar = $(this).val();
                var Kembalian = JumlahBayar - totalHarga;
                $('#Kembalian').val(Kembalian);
            })
        })
    </script>
    <script>
        $('#btnSimpan').on('click', function() {
            var totalHarga = $('#totalHarga').val();
            var totalHarga = totalHarga.replace(/[^0-9,]/g, '').replace(",", ".");
            var JumlahBayar = $('#JumlahBayar').val();
            var Kembalian = $('#Kembalian').val();
            var id = '{{ $penjualan->id }}';
            $.ajax({
                type: "POST",
                url: "{{ route('penjualan.bayarCashStore') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    totalHarga: totalHarga,
                    JumlahBayar: JumlahBayar,
                    Kembalian: Kembalian,
                    id: id,
                },
                success: function(response) {
                    window.location.href = "{{ route('penjualan.index') }}";
                },
                error: function(response) {
                    console.log(response);
                }

            })
        })
    </script>