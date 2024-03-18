@extends('admin.layouts.app')

@section('content')
    <section class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-plus" style="margin-right:5px;"></i>
                    Tambah Kostum
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('admin.kostum-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="nama_kostum">Nama Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_kostum') is-invalid @enderror"
                                id="nama_kostum" name="nama_kostum" placeholder="Nama Kostum...">
                            @error('nama_kostum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="validationServer05">Zip</label>
                        <input type="text" class="form-control is-invalid" id="validationServer05"
                            aria-describedby="validationServer05Feedback">
                        <div id="validationServer05Feedback" class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div> --}}

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="kode_kostum">Kode Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('kode_kostum') is-invalid @enderror"
                                id="kode_kostum" name="kode_kostum" placeholder="Kode Kostum...">
                            @error('kode_kostum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="kode_kostum">Harga Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('harga_kostum') is-invalid @enderror"
                                id="harga_kostum" name="harga_kostum" placeholder="Contoh : 80k/3hari">
                            @error('harga_kostum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- <label for="validationServer04">State</label>
                    <select class="custom-select is-invalid" id="validationServer04"
                        aria-describedby="validationServer04Feedback" required>
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div> --}}

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Kategori Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select @error('kategori_kostum_id') is-invalid @enderror"
                                name="kategori_kostum_id">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($kategori as $row)
                                    <option value="{{ $row['id'] }}">{{ $row['nama_kategori'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_kostum_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <a href="/admin/kategori?tambah=true" class="text-muted ml-2"
                                style="text-decoration: underline">Tambah
                                Kategori?</a>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Ukuran Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select @error('ukuran_kostum') is-invalid @enderror" name="ukuran_kostum">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($ukuran as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>
                            @error('ukuran_kostum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Status Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex">
                                <div class="form-check mx-3">
                                    <input class="form-check-input" id="ready" type="radio" name="status_peminjaman"
                                        value="1" checked>
                                    <label for="ready" class="form-check-label">Ready</label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" id="di-rental" type="radio" name="status_peminjaman"
                                        value="0">
                                    {{-- checked --}}
                                    <label for="di-rental" class="form-check-label">Di Rental</label>
                                </div>
                            </div>
                            @error('status_peminjaman')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <span class="text-muted" style="font-size: 12px">(Boleh kosong)</span>
                            <textarea class="form-control" rows="3" placeholder="Masukkan Deskripsi..." style="height: 135px;"
                                name="deskripsi_kostum"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Foto Kostum
                            <span class="text-danger">*</span>
                        </label>
                        <span class="text-muted" style="font-size: 12px">(Max 2MB, Rasio 1:1)</span>
                        <div class="form-control-kostum @error('foto_kostum') is-invalid-kostum @enderror">
                            <input type="file" style="padding:5px;" id="foto_kostum" name="foto_kostum">
                        </div>
                        @error('foto_kostum')
                            <div class="text-danger" style="font-size: 12px">{{ $message }}</div>
                        @enderror
                        {{-- <div class=" mb-3">
                            <label>Gambar Kostum
                                <span class="text-danger">*</span>
                            </label>
                            <div class="form-control-kostum">
                                <input type="file" id="file-input" name="file">
                            </div>
                            {{-- <div class="invalid-feedback">Example invalid custom file feedback</div> --}}
                        {{-- </div>  --}}
                    </div>



                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kostum-list') }}" class="btn btn-sm btn-dark">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
