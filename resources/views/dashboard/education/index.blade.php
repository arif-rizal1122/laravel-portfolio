@extends('dashboard.layout')

@section('konten')
 <p class="card-title">Experience</p>
 <div class="pb-3"><a href="{{ route('education.create') }}" class="btn btn-primary">+ Education</a></div>
 <div class="table-responsive">
    {{-- table>thead>tr>th*3 --}}
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Universitas</th>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>IPK</th>
                <th>Tgl Mulai</th>
                <th>Tgl Akhir</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
    {{-- tbody>tr>td*3 --}}
        <tbody>

            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->info1 }}</td>
                <td>{{ $item->info2 }}</td>
                <td>{{ $item->info3 }}</td>
                <td>{{ $item->tgl_mulai_indo }}</td>
                <td>{{ $item->tgl_akhir_indo }}</td>
                <td>
                    <a href="{{ route('education.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form onsubmit="return confirm('Yakin Mau Hapus Data Ini')" action="{{ route('education.destroy' , $item->id )}}" class="d-inline" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit" name="delate">Delate</button>
                    </form>
                </td>
            </tr>          
            @endforeach

        </tbody>
    </table>
 </div>   

@endsection
