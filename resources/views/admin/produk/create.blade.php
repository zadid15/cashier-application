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
                        <h3 class="card-title">Form Tambah {{ $title }} Baru</h3>
                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-warning float-right" style="color: black;"><i class="nav-icon fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                    <form id="form-create-produk" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="NamaProduk">Nama Produk</label>
                                <input type="text" name="NamaProduk" class="form-control" id="NamaProduk" placeholder="Nama Produk" required>
                            </div>
                            <div class="form-group">
                                <label for="Harga">Harga</label>
                                <input type="number" name="Harga" class="form-control" id="Harga" placeholder="Harga Produk" required>
                            </div>
                            <div class="form-group">
                                <label for="Stok">Stok</label>
                                <input type="number" name="Stok" class="form-control" id="Stok" placeholder="Stok Produk" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mt-3" type="submit">Tambah!</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#form-create-produk").submit(function(e) {
                e.preventDefault();
                dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    url: "{{ route('produk.store') }}",
                    data: dataForm,
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        })
                        $('input[name="NamaProduk"]').val('');
                        $('input[name="Harga"]').val('');
                        $('input[name="Stok"]').val('');
                    },
                    error: function(data) {
                        console.log(data);
                        if (data.status == 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal !',
                                text: data.responseJSON.message,
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            })
        })
    </script>
@endsection
