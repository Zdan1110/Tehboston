@extends('admin.templatecoba')

@section('Title')
Tabel Calon
@endsection

@section('content')


<div class="card mt-2">
    <div class="card-header">
        <div class="card-title">Data Calon Mitra</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Calon</th>
                        <th>ID Akun</th>
                        <th>Nama Lengkap</th>
                        <th>Panjang</th>
                        <th>Lebar</th>
                        <th>Total Luas</th>
                        <th>Foto Lokasi</th>
                        <th>Catatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($survey as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id_calon }}</td>
                        <td>{{ $data->id_akun }}</td>
                        <td>{{ $data->nama_lengkap }}</td>
                        <td>{{ $data->panjang }}</td>
                        <td>{{ $data->lebar }}</td>
                        <td>{{ $data->total_luas }}</td>
                        <td><img src="{{ url('uploads/survey/' . $data->foto) }}" width="100px" alt="Foto Lokasi"></td>
                        <td>{{ $data->catatan }}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $data->id_calon }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="delete{{ $data->id_calon }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content bg-danger text-white">
                                <div class="modal-header">
                                    <h6 class="modal-title">Hapus: {{ $data->nama_lengkap }}</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('survey.destroy', $data->id_calon) }}" method="POST">
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
