@extends('main.app')
@section('title','Sistem Arsip Surat')

@section('page-title','Arsip Surat')
@section('content')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Arsip</a></li>
    </ol>
</nav>
<section class="section dashboard">
<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Data Arsip Surat</h5>
                        <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan <br>
                        Klik <b>Lihat</b> pada kolom aksi untuk menampilkan surat </p>
                        <a href="{{ route('arsip.create') }}" class="btn btn-primary mb-2">Arsipkan Surat</a>
                        <table class="table table-borderless datatable table-responsive" id="arsipData">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Waktu Pengarsipan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->

        </div>
    </div><!-- End Left side columns -->

</div>
</section>
@endsection

@section('main-js')
<script type="text/javascript">
    setTable();
    function setTable(){
        $('#arsipData').DataTable({
            "processing": true, // Menunjukkan bahwa proses pengolahan data sedang berlangsung
            "serverSide": true, // Mengaktifkan pengolahan data di sisi server (server-side processing).
            "responsive": true, // Mengaktifkan responsivitas tabel untuk menyesuaikan dengan perangkat yang berbeda.
            "destroy": true,
            "ajax": {
                "url": base_url + "/arsip-data", // URL endpoint untuk memuat data dari server.
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: web_token, // Data tambahan yang dikirimkan dalam permintaan, dalam hal ini token untuk keamanan.
                }
            },
            "columns": [{
                "data": "DT_RowIndex",
                "name": "id",
            },
            {
                "data": "nomor_surat"
            },
            {
                "data": "kategori_id",
                "name": "kategori.nama_kategori"
            },
            {
                "data": "judul",
            },
            {
                "data": "created_at",
            },
            {
                "data": "options",
            }
            ],
            "drawCallback": function(settings){
                initDeleteButton(); // dipanggil untuk menginisialisasi tombol hapus setiap kali tabel digambar ulang.
            }
        });
    }


</script>
@endsection
