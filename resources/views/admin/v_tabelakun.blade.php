@section ('Title')
Tabel Franchise
@endsection
@extends('admin.v_templateadmin')
@section('content')
<div class="card" style="margin-top:70px">
                  <div class="card-header">
                    <div class="card-title">Data Akun</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID_Akun</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor HP</th>
                            <th>Username</th>
                            <th>Tipe Akun</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach ($admin as $data)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $data->id_akun }}</td>
                              <td>{{ $data->nama }}</td>
                              <td>{{ $data->no_hp }}</td>
                              <td>{{ $data->username }}</td>
                              <td>{{ $data->type_akun }}</td>
                              <td>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_akun }}">
                                    Delete
                                  </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                      </table>
                      @foreach ($admin as $data)
                      <div class="modal fade" id="delete{{ $data->id_akun }}">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content bg-danger">
                                  <div class="modal-header">
                                      <h6 class="modal-title">Username : {{ $data->username }}</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus akun ini ?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <form  action="/admin/akun/{{ $data->id_akun }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-light">Yes</button>
                                    </form>
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