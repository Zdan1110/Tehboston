@section ('Title')
Tabel Calon
@endsection

@extends('admin.templatecoba')

@section('content')
<div class="card" style="margin-top:8px">
  <div class="card-header">
    <div class="card-title">Data Calon Mitra</div>
  </div>
  <div class="card-body">
    <div class="table-container">
      <!-- Search -->
      <form action="{{ route('admincalon') }}" method="GET" class="mb-3 w-full max-w-md">
        <input
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Cari calon mitra..."
          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-700 focus:outline-none transition"
        >
      </form>

      <table class="table table-bordered" style="min-width: 1600px">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Calon</th>
            <th>ID Akun</th>
            <th>Nama Lengkap</th>
            <th>Nomor KTP</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Kelurahan</th>
            <th>Foto KTP</th>
            <th>Nomor HP</th>
            <th>Alamat Lengkap</th>
            <th>Pas Photo</th>
            <th>Provinsi Usaha</th>
            <th>Kota Usaha</th>
            <th>Kelurahan Usaha</th>
            <th>Kecamatan Usaha</th>
            <th>Alamat Usaha</th>
            <th>Kode Pos</th>
            <th>Titik Koordinat</th>
            <th>Foto Lokasi Usaha</th>
            <th>Via Pembayaran</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach ($admin as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id_calon }}</td>
            <td>{{ $data->id_akun }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            <td>{{ $data->no_ktp }}</td>
            <td>{{ $data->provinsi }}</td>
            <td>{{ $data->kota }}</td>
            <td>{{ $data->kelurahan }}</td>
            <td><img src="{{ url('uploads/ktp/' . $data->ktp) }}" width="100px"></td>
            <td>{{ $data->no_hp }}</td>
            <td>{{ $data->alamat_lengkap }}</td>
            <td><img src="{{ url('uploads/photo/' . $data->pas_photo) }}" width="100px"></td>
            <td>{{ $data->provinsi_usaha }}</td>
            <td>{{ $data->kota_usaha }}</td>
            <td>{{ $data->kelurahan_usaha }}</td>
            <td>{{ $data->kecamatan_usaha }}</td>
            <td>{{ $data->alamat_usaha }}</td>
            <td>{{ $data->kode_pos }}</td>
            <td><a href="{{ $data->titik_koordinat }}" target="_blank">{{ $data->titik_koordinat }}</a></td>
            <td><img src="{{ url('uploads/lokasi/' . $data->lokasi_usaha) }}" width="100px"></td>
            <td>{{ $data->via_pembayaran }}</td>
            <td><img src="{{ url('uploads/bukti/' . $data->bukti) }}" width="100px"></td>
            <td>
              <form action="/admin/calonmitra/update-status/{{ $data->id_calon }}" method="POST">
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
            <td>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $data->id_calon }}">
                Delete
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- MODAL DELETE --}}
    @foreach ($admin as $data)
    <div class="modal fade" id="delete{{ $data->id_calon }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data->id_calon }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
          <div class="modal-body text-center py-4">
            <div class="mb-3">
              <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
            </div>
            <h5 class="mb-2">Hapus Data Calon</h5>
            <p class="text-muted">Apakah Anda yakin ingin menghapus <strong>{{ $data->nama_lengkap }}</strong>?</p>
            <div class="d-flex justify-content-center gap-2 mt-4">
              <form action="{{ url('/admin/calonmitra/' . $data->id_calon) }}" method="POST" class="mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger px-4">Hapus</button>
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
