@extends('dashboard.layout')

@section('konten')
 <p class="card-title">Halaman</p>
 <div class="pb-3"><a href="{{ route('halaman.create') }}" class="btn btn-primary">+ Halaman</a></div>
 <div class="table-responsive">
    {{-- table>thead>tr>th*3 --}}
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Judul</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
    {{-- tbody>tr>td*3 --}}
        <tbody>

            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>
                    <a href="{{ route('halaman.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form onsubmit="return confirm('Yakin Mau Hapus Data Ini')" action="{{ route('halaman.destroy' , $item->id )}}" class="d-inline" method="post">
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
