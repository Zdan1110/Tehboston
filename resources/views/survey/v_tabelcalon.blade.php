@section ('Title')
Tabel Calon
@endsection
@extends('survey.templatecoba')
@section('content')

<div class="card" style="margin-top:8px">
                  <div class="card-header">
                    <div class="card-title">Data Calon Mitra</div>
                  </div>
                  <div class="card-body" >
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Calon</th>
                            <th>ID Akun</th>
                            <th>Nama Lengkap Calon</th>
                            <th>Nomor HP</th>
                            
                            <th>Pas Photo</th>
                            <th>Provinsi Usaha</th>
                            <th>Kota Usaha</th>
                            <th>Kelurahan Usaha</th>
                            <th>Kecamatan Usaha</th>
                            <th>Alamat Usaha</th>
                            <th>Kode Pos</th>
                            <th>Titik Koordinat</th>
                            <th>Foto Lokasi Usaha</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach ($survey as $data)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $data->id_calon }}</td>
                              <td>{{ $data->id_akun }}</td>
                              <td>{{ $data->nama_lengkap }}</td>
                              <td>{{ $data->no_hp }}</td>
                              
                              <td><img src="{{ url('uploads/photo/'. $data->pas_photo) }}" width="100px"></td>
                              <td>{{ $data->provinsi_usaha }}</td>
                              <td>{{ $data->kota_usaha }}</td>
                              <td>{{ $data->kelurahan_usaha }}</td>
                              <td>{{ $data->kecamatan_usaha }}</td>
                              <td>{{ $data->alamat_usaha }}</td>
                              <td>{{ $data->kode_pos }}</td>
                              <td>
                                  <a href="{{ $data->titik_koordinat }}" target="_blank">
                                    {{ $data->titik_koordinat }}
                                  </a>
                                </td>
                              <td><img src="{{ url('uploads/lokasi/'. $data->lokasi_usaha) }}" width="100px"></td>
                              <td>
                              <a href="/survey/laporansurvey/{{ $data->id_calon }}" class="btn btn-sm btn-warning">Buat Laporan</a>
                              </td
                          </tr>
                          @endforeach
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
@endsection