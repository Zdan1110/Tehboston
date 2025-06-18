@section('Title')
Tabel Ulasan
@endsection

@extends('admin.templatecoba')

@section('content')
<div class="card mt-2">
  <div class="card-header">
    <div class="card-title">Data Ulasan</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No</th>
            <th>ID Ulasan</th>
            <th>ID Akun</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Subjek</th>
            <th>Pesan Ulasan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach($ulasan as $u)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $u->id_ulasan }}</td>
            <td>{{ $u->id_akun ?? '-' }}</td>
            <td>{{ $u->nama_lengkap }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->rating }} / 5</td>
            <td>{{ $u->subjek }}</td>
            <td>{{ $u->ulasan_pesan }}</td>
            <td>
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $u->id_ulasan }}">
                Delete
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Modal Hapus --}}
      @foreach($ulasan as $u)
      <div class="modal fade" id="delete{{ $u->id_ulasan }}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h6 class="modal-title">Hapus Ulasan</h6>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Yakin ingin menghapus ulasan dari <strong>{{ $u->nama_lengkap }}</strong>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/admin/ulasan/' . $u->id_ulasan) }}" method="POST">
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
