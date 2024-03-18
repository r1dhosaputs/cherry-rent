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
    {{-- @dd($slider) --}}
    <section class="mb-5">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/storage/" class="d-block w-100 img-fluid" alt="noimage">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/storage/" class="d-block w-100 img-fluid" alt="noimage">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/storage/" class="d-block w-100 img-fluid" alt="noimage">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>


    <section id="new-post" class="mb-5">
        <!-- max new post terbaru 10 -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 fs-3 text-success">New Post!</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        {{-- {{ $new_kostum[0] }} --}}
                        @foreach ($new_kostum as $row)
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
                                            class="btn btn-secondary">
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
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the
                                        bulk
                                        of
                                        the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                            <div class="card p-0">
                                <img src="img/example.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the
                                        bulk
                                        of
                                        the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xl-3 pb-3 pb-lg-1 px-1">
                            <div class="card p-0">
                                <img src="img/example.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the
                                        bulk
                                        of
                                        the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="pb-5 text-center fs-5">
                    <a href="{{ route('kostum') }}">
                        Klik Lihat Semua Kostum
                    </a>

                    {{-- <div class="col-sm-12 col-lg-10">
                        <form action="/kostum" method="GET">
                            <div class="input-group">
                                <input type="text" id="inputPencarian" class="form-control rounded mb-0"
                                    placeholder="Cari Nama Kostum...">
                                <button type="submit" class="btn btn-outline-secondary" type="button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>

        </div>

    </section>
@endsection
