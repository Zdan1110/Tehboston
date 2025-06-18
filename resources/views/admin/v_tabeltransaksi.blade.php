@section('Title')
Tabel transaksi
@endsection

@extends('admin.templatecoba')

@section('content')
<div class="card mt-2">
  <div class="card-header d-flex justify-content-between align-items-center">
    <div class="card-title">Data Transaksi</div>
    <a href="{{ url('/admin/transaksi/create') }}" class="btn btn-success btn-sm">
      <i class="fas fa-plus"></i> Tambah Transaksi
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            
            <th>Transaksi</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach($transaksi as $t)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $t->id_transaksi }}</td>
            <td>{{ $t->transaksi }}</td>
            <td>{{ $t->pemasukan ?? '-' }}</td>
            <td>{{ $t->pengeluaran ?? '-' }}</td>
            <td>{{ $t->keterangan }}</td>
            <td>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $t->id_transaksi }}">
                Delete
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Modal Hapus --}}
      @foreach($transaksi as $t)
      <div class="modal fade" id="delete{{ $t->id_transaksi }}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h6 class="modal-title">Hapus Transaksi</h6>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Yakin ingin menghapus transaksi dengan ID <strong>{{ $t->id_transaksi }}</strong>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/admin/transaksi/' . $t->id_transaksi) }}" method="POST">
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
