@extends('admin.layouts.app')

@section('content')
    <section class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-plus" style="margin-right:5px;"></i>
                    Tambahkan Peminjaman
                </h3>
            </div>
            {{-- @dd($kostum) --}}
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="mb-0">Kode Kostum
                                    <span class="text-danger">*</span>
                                </label>
                                <span class="text-muted" style="font-size: 12px">
                                    (Hanya berisi jika Status Peminjam Ready)
                                </span>
                                <select class="custom-select @error('kostum_id') is-invalid @enderror" name="kostum_id">
                                    <option value="" disabled selected hidden>Pilih</option>
                                    @foreach ($kostum as $row)
                                        {{-- hanya tersedia jika status peminjaman 1 ready! --}}
                                        @if ($row->status_peminjaman == 1)
                                            <option value="{{ $row->id }}">{{ $row->kode_kostum }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kostum_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="nomor_identitas_peminjam">Nomor Identitas Peminjam
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control @error('nomor_identitas_peminjam') is-invalid @enderror"
                                id="nomor_identitas_peminjam" name="nomor_identitas_peminjam"
                                placeholder="NIK/KIA/NIM/NISN dan lainnya...">
                            @error('nomor_identitas_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="nama_peminjam">Nama Peminjam
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror"
                                id="nama_peminjam" name="nama_peminjam" placeholder="Alex ">
                            @error('nama_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="nomor_hp_peminjam">Nomor HP Peminjam
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nomor_hp_peminjam') is-invalid @enderror"
                                id="nomor_hp_peminjam" name="nomor_hp_peminjam" placeholder="0855723 atau 6250241">
                            @error('nomor_hp_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="sosial_media_peminjam">Sosmed Peminjam
                                <span class="text-danger">*</span>
                            </label>
                            <span class="text-muted" style="font-size: 12px">
                                (Bisa memasukkan Link atau Username
                                Peminjam)
                            </span>
                            <input type="text" class="form-control @error('sosial_media_peminjam') is-invalid @enderror"
                                id="sosial_media_peminjam" name="sosial_media_peminjam" placeholder="IG/FB/TWITTER(X)/DLL">
                            @error('sosial_media_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="mb-0">Provinsi Peminjam
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="custom-select @error('alamat_peminjam') is-invalid @enderror"
                                    name="alamat_peminjam">
                                    <option value="" disabled selected hidden>Pilih</option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{ $prov['name'] }}">{{ $prov['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('alamat_peminjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="alamat_peminjam_3">Kota/Kabupaten
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('alamat_peminjam_3') is-invalid @enderror"
                                id="alamat_peminjam_2" name="alamat_peminjam_2" placeholder="Kota Banjarbaru">
                            @error('alamat_peminjam_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="alamat_peminjam_3">Detail Alamat Rumah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('alamat_peminjam_3') is-invalid @enderror"
                                id="alamat_peminjam_3" name="alamat_peminjam_3"
                                placeholder="Komplek Surya Indah Jl.Ijai No 16">
                            @error('alamat_peminjam_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-0">Data Tambahan
                            <span class="text-danger">*</span>
                        </label>
                        <span class="text-muted" style="font-size: 12px">(Max 10MB, Seperti Foto Peminjam/Foto KTP
                            nya)</span>
                        <input type="file" class="form-control @error('data_peminjam[]') is-invalid @enderror"
                            style="padding-bottom:2.3rem;" name="data_peminjam[]" multiple>
                        @error('data_peminjam[]')
                            <div class="text-danger" style="font-size: 13px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="lama_meminjam">Lama Meminjam
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('lama_meminjam') is-invalid @enderror"
                                id="lama_meminjam" name="lama_meminjam" placeholder="3 Hari">
                            @error('lama_meminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="tanggal_peminjaman">Tanggal Peminjaman
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror"
                                id="tanggal_peminjaman" name="tanggal_peminjaman">
                        </div>
                        @error('tanggal_peminjaman')
                            <div class="text-danger" style="font-size: 13px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-0" for="tanggal_pengembalian">Tanggal Pengembalian
                                <span class="text-danger">*</span>
                            </label>
                            <span class="text-muted" style="font-size: 12px">Boleh dikosongkan, diisi saat kostum
                                dikembalikan</span>
                            <input type="date" class="form-control" id="tanggal_pengembalian"
                                name="tanggal_pengembalian">
                        </div>
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
