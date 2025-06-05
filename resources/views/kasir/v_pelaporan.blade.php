@section ('Title')
Laporan
@endsection
@extends('kasir.template_kasir')
@section('content')  
  <div class="main">

    <!-- FILTER DI ATAS TABEL -->
    <form method="GET" action="{{ url('/pelaporan') }}" class="filter-section" style="margin-bottom: 15px;">
      <label><strong>Filter Tanggal:</strong></label>
      <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
      <span>sampai</span>
      <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
      <button type="submit">Filter</button>
    </form>

    <!-- TOMBOL CETAK PDF -->
    <div style="margin-bottom: 15px;">
      <button onclick="cetakPDF()">Cetak PDF</button>
    </div>

    <!-- TABEL HISTORI -->
    @if(!empty($penjualan))
    <table class="history-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Menu (Jumlah terjual)</th>
          <th>Total Harga</th>
          <th>Waktu</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php $no = 1; @endphp
      @foreach($penjualan as $item)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $item->nama_produk }}</td>
          <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') }}</td>
          <td>
            <!-- Contoh aksi -->
            <button>Hapus</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @else
      <p>Tidak ada data untuk tanggal tersebut.</p>
    @endif
  </div>
</div>


@endsection
