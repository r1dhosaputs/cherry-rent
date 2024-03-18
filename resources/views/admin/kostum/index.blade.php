@extends('admin.layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-bottom: 8px">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1 class="m-0">List Kostum</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{ route('admin.kostum-create') }}" class="btn btn-sm btn-primary">Tambah Kostum</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> --}}
    <div class="container-fluid mt-3" id="alert-kostum-list">
        @include('admin.partials.alert')
    </div>

    <section class="container-fluid">
        {{-- <div class="card-body table-responsive p-0"> --}}
        {{-- <table class="table table-bordered">
                <thead>
                    <tr style="background-color:#343A40;" class="font-weight-bold text-white">
                        <td>No</td>
                        <td>Kode Kostum</td>
                        <td>Nama Kostum</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>BAS2Z</td>
                        <td>Kostum Rimuru</td>
                    </tr>
                </tbody>
            </table> --}}

        {{-- <table id="list-kostum" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color:#fff">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                    </tr>
                </tbody>
            </table> --}}
        {{-- </div> --}}

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">List - Kostum</h3>
                    <a href="{{ route('admin.kostum-create') }}" class="btn btn-sm btn-primary">Tambah Kostum</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="kostum-list" class="table table-striped table-bordered" style="width:100%; min-width:100%;">
                    <thead>
                        <tr class="text-center">
                            <th style="width: max-width:5%;">No</th>
                            <th style="width: max-width:5%;">Aksi</th>
                            <th>Kode Kostum</th>
                            <th>Nama Kostum</th>
                            <th>Kategori</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $kostum }} --}}
                        @foreach ($kostum as $row)
                            <tr>
                                <td style="width: max-width:5%;" class="text-center">{{ $loop->iteration }}</td>
                                <td style="width: max-width:5%;">
                                    <div class="d-flex" style="flex-direction: column; gap:3px;">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.kostum-detail', $row->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.kostum-edit', $row->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        {{-- Delete --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#kostum-destroy{{ $row->kode_kostum }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <style>

                                        </style>

                                        <!-- Modal -->
                                        <div class="modal fade" id="kostum-destroy{{ $row->kode_kostum }}" tabindex="-1"
                                            aria-labelledby="kostum-destroy{{ $row->kode_kostum }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="kostum-destroy{{ $row->kode_kostum }}Label">Yakin Menghapus?
                                                        </h5>
                                                        {{-- <button type="button" class="close" data-dismiss="modal" --}}
                                                        {{-- aria-label="Close"> --}}
                                                        {{-- <span aria-hidden="true">&times;</span> --}}
                                                        {{-- </button> --}}
                                                    </div>
                                                    <div class="modal-body">
                                                        Kostum dengan Nama <span
                                                            style="color:#343A40; text-decoration:underline; font-weight:bold;">{{ $row->nama_kostum }}</span>
                                                        Akan Dihapus
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.kostum-destroy', $row->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 
                                        <button class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="nav-icon mt-1 mr-1 fa-solid fa-right-from-bracket"
                                                style="max-height: 16px"></i>
                                        </button>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form> --}}
                                    </div>
                                </td>
                                <td>{{ $row->kode_kostum }}</td>
                                <td>{{ $row->nama_kostum }}</td>
                                <td>
                                    {{-- optional() adalah fungsi bantuan yang disediakan oleh Laravel untuk mengakses properti dari objek tanpa memeriksa apakah objek tersebut null terlebih dahulu. Ini membantu dalam menghindari pesan kesalahan "Trying to get property of non-object" atau "Trying to get property of null" yang sering muncul saat mencoba mengakses properti dari objek yang null. --}}
                                    {{ optional($row->kategori)->nama_kategori ?? 'Tidak Diketahui' }}
                                </td>
                                <td>{{ $row->ukuran_kostum }}</td>
                                <td>
                                    @if ($row->status_peminjaman === 1)
                                        Ready
                                    @elseif ($row->status_peminjaman === 0)
                                        Di Rental
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
