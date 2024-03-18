@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-3" id="alert-kostum-list">
        @include('admin.partials.alert')
    </div>
    {{-- {{ $data }} --}}
    <section class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class=" fa-solid fa-list" style="margin-right:5px;"></i>
                        <h3 class="card-title">List Kategori</h3>
                    </div>
                    <button type="button" style="border: none" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#kategori-tambah">
                        Tambah Kategori
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($data as $row)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p class="mb-0"><span class="pr-3">{{ $loop->iteration }}.</span>{{ $row->nama_kategori }}
                            </p>
                            <button type="button" style="border: none" class="badge badge-danger badge-pill"
                                data-toggle="modal" data-target="#kategori-destroy-{{ $row->nama_kategori }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </li>

                        <!-- Modal -->
                        <div class="modal fade" id="kategori-destroy-{{ $row->nama_kategori }}" tabindex="-1"
                            aria-labelledby="kategori-destroy-{{ $row->nama_kategori }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="kategori-destroy-{{ $row->nama_kategori }}Label">Yakin
                                            Menghapus?
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus kategori :
                                        <span style="text-decoration: underline;">{{ $row->nama_kategori }}</span> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.kategori.destroy', $row->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- @if (request()->has('tambah') && request()->input('tambah') == 'true')
        <style>
            /* .kostum-modal-tambah {
                        display: block !important;
                    } */
        </style>
    @endif --}}

    <!-- Modal tambah -->
    <div class="modal fade kostum-modal-tambah show" id="kategori-tambah" tabindex="-1"
        aria-labelledby="kategori-tambah-Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kategori-tambah-Label">
                        Tambah Kategori
                    </h5>
                </div>
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori">
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
