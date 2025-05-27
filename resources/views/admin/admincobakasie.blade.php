@section ('Title')
Tabel Produk
@endsection
@extends('admin.v_templateadmin')
@section('content')
<div class="card" style="margin-top:70px">
                  <div class="card-header">
                    <div class="card-title">Data Produk</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach ($kasir as $data)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $data->pelanggan }}</td>
                              <td>{{ $data->harga }}</td>
                              <td>{{ $data->tanggal }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                      </table>
                      @foreach ($admin as $data)
                      <div class="modal fade" id="delete{{ $data->id_produk }}">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content bg-danger">
                                  <div class="modal-header">
                                      <h6 class="modal-title">Produk : {{ $data->nama_produk }}</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus produk ini ?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <form  action="/admin/produk/{{ $data->id_produk }}" method="POST">
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