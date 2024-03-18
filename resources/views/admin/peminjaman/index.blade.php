@extends('admin.layouts.app')

@section('content')
    {{-- @foreach ($data as $k)
        {{ $k->kostum->kode_kostum }}
    @endforeach --}}
    <div class="container-fluid mt-3" id="alert-kostum-list">
        @include('admin.partials.alert')
    </div>
    <section class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">List - Peminjaman</h3>
                    <a href="{{ route('admin.peminjaman-create') }}" class="btn btn-sm btn-primary">Tambah Peminjam</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="kostum-list" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr class="text-center">
                            <th style="width: max-width:5%;">No</th>
                            <th style="width: max-width:5%;">Aksi</th>
                            <th>Kode<br>Kostum</th>
                            <th>Nama<br>Peminjam</th>
                            <th>
                                No Identitas<br>Peminjam
                            </th>
                            <th>No HP<br>Peminjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td style="width: max-width:5%;" class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td style="width: max-width:5%;">
                                    <div class="d-flex" style="flex-direction: column; gap:3px;">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.peminjaman-detail', $row->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        {{-- Tanggal Pengembalian edit saja --}}
                                        {{-- <a href="{{ route('admin.kostum-edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        </a> --}}
                                        @if ($row->kostum->status_peminjaman === 0)
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#peminjaman-edit-{{ $row->kostum->kode_kostum }}">
                                                <i class="fa-solid fa-rotate-right"></i>
                                            </button>
                                        @endif
                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="peminjaman-edit-{{ $row->kostum->kode_kostum }}"
                                            tabindex="-1" aria-labelledby="peminjaman-edit-{{ $row->kode_kostum }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="peminjaman-edit-{{ $row->kode_kostum }}Label">Masukkan
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

                                                                    <input type="date" class="form-control"
                                                                        id="tanggal_pengembalian"
                                                                        name="tanggal_pengembalian">
                                                                </div>
                                                                <span class="text-muted ml-2"
                                                                    style="font-size: 12px;">Kostum dengan kode <span
                                                                        style="text-decoration: underline">{{ $row->kostum->kode_kostum }}</span>
                                                                    akan
                                                                    dikembalikan dan menjadi status ready</span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <input type="hidden" name="kostum_id"
                                                                value="{{ $row->kostum->id }}">
                                                            <input type="hidden" name="id"
                                                                value="{{ $row->id }}">
                                                            <button type="submit" class="btn btn-danger">Kembalikan
                                                                Kostum</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>





                                        {{-- Delete --}}
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#peminjaman-destroy-{{ $row->kostum->kode_kostum }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="peminjaman-destroy-{{ $row->kostum->kode_kostum }}"
                                            tabindex="-1"
                                            aria-labelledby="peminjaman-destroy-{{ $row->kostum->kode_kostum }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="peminjaman-destroy-{{ $row->kostum->kode_kostum }}Label">
                                                            Yakin
                                                            Menghapus?
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- Kostum dengan Nama <span
                                                            style="color:#343A40; text-decoration:underline; font-weight:bold;">{{ $row->nama_kostum }}</span>
                                                        Akan Dihapus --}}

                                                        Peminjam dengan Nama
                                                        <span
                                                            style="text-decoration: underline">{{ $row->nama_peminjam }}</span>
                                                        akan di hapus
                                                        dan Kode Kostum
                                                        <span
                                                            style="text-decoration: underline">{{ $row->kostum->kode_kostum }}</span>
                                                        yang dipinjamnya akan dikembalikan
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.peminjaman-destroy') }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $row->id }}">
                                                            <input type="hidden" name="kostum_id"
                                                                value="{{ $row->kostum->id }}">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $row->kostum_id }}</td>
                                <td>{{ $row->nama_peminjam }}</td>
                                <td>{{ $row->nomor_identitas_peminjam }}</td>
                                <td>{{ $row->nomor_hp_peminjam }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
