@extends('main.app')
@section('title','Tambah Arsip Surat')

@section('page-title','Tambah Arsip Surat')
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
                            <h5 class="card-title">Tambah Arsip Surat</h5>
                            <form action="{{ route('arsip.update', $arsip->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor_surat"
                                        placeholder="Masukkan nomor surat" value="{{ $arsip->nomor_surat }}" required>
                                    @error('nomor_surat')
                                    <small class="text-danger nomor_surat">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" aria-label="kategori" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $arsip->kategori_id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                    <small class="text-danger kategori">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul"
                                        placeholder="Masukkan Judul Surat" value="{{ $arsip->judul }}" required>
                                    @error('judul')
                                    <small class="text-danger judul">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="unggah-file" class="form-label">Ganti Dokumen Surat</label>
                                    <input class="form-control" type="file" id="file_pdf" name="file_pdf">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-danger">Unggah Dokumen dengan Ekstensi (.pdf)</small>
                                    </div>
                                    @if ($arsip->file_pdf)
                                    <p><a href="{{ asset('storage/' . $arsip->file_pdf) }}" class="btn btn-outline-primary mt-2" target="_blank"><i
                                                class="bi bi-file-pdf"></i> Lihat File PDF Lama</a></p>
                                    @endif
                                    @error('file_pdf')
                                    <small class="text-danger file_pdf">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
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
