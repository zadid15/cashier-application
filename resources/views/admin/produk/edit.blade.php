<x-header></x-header>

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<x-sidebar></x-sidebar>

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
                        <h3 class="card-title">Formulir Edit {{ $title }}</h3>
                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-warning float-right" style="color: black;"><i class="nav-icon fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                    <form id="form-edit-produk" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="NamaProduk">Nama Produk</label>
                                <input type="text" name="NamaProduk" value="{{ $produk->NamaProduk }}"
                                    class="form-control" id="NamaProduk" required>
                            </div>
                            <div class="form-group">
                                <label for="Harga">Harga Produk</label>
                                <input type="number" name="Harga" value="{{ $produk->Harga }}" class="form-control"
                                    id="Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="Stok">Stok Produk</label>
                                <input type="number" name="Stok" value="{{ $produk->Stok }}" class="form-control"
                                    id="Stok" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mt-3" type="submit">Ubah!</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

<x-footer></x-footer>

    <script>
        $(document).ready(function() {
            $("#form-edit-produk").submit(function(e) {
                e.preventDefault();
                dataForm = $(this).serialize() + "&_token={{ csrf_token() }}" + "&id={{ $produk->id }}";
                $.ajax({
                    type: "PUT",
                    url: "{{ route('produk.update', ':id') }}".replace(':id',
                        {{ $produk->id }}),
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
                    },
                    error: function(data) {
                        console.log(data);
                        if (data.status == 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.responseJSON.message,
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            })
        })
    </script>
