@extends('admin.layouts.app')

@section('content')
    {{-- {{ $data }} --}}
    <section class="container-fluid pt-4">
        <div class="d-flex justify-content-center">
            <div class="card mb-3" style="max-width: 780px;">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center" style="flex-direction: row; gap:5px;">
                        <div class="d-flex justify-content-between" style="flex-direction: row; gap:5px;">
                            <a href="{{ route('admin.kostum-list') }}" class="btn btn-sm btn-dark"><i
                                    class="fa-solid fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.kostum-edit', $data->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#kostum-destroy{{ $data->kode_kostum }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div>
                            <h5 class="text-muted mb-0">Kode : {{ $data->kode_kostum }}</h5>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-5 col-lg-6">
                        <img src="/storage/{{ $data->foto_kostum }}" alt="noimage" class="img-fluid">
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="card-body pb-0 pt-2 px-3">
                            <h3 style="font-weight:bold; text-decoration:underline;">{{ $data->nama_kostum }}</h3>
                            <dl class="mb-1">
                                <dt>Kategori Kostum :</dt>
                                <dd class="pb-1 border-bottom">
                                    {{ optional($data->kategori)->nama_kategori ?? 'Tidak Diketahui' }}</dd>
                                <dt>Ukuran Kostum :</dt>
                                <dd class="pb-1 border-bottom">{{ $data->ukuran_kostum }}</dd>
                                <dt>Status Peminjaman :</dt>
                                <dd class="pb-1 border-bottom">
                                    @if ($data->status_peminjaman === 0)
                                        <span class="badge badge-success">Ready</span>
                                    @elseif ($data->status_peminjaman === 1)
                                        <span class="badge badge-secondary">Dirental</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak Diketahui</span>
                                    @endif
                                </dd>
                                <dt>Deskripsi :</dt>
                                <dd class="pb-1 border-bottom">{{ $data->deskripsi_kostum }}</dd>
                                <dt>Harga :</dt>
                                <dd class="pb-1 mb-0 border-bottom">{{ $data->harga_kostum }}</dd>
                            </dl>
                            <p class="card-text"><small class="text-muted">{{ $updated_time }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="kostum-destroy{{ $data->kode_kostum }}" tabindex="-1"
        aria-labelledby="kostum-destroy{{ $data->kode_kostum }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kostum-destroy{{ $data->kode_kostum }}Label">Yakin Menghapus?
                    </h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" --}}
                    {{-- aria-label="Close"> --}}
                    {{-- <span aria-hidden="true">&times;</span> --}}
                    {{-- </button> --}}
                </div>
                <div class="modal-body">
                    Kostum dengan Nama <span
                        style="color:#343A40; text-decoration:underline; font-weight:bold;">{{ $data->nama_kostum }}</span>
                    Akan Dihapus
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.kostum-destroy', $data->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
