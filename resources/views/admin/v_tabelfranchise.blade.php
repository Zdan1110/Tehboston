@section ('Title')
Tabel Franchise
@endsection
@extends('admin.v_templateadmin')
@section('content')
<div class="card">
                  <div class="card-header">
                    <div class="card-title">Data Franchise</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID Franchise</th>
                            <th>Nama Franchise</th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Alamat Usaha</th>
                            <th>Kode Pos</th>
                            <th>Titik Koordinat</th>
                            <th>Foto Lokasi Usaha</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                              @foreach ($admin as $data)
                              <tr>
                                  <td>{{ $data->id_franchise }}</td>
                                  <td>{{ $data->nama_franchise }}</td>
                                  <td>{{ $data->provinsi_usaha }}</td> <!-- pastikan field ini ada di db -->
                                  <td>{{ $data->kota_usaha }}</td>
                                  <td>{{ $data->kelurahan_usaha }}</td>
                                  <td>{{ $data->kecamatan_usaha }}</td>
                                  <td>{{ $data->alamat_usaha }}</td>
                                  <td>{{ $data->kode_pos }}</td>                                                               <td>
                                  <a href="{{ $data->titik_koordinat }}" target="_blank">
                                    {{ $data->titik_koordinat }}
                                  </a>
                                </td>
                                  <td><img src="{{ url('uploads/lokasi/'. $data->lokasi_usaha) }}" width="100px"></td>
                                  <td>{{ $data->status ?? '-' }}</td>
                                  <td>
                                      <a href="/franchise/edit/{{ $data->id_franchise }}" class="btn btn-sm btn-warning">Edit</a>
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_franchise }}">
                                        Delete
                                      </button>
                                  </td>
                              </tr>
                              @endforeach
                      </tbody>
                      </table>
                     @foreach ($admin as $data)
                        <div class="modal fade" id="delete{{ $data->id_franchise }}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h6 class="modal-title">{{ $data->nama_franchise }}</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda ingin menghapus data ini?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a href="/franchise/delete/{{ $data->id_franchise }}" class="btn btn-outline-light">Yes</a>
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
                </div>
@endsection