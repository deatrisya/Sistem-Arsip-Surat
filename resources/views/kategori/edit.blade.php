@extends('main.app')
@section('title','Edit Kategori Surat')

@section('page-title','Edit Kategori Surat')
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

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Edit Kategori Surat</h5>
                            <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID Kategori</label>
                                    <input type="text" class="form-control" value="{{ $kategori->id }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori"
                                        placeholder="Masukkan nama kategori" value="{{ $kategori->nama_kategori }}" required>
                                    @error('nama_kategori')
                                    <small class="text-danger nama_kategori">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan"
                                        placeholder="Masukkan keterangan kategori" rows=3 required> {{ $kategori->keterangan }}</textarea>
                                    @error('keterangan')
                                    <small class="text-danger keterangan">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>
@endsection
