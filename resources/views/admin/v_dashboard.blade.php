@extends('admin.templatecoba')

@section('title', 'Dashboard')

@section('content')
    <div class="wrapper">
        {{-- <div class="main-panel"> --}} {{-- Dihapus atau dikomentari untuk menjaga jarak --}}

            <div class="container" style="margin-top: -50px">
                <div class="page-inner">
                    <div
                        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
                    >
                    </div>
                    <div class="row"> {{-- Ini adalah row untuk 4 card statistik di paling atas --}}
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Pendaftar</p>
                                                <h4 class="card-title">{{ $jumlahPendaftar }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-info bubble-shadow-small"
                                            >
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Franchise</p>
                                                <h4 class="card-title">{{ $jumlahFranchise }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-success bubble-shadow-small"
                                            >
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Pendapatan</p>
                                                <h4 class="card-title">{{ 'Rp ' . number_format($pendapatan, 0, ',', '.') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-secondary bubble-shadow-small"
                                            >
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category" >Penjualan tertinggi</p>
                                                <p class="card-title" >{{ $topFranchise->nama_franchise ?? 'N/A' }} - {{ 'Rp ' . number_format($topFranchise->total_penjualan ?? 0, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- Akhir dari row untuk 4 card statistik --}}

                    {{-- Bagian Filter Bulan (tetap di sini) --}}
                    <div class="card-body">
                        <form method="GET" action="{{ url('/admin') }}" class="filter-section" style="margin-bottom: 15px;">
                            <label><strong>Filter Bulan:</strong></label>
                            <input type="month" name="bulan_awal" value="{{ request('bulan_awal') }}">
                            <span>sampai</span>
                            <input type="month" name="bulan_akhir" value="{{ request('bulan_akhir') }}">
                            <button type="submit">Filter</button>
                        </form>
                    </div>

                    <div class="row"> {{-- Row untuk Chart Utama (mengambil seluruh lebar baris) --}}
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Statistik Penjualan</div>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-pencil"></i>
                                                </span>
                                                Export
                                            </a>
                                            <a href="#" class="btn btn-label-info btn-round btn-sm">
                                                <span class="btn-label">
                                                    <i class="fa fa-print"></i>
                                                </span>
                                                Print
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div> {{-- Akhir dari row untuk Chart Utama --}}

                    <div class="row"> {{-- Row baru untuk Pendaftar Baru (kiri) dan Transaksi (kanan) --}}
                        <div class="col-md-6"> {{-- Kolom untuk Pendaftar Baru --}}
                            <div class="card pendaftar-baru">
                                <div class="card-header">
                                    <h5 class="card-title">Pendaftar Baru</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($daftarbaru as $mitra)
                                        <div class="item-list mb-3 d-flex align-items-center">
                                            <div class="avatar me-3">
                                                @if($mitra->pas_photo)
                                                    <img src="{{ asset('uploads/photo/' . $mitra->pas_photo) }}" alt="{{ $mitra->nama_lengkap }}" class="avatar-img rounded-circle border border-white">
                                                @else
                                                    <span class="avatar-title rounded-circle border border-white bg-primary">
                                                        {{ strtoupper(substr($mitra->nama_lengkap, 0, 1)) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="info-user">
                                                <div class="username">{{ $mitra->nama_lengkap }}</div>
                                                <div class="status text-muted">{{ $mitra->kota ?? 'Tidak ada data kota' }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6"> {{-- Kolom untuk Transaksi --}}
    <div class="card card-round">
        <div class="card-header">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title">Data Transaksi</div>
                <div class="card-tools">
                    <div class="dropdown">
                        <button class="btn btn-icon btn-clean me-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Tambah Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>No</th>
                            <th>Transaksi</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Supplier</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->transaksi }}</td>
                                <td>
                                    @if($item->pemasukan != 0)
                                        Rp{{ number_format($item->pemasukan, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->pengeluaran != 0)
                                        Rp{{ number_format($item->pengeluaran, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->supplier }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 {{-- Akhir dari row untuk Pendaftar Baru dan Transaksi --}}

                </div> {{-- Akhir dari page-inner --}}
            </div> {{-- Akhir dari container --}}

        {{-- </div> --}} {{-- Dihapus atau dikomentari untuk menjaga jarak --}}
    </div>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/kaiadmin.min.js') }}"></script>

    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('kaiadmin-lite-1.2.0/assets/js/demo.js') }}"></script>

    <script src="{{ $chart->cdn() }}"></script>

    <script>
        $(document).ready(function () {
            $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#177dff",
                fillColor: "rgba(23, 125, 255, 0.14)",
            });

            $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#f3545d",
                fillColor: "rgba(243, 84, 93, .14)",
            });

            $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#ffa534",
                fillColor: "rgba(255, 165, 52, .14)",
            });

            var options = {
                chart: {
                    type: 'line',
                    height: 160
                },
                series: [{
                    name: 'Users',
                    data: [10, 12, 15, 18, 17, 20]
                }],
                xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
                }
            }

            var chart = new ApexCharts(document.querySelector("#lineChart"), options);
            // chart.render(); // Ini kemungkinan sudah di-render oleh $chart->script()
        });
    </script>

    {!! $chart->script() !!}
@endsection