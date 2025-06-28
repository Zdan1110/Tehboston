@section ('Title')
Tabel Produk
@endsection
@extends('admin.templatecoba')
@section('content')
<div class="card" style="margin-top:8px">
                  <div class="card-header">
                    <div class="card-title">Data Produk</div>
                    <div align="right">
                      <a href="/admin/produk/add" class="btn btn-sm btn-primary">Tambah Produk</a><br>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <!-- Search -->
                      <form action="{{ route('adminproduk') }}" method="GET" class="mb-3 w-full max-w-md">
                        <input
                          type="text"
                          name="search"
                          value="{{ request('search') }}"
                          placeholder="Cari calon mitra..."
                          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-700 focus:outline-none transition"
                        >
                      </form>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar Produk</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach ($admin as $data)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $data->id_produk }}</td>
                              <td>{{ $data->nama_produk }}</td>
                              <td>{{ $data->harga }}</td>
                              <td><img src="{{ url('uploads/produk/'. $data->gambar_produk) }}" width="100px"></td>
                              <td>
                                  <a href="/admin/produk/edit/{{ $data->id_produk }}" class="btn btn-sm btn-warning">Edit</a>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_produk }}">
                                    Delete
                                  </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                      </table>
                      {{-- Delete Modals --}}
                    @foreach ($admin as $data)
                    <div class="modal fade" id="delete{{ $data->id_produk }}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-body text-center py-4">
                            <div class="mb-3">
                              <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                            </div>
                            <h5 class="mb-2">Hapus Data Ini?</h5>
                            <p class="text-muted">Nama produk: <strong>{{ $data->nama_produk }}</strong></p>
                            <div class="d-flex justify-content-center gap-2 mt-4">
                              <form action="/admin/produk/{{ $data->id_produk }}" method="POST">
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
                </div>
@endsection