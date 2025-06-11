@section ('Title')
Laporan
@endsection

@extends('kasir.template_kasir')

@section('content')

<style>
  .main {
    max-width: 1000px;
    margin: 0 auto; /* membuat konten berada di tengah secara horizontal */
    padding: 20px;
  }

  .filter-section {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }

  .filter-section input[type="date"],
  .filter-section button {
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .history-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  .history-table th,
  .history-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
  }

  .history-table th {
    background-color: #f9f9f9;
  }

  .cetak-pdf {
    margin-bottom: 15px;
    color:white;
  }

  button {
    cursor: pointer;
  }

  .btn-kuning {
  background-color: #ffc107; /* Kuning Bootstrap */
  color: #212529;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.2s ease;
  }

  .btn-kuning:hover {
    background-color: #e0a800;
  }

</style>

<div class="main">

  <!-- FILTER DI ATAS TABEL -->
  <form method="GET" action="{{ url('/pelaporan') }}" class="filter-section">
    <label><strong>Filter Tanggal:</strong></label>
    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
    <span>sampai</span>
    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
    <button type="submit">Filter</button>
  </form>

  <!-- TOMBOL CETAK PDF -->
  <div class="cetak-pdf">
    <button class="btn-kuning" onclick="cetakPDF()">Cetak PDF</button>

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
            <td><button>Hapus</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Tidak ada data untuk tanggal tersebut.</p>
  @endif
</div>

@endsection
