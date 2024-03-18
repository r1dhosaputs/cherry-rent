@extends('admin.layouts.app')

@section('content')
    detatata

    {{ $data }}
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center" style="flex-direction: row; gap:5px;">
                    <div class="d-flex justify-content-between" style="flex-direction: row; gap:5px;">
                        <a href="{{ route('admin.kostum-list') }}" class="btn btn-sm btn-dark"><i
                                class="fa-solid fa-arrow-left"></i>
                        </a>
                        @if ($data->kostum->status_peminjaman === 0)
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                data-target="#peminjaman-edit-{{ $data->kostum->kode_kostum }}">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button>
                        @endif

                        <!-- Modal Edit-->
                        <div class="modal fade" id="peminjaman-edit-{{ $data->kostum->kode_kostum }}" tabindex="-1"
                            aria-labelledby="peminjaman-edit-{{ $data->kode_kostum }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="peminjaman-edit-{{ $data->kode_kostum }}Label">Masukkan
                                            Tanggal Pengembalian
                                        </h5>
                                    </div>
                                    <form action="{{ route('admin.peminjaman-update') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            {{-- {{ $row->kostum->id }} --}}
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label class="mb-0" for="tanggal_pengembalian">Tanggal
                                                        Pengembalian
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="date" class="form-control" id="tanggal_pengembalian"
                                                        name="tanggal_pengembalian">
                                                </div>
                                                <span class="text-muted ml-2" style="font-size: 12px;">Kostum dengan kode
                                                    <span
                                                        style="text-decoration: underline">{{ $data->kostum->kode_kostum }}</span>
                                                    akan
                                                    dikembalikan dan menjadi status ready</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <input type="hidden" name="kostum_id" value="{{ $data->kostum->id }}">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <button type="submit" class="btn btn-danger">Kembalikan
                                                Kostum</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Delete --}}
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#peminjaman-destroy-{{ $data->kostum->kode_kostum }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Modal Delete-->
                        <div class="modal fade" id="peminjaman-destroy-{{ $data->kostum->kode_kostum }}" tabindex="-1"
                            aria-labelledby="peminjaman-destroy-{{ $data->kostum->kode_kostum }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="peminjaman-destroy-{{ $data->kostum->kode_kostum }}Label">
                                            Yakin
                                            Menghapus?
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        {{-- Kostum dengan Nama <span
                                            style="color:#343A40; text-decoration:underline; font-weight:bold;">{{ $data->nama_kostum }}</span>
                                        Akan Dihapus --}}

                                        Peminjam dengan Nama
                                        <span style="text-decoration: underline">{{ $data->nama_peminjam }}</span>
                                        akan di hapus
                                        dan Kode Kostum
                                        <span style="text-decoration: underline">{{ $data->kostum->kode_kostum }}</span>
                                        yang dipinjamnya akan dikembalikan
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.peminjaman-destroy') }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="kostum_id" value="{{ $data->kostum->id }}">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="font-weight-bold">Kode Kostum :</span>
                        {{ $data->kostum->kode_kostum }}</li>
                    <li class="list-group-item"><span class="font-weight-bold">Nama Peminjam :</span>
                        {{ $data->nama_peminjam }}</li>
                    <li class="list-group-item"><span class="font-weight-bold">No Identitas :</span>
                        {{ $data->nomor_identitas_peminjam }}</li>
                    <li class="list-group-item"><span class="font-weight-bold">No HP :</span>{{ $data->nomor_hp_peminjam }}
                    </li>
                    <li class="list-group-item"><span class="font-weight-bold">Sosmed :</span>
                        {{ $data->sosial_media_peminjam }}</li>
                    <li class="list-group-item"><span class="font-weight-bold">Alamat :</span> Provinsi
                        {{ $data->alamat_peminjam }}.
                        {{ $data->alamat_peminjam_2 }}. {{ $data->alamat_peminjam_3 }}.</li>
                    <li class="list-group-item"><span class="font-weight-bold">Data/Foto-Foto Peminjam :</span>
                        @php
                            // Memisahkan string "data_peminjam" menjadi array menggunakan koma sebagai delimiter
                            $dataPeminjamArray = explode(',', $data->data_peminjam);
                        @endphp
                        <div>
                            @foreach ($dataPeminjamArray as $file)
                                <img src="/storage/{{ $file }}" class="img-fluid" alt="...">
                            @endforeach

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
