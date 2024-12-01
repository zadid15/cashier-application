<x-header />
<x-sidebar />
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Edit Profil</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Formulir Edit Profil</h3>
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-warning float-right" style="color: black;">
                        <i class="nav-icon fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
                <form id="form-edit-profile" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Gambar Profil (Opsional)</label>
                            <input type="file" name="profile_picture" class="form-control-file" id="profile_picture">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary mt-3" type="submit"><i class="nav-icon fas fa-save mr-2"></i> Simpan Perubahan!</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<x-footer />

<script>
$(document).ready(function() {
    $("#form-edit-profile").submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{ route('profile.update', ':id') }}".replace(':id', {{ $user->id }}),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('dashboard') }}"; // Redirect ke halaman index profile
                    }
                });
            },
            error: function(data) {
                console.error(data);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.responseJSON.message || 'Terjadi kesalahan.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
