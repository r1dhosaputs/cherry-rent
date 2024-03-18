@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-3" id="alert-kostum-list">
        @include('admin.partials.alert')
    </div>
    <section class="container-fluid">
        <div class="card-group">
            <div class="card">
                {{-- @foreach ($data as $item)
                    {{ $item['slider_1'] }}
                @endforeach --}}
                {{-- {{ optional($row->kategori)->nama_kategori ?? 'Tidak Diketahui' }} --}}
                <img src="/storage/{{ $data[0]['slider_1'] }}" class="card-img-top" alt="noimages">
                <div class="card-body">
                    <h5 class="card-title">Slider 1</h5>
                    <div class="card-text pt-3">
                        <div class="d-flex">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <form id="form-slider-1" action="{{ route('admin.update-slider') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <span class="btn-primary btn btn-sm btn-file">
                                            Insert New <input type="file" id="slider_1" name="slider_1">
                                        </span>
                                    </form>
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#delete-modal-1">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/storage/{{ $data[0]['slider_2'] }}" class="card-img-top" alt="noimages">
                <div class="card-body">
                    <h5 class="card-title">Slider 2</h5>
                    <div class="card-text pt-3">
                        <div class="d-flex">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <form id="form-slider-2" action="{{ route('admin.update-slider') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <span class="btn-primary btn btn-sm btn-file">
                                            Insert New <input type="file" id="slider_2" name="slider_2">
                                        </span>
                                    </form>
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#delete-modal-2">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="/storage/{{ $data[0]['slider_3'] }}" class="card-img-top" alt="noimages">
                <div class="card-body">
                    <h5 class="card-title">Slider 3</h5>
                    <div class="card-text pt-3">
                        <div class="d-flex">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <form id="form-slider-3" action="{{ route('admin.update-slider') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <span class="btn-primary btn btn-sm btn-file">
                                            Insert New <input type="file" id="slider_3" name="slider_3">
                                        </span>
                                    </form>
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#delete-modal-3">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-danger p-3">Rekomendasi Resolusi 1920 x 1080
            <span class="text-muted" style="font-size: 12px">
                (Max 5MB)
            </span>
        </p>

    </section>

    <!-- Modal -->
    <section id="all-modal">
        @for ($i = 1; $i < 4; $i++)
            <!-- Modal -->
            <div class="modal fade show" id="delete-modal-{{ $i }}" style="padding-right: 0px;" aria-modal="true"
                role="dialog">
                <div class="modal-dialog modal-sm">
                    <form action="{{ route('admin.destroy-slider') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Small Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin Ingin menghapus Slider Ke {{ $i }} ?</p>
                                <input type="hidden" name="allslider" value="slider_{{ $i }}">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </form>
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endfor
    </section>

    <script>
        $(document).ready(function() {
            $('#slider_1').on('change', function() {
                $('#form-slider-1').submit();
                console.log('yes1')
            });
            $('#slider_2').on('change', function() {
                $('#form-slider-2').submit();
                console.log('yes2')
            });
            $('#slider_3').on('change', function() {
                $('#form-slider-3').submit();
                console.log('yes3')
            });
        });
    </script>
@endsection
