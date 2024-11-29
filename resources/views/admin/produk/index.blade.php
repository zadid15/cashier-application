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
                        <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary float-right"><i
                                class="nav-icon fas fa-plus mr-2"></i>Tambah</a>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-1" id="btnCetakLabel"><i
                                class="nav-icon fas fa-print mr-1"></i>Cetak Label</button>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Stok Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $produk->id }}"
                                                    id="id_produk_label">
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->NamaProduk }}</td>
                                        <td>{{ rupiah($produk->Harga) }}</td>
                                        <td>{{ $produk->Stok }}</td>
                                        <td>
                                            <form class="form-delete-product" method="POST"
                                                action="{{ route('produk.destroy', $produk->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('produk.edit', $produk->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="nav-icon fas fa-pencil-alt"></i>
                                                </a>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="nav-icon fas fa-trash-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                    id="btnTambahStok" data-target="#modalTambahStok"
                                                    data-id_produk="{{ $produk->id }}">
                                                    <i class="nav-icon fas fa-box-open"></i> Tambah Stok Produk
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(document).on('submit', '.form-delete-product', function(e) {
            e.preventDefault();
            var form = this; // Simpan referensi form yang saat ini

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda tidak akan bisa mengembalikan data ini lagi.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data Ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, submit form
                    form.submit();
                }
            });
        });
        // $("#form-delete-product").submit(function(e) {
        //     e.preventDefault();
        //     Swal.fire({
        //         title: 'Apakah anda yakin?',
        //         text: 'Anda tidak akan bisa mengembalikan data ini lagi.',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, Hapus Data Ini!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $(this).unbind().submit();
        //         }
        //     });
        // });

        $(document).on('click', '#btnTambahStok', function() {
            let id_produk = $(this).data('id_produk');
            $('#id_produk').val(id_produk);
        });

        $(document).on('submit', '#formTambahStok', function(e) {
            e.preventDefault();
            dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";
            $.ajax({
                type: "PUT",
                url: "{{ route('produk.tambahStok', ':id') }}".replace(':id', $('#id_produk').val()),
                data: dataForm,
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('produk.index') }}";
                        }
                    })
                    $('#modalTambahStok').modal('hide');
                    $('#formTambahStok')[0].reset();
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>

    {{-- Swal for delete --}}
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil !',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Gagal !',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
