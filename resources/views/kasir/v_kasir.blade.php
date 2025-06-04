@section ('Title')
Kasir
@endsection
@extends('kasir.template_kasir')
@section('content')
  <div class="main">
    <div class="menu">
      @foreach ($kasir as $data)
        <div class="menu-item" onclick="addToOrder('{{ $data->nama_produk }}', {{ $data->harga }})">
          <img src="{{ asset('uploads/produk/'.$data->gambar_produk) }}" alt="{{ $data->nama_produk }}">
          <p>{{ $data->nama_produk }}<br>Rp{{ number_format($data->harga, 0, ',', '.') }}</p>
        </div>
      @endforeach
    </div>
    

    <div class="order-section">
      <div class="form-pelanggan">
        <h3>Nama Pelanggan</h3>
        <input type="text" id="kode-pelanggan" placeholder="Masukkan Nama Pelanggan" style="padding: 8px; width: 100%; border-radius: 6px; border: 1px solid #ccc;">
      </div>
      
      <div class="pesanan">
        <h3>Pesanan Anda</h3>
        <ul id="order-list"></ul>
        <div id="total">Total: Rp0</div>
      </div>
    </div>

    <div class="pembayaran-container">
      <label for="bayar">Bayar:</label>
      <input type="number" id="bayar" oninput="updateKembalian()" placeholder="Masukkan jumlah bayar">

      <label for="kembalian-input">Kembalian:</label>
      <input type="text" id="kembalian-input" placeholder="Rp0" readonly>
    </div>

    <button type="button" class="checkout-btn" onclick="checkoutOrder()">Checkout</button>

    <div class="filter-section">
      <label for="filter-date">Filter Tanggal: </label>
      <input type="date" id="filter-date" onchange="filterHistory()">
    </div>

    <table id="history-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Menu</th>
          <th>Harga</th>
          <th>Waktu</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <div id="total-penjualan" style="margin-top: 15px; font-weight: bold;">
      Total Penjualan: Rp0
    </div>

  </div>
@endsection