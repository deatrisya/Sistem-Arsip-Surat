@extends('main.app')
@section('title','Kategori Arsip Surat')

@section('page-title','Kategori Surat')
@section('content')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Kategori</a></li>
    </ol>
</nav>
<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Kategori Surat</h5>
                            <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat <br>
                                Klik <b>Tambah</b> untuk menambahkan kategori baru </p>
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-2">Tambah Kategori Baru</a>
                            <table class="table table-borderless datatable" id="kategoriData">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Kategori</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Keterangan</th>
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
        $('#kategoriData').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "destroy": true,
            "ajax": {
                "url": base_url + "/kategori-data",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: web_token,
                }
            },
            "columns": [{
                "data": "DT_RowIndex",
                "name": "id",
            },
            {
                "data": "id"
            },
            {
                "data": "nama_kategori",
            },
            {
                "data": "keterangan",
            },
            {
                "data": "options",
            }
            ],
            "drawCallback": function(settings){
                initDeleteButton();
            }
        });
    }
</script>
@endsection

