@extends('admin.templates.master')

@section('css')
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
@endsection

@section('content')
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
                        <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-warning float-right"
                            style="color: black;"><i class="nav-icon fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                    <form action="{{ route('penjualan.store') }}" method="POST">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                @csrf
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="penjualan">
                                    <tr>
                                        <td>
                                            <select name="ProdukId[]" id="id_produk" class="form-control kode-produk"
                                                onchange="pilihProduk(this)">
                                                <option value="">Pilih Semua</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">
                                                        {{ $produk->NamaProduk }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="harga[]" id="harga" class="form-control harga"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahProduk[]" id="JumlahProduk"
                                                class="form-control jumlahProduk" oninput="hitungTotal(this)">
                                        </td>
                                        <td>
                                            <input type="text" name="TotalHarga[]" id="TotalHarga"
                                                class="form-control totalHarga" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="hapusProduk(this)"><i
                                                    class="nav-icon fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="3">
                                            Total Harga
                                        </td>
                                        <td colspan="2">
                                            <input type="text" name="total" id="total" class="form-control" readonly>
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                            <button type="button" class="btn btn-primary mt-2" onclick="tambahProduk()"><i
                                    class="nav-icon fas fa-plus mr-1"></i></button>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="nav-icon fas fa-save mr-2"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        function tambahProduk() {
            const newArrow = `
                <tr>
                                    <td>
                                        <select name="ProdukId[]" id="id_produk" class="form-control kode-produk" onchange="pilihProduk(this)">
                                            <option value="">Pilih Semua</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">
                                                    {{ $produk->NamaProduk }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="harga[]" id="harga" class="form-control harga" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="JumlahProduk[]" id="JumlahProduk" class="form-control jumlahProduk" oninput="hitungTotal(this)">
                                    </td>
                                    <td>
                                        <input type="text" name="TotalHarga[]" id="TotalHarga" class="form-control totalHarga"
                                            readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"  onclick="hapusProduk(this)"><i
                                                class="nav-icon fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
            `;
            $('#penjualan').append(newArrow);
        }

        function hapusProduk(buttonElement) {
            $(buttonElement).closest('tr').remove();
        }

        function pilihProduk(produk) {
            const selectOption = produk.options[produk.selectedIndex];
            const row = $(produk).closest('tr');

            const harga = $(selectOption).data('harga');

            const selectedKode = produk.value;
            if ($(".kode-produk").not(produk).filter((_, el) => el.value === selectedKode).length > 0) {
                alert('Produk Sudah Ada');
                row.find('.kode-produk').val('');
                return;
            }

            row.find('.harga').val(harga);
        }

        function hitungTotal(inputElement) {
            const row = $(inputElement).closest('tr');
            const harga = parseFloat(row.find('.harga').val());
            const jumlahProduk = parseFloat(inputElement.value);
            const totalHarga = harga * jumlahProduk;
            row.find('.totalHarga').val(totalHarga);

            hitungTotalAkhir();
        }

        function hitungTotalAkhir() {
            let total = 0;

            $('.totalHarga').each(function(){
                total += parseFloat($(this).val()) || 0;
            });

            $('#total').val(total);
        }
    </script>
@endsection
