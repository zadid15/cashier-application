@extends('admin.templates.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary float-right">Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->NamaProduk }}</td>
                                        <td>{{ rupiah($produk->Harga) }}</td>
                                        <td>{{ $produk->Stok }}</td>
                                        <td>
                                            <form id="form-delete-produk" method="POST" action="{{ route('produk.destroy', $produk->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('produk.edit', $produk->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
        $("#form-delete-produk").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda tidak akan bisa mengembalikan data ini lagi.',
                icon: 'warning',
                showCancelButton: 'true',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data Ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).unbind().submit();
                }
            })
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
