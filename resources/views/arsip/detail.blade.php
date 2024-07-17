@extends('main.app')
@section('title','Detail Arsip Surat')

@section('page-title','Detail Arsip Surat')
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
                            <h5 class="card-title">Detail Arsip Surat</h5>
                            <form>
                                <div class="mb-3">
                                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" name="nomor_surat"
                                        placeholder="Masukkan nomor surat" value="{{ $arsip->nomor_surat }}" readonly>
                                    @error('nomor_surat')
                                    <small class="text-danger nomor_surat">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan Judul Surat" value="{{ $arsip->kategori->nama_kategori }}"
                                        readonly>
                                    @error('kategori')
                                    <small class="text-danger kategori">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul"
                                        placeholder="Masukkan Judul Surat" value="{{ $arsip->judul }}" readonly>
                                    @error('judul')
                                    <small class="text-danger judul">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file_pdf" class="form-label">File PDF</label><br>
                                    <!-- Embed PDF using embed tag -->
                                    <embed src="{{ asset('storage/' . $arsip->file_pdf) }}" type="application/pdf" width="100%" height="400px" />

                                    <!-- Download button -->
                                    <a href="{{ route('arsip.download', ['id' => $arsip->id]) }}" class="btn btn-primary"><i class="bx bx-download"></i>
                                        Unduh</a>
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
