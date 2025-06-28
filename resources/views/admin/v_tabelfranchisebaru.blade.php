@section ('Title')
Tabel Calon
@endsection

@extends('admin.templatecoba')

@section('content')
<div class="card mt-3 shadow-sm border-0">
  <div class="card-header bg-white border-bottom">
    <h5 class="card-title mb-0">Data Franchise Baru</h5>
  </div>
  <div class="card-body">
    <!-- Search -->
      <form action="{{ route('adminfranchisebaru') }}" method="GET" class="mb-3 w-full max-w-md">
        <input
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Cari calon mitra..."
          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-700 focus:outline-none transition"
        >
      </form>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="thead-light">
          <tr class="text-center">
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Alamat</th>
            <th>Kode Pos</th>
            <th>Koordinat</th>
            <th>Foto Lokasi</th>
            <th>Pembayaran Via</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($admin as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id_franchisebaru }}</td>
            <td>{{ $data->nama_franchise }}</td>
            <td>{{ $data->provinsi_usaha }}</td>
            <td>{{ $data->kota_usaha }}</td>
            <td>{{ $data->kelurahan_usaha }}</td>
            <td>{{ $data->kecamatan_usaha }}</td>
            <td>{{ $data->alamat_usaha }}</td>
            <td>{{ $data->kode_pos }}</td>
            <td>
              <a href="{{ $data->titik_koordinat }}" target="_blank">{{ $data->titik_koordinat }}</a>
            </td>
            <td><img src="{{ url('uploads/lokasi/'. $data->lokasi_usaha) }}" width="100px" class="img-thumbnail"></td>
            <td>{{ $data->via_pembayaran }}</td>
            <td><img src="{{ url('uploads/bukti/'. $data->bukti) }}" width="100px" class="img-thumbnail"></td>
            <td>
              <form action="/admin/franchisebaru/update-status/{{ $data->id_franchisebaru }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
                  <option value="Review Dokumen" {{ $data->status == 'Review Dokumen' ? 'selected' : '' }}>Review Dokumen</option>
                  <option value="Survey Lokasi" {{ $data->status == 'Survey Lokasi' ? 'selected' : '' }}>Survey Lokasi</option>
                  <option value="Pembayaran" {{ $data->status == 'Pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                  <option value="Pembuatan Booth" {{ $data->status == 'Pembuatan Booth' ? 'selected' : '' }}>Pembuatan Booth</option>
                  <option value="Diterima" {{ $data->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                  <option value="Ditolak" {{ $data->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
              </form>
            </td>
            <td class="text-center">
              <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $data->id_franchisebaru }}">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Delete Modals --}}
    @foreach ($admin as $data)
    <div class="modal fade" id="delete{{ $data->id_franchisebaru }}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
          <div class="modal-body text-center py-4">
            <div class="mb-3">
              <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
            </div>
            <h5 class="mb-2">Hapus Data Ini?</h5>
            <p class="text-muted">Nama Franchise: <strong>{{ $data->nama_franchise }}</strong></p>
            <div class="d-flex justify-content-center gap-2 mt-4">
              <form action="/admin/franchisebaru/{{ $data->id_franchisebaru }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger px-4">Ya</button>
              </form>
              <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">Batal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection
