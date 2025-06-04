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
        <h3>Kode Pelanggan</h3>
        <input type="text" id="kode-pelanggan" placeholder="Masukkan Kode Pelanggan" style="padding: 8px; width: 100%; border-radius: 6px; border: 1px solid #ccc;">
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

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Menu</th>
          <th>Jumlah/Menu</th>
          <th>Total Harga/Menu</th>
          <th>Waktu</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      @php $no = 1; @endphp
      @foreach($riwayat as $item)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $item->pelanggan }}</td>
          <td>{{ $item->nama_produk }}</td>
          <td>{{ $item->jumlah }}</td>
          <td>{{ $item->harga }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') }}</td>
          <td>
            <!-- Misalnya ada aksi hapus atau cetak -->
            <button>Hapus</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection