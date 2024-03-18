@extends('pengunjung.layouts.app')

@section('content')
    <style>
        @media (min-width: 992px) {
            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                color: #fff;
                text-align: center;
                padding: 20px 0;
            }
        }
    </style>

    <div class="container mt-3 p-3">
        <!-- aksi user  -->
        <section id="user-action" class="mb-3">
            <div id="aksi-tambahan-filter">
                <div class="card">
                    <div class="card-body px-lg-0">
                        {{-- <h4 class="mb-0 ms-0 ms-lg-5 fs-4 text-dark text-center mb-3">Filter</h4> --}}
                        <div class="d-flex row justify-content-center align-items-center gap-2 gap-lg-0">
                            {{-- <div class="col-sm-12 col-lg-4"> --}}
                            {{-- <select class="form-select" id="1">
                                        <option selected disabled hidden value="">Cari Berdasarkan Ukuran</option>
                                        @foreach ($ukuran as $row)
                                            <option value="{{ $row }}">{{ $row }}</option>
                                        @endforeach
                                    </select> --}}
                            {{-- </div> --}}
                            <div class="col-sm-12 col-lg-10">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" id="inputPencarian" class="form-control rounded mb-0"
                                            placeholder="Cari Nama Kostum..." name="s" value="{{ request('s') }}">
                                        <button type="submit" class="btn btn-outline-secondary" type="button">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{-- <input type="text" id="inputPencarian" placeholder="Cari Kostum..."> --}}
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- end aksi user --}}


        <!-- semua post atau yang terfilter kena -->
        <section id="all-costume" class="mb-5">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 fs-3 text-dark">
                        {{ request('s') ? 'Berdasarkan Nama: ' . request('s') : 'Semua Kostum' }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        {{-- @foreach ($data as $row)
                            <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                                <div class="card p-0">
                                    <img src="img/example.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title nama-kostum">Kostum Anime</h5>
                                        <p class="card-text">Ukuran : <span class="ukuran">L</span></p>
                                        <p class="card-text">Harga : <span class="harga">15000</span></p>
                                        <a href="#" class="btn btn-primary text-white">Detail</a>
                                        <a href="#" class="btn btn-secondary">Pesan Lewat
                                            <i class="fa-brands fa-whatsapp" style="font-size: 15px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}

                        @foreach ($data as $row)
                            <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                                <div class="card p-0">
                                    <img src="/storage/{{ $row->foto_kostum }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $row->nama_kostum }}</h5>
                                        <p class="card-text mb-0">Ukuran : <span
                                                class="ukuran">{{ $row->ukuran_kostum }}</span>
                                        </p>
                                        <p class="card-text mb-0">Harga : <span
                                                class="harga">{{ $row->harga_kostum }}</span></p>
                                        <p class="card-text">
                                            @if ($row->status_peminjaman === 1)
                                                <span class="badge text-bg-success">Ready</span>
                                            @elseif ($row->status_peminjaman === 0)
                                                <span class="badge text-bg-secondary">Dipinjam</span>
                                            @else
                                                <span class="badge text-bg-danger">Tidak Diketahui</span>
                                            @endif
                                        </p>

                                        {{-- <a href="#" class="btn btn-primary text-white">Detail</a> --}}
                                        <a href="https://wa.me/6285750667547?text=Kak Saya Ingin Rental Kostum dengan Kode {{ $row->kode_kostum }}"
                                            class="btn btn-secondary" style="">
                                            Pesan Lewat
                                            <i class="fa-brands fa-whatsapp" style="font-size: 15px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        {{-- <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                            <div class="card p-0">
                                <img src="img/example.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kostum Refa</h5>
                                    <p class="card-text">Ukuran : <span class="ukuran">XXXL</span></p>
                                    <p class="card-text">Harga : <span class="harga">11000</span></p>
                                    <a href="#" class="btn btn-primary text-white">Detail</a>
                                    <a href="#" class="btn btn-secondary">Pesan Lewat
                                        <i class="fa-brands fa-whatsapp" style="font-size: 15px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                            <div class="card p-0">
                                <img src="img/example.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kostum Anime</h5>
                                    <p class="card-text">Ukuran : <span class="ukuran">S</span></p>
                                    <p class="card-text">Harga : <span class="harga">500000</span></p>
                                    <a href="#" class="btn btn-primary text-white">Detail</a>
                                    <a href="#" class="btn btn-secondary">Pesan Lewat
                                        <i class="fa-brands fa-whatsapp" style="font-size: 15px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                            <div class="card p-0">
                                <img src="img/example.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Kostum Refa</h5>
                                    <p class="card-text">Ukuran : <span class="ukuran">XXL</span></p>
                                    <p class="card-text">Harga : <span class="harga">122000</span></p>
                                    <a href="#" class="btn btn-primary text-white">Detail</a>
                                    <a href="#" class="btn btn-secondary">Pesan Lewat
                                        <i class="fa-brands fa-whatsapp" style="font-size: 15px"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- card body -->

                <!-- pagination -->
                <div class="d-flex justify-content-center">
                    {{ $data->links() }}
                </div>

                {{-- <div class="d-flex justify-content-center align-items-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> --}}
            </div>
            <!-- card -->
        </section>
    </div>
@endsection
