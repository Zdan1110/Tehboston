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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
