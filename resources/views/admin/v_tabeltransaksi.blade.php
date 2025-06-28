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
      <div class="modal fade" id="delete{{ $t->id_transaksi }}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
          <div class="modal-body text-center py-4">
            <div class="mb-3">
              <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
            </div>
            <h5 class="mb-2">Hapus Data Ini?</h5>
            <p class="text-muted">Nama transaksi: <strong>{{ $t->transaksi }}</strong></p>
            <div class="d-flex justify-content-center gap-2 mt-4">
              <form action="{{ url('/admin/transaksi/' . $t->id_transaksi) }}" method="POST">
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
