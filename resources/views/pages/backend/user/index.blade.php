@extends('layouts.backend.index')
@section('title')

<div class="pagetitle">
    <h1>Pengguna</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{Request::segment(0)}}">Home</a></li>
          <li class="breadcrumb-item active">Pengguna</li>
        </ol>
      </nav>    
@endsection


@section('content')
  
<section class="section">
    @if (session('status'))
        <div class="alert alert-{{session('type')}}">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-sm shadow-sm ">
            <i class="fas fa-plus"></i>
            <span>Tambah</span>
        </a>
    </div>
    {{-- @if (session()->has('message')) --}}
    
   
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">List Pengguna</h5>
            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table
                    class="table table-hover align-middle table-nowrap mb-4 rounded  table-borderless">
                    <thead>
                        <tr class="bg-secondary bg-opacity-25">
                            {{-- <th class="ps-3" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px">No
                            </th> --}}
                            <th>Nama</th>
                            <th>Email</th>                            
                            <th>Posisi</th>
                            <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                                {{-- <td>{{$no++}}</td> --}}
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>                                
                                <td>{{$data->getRoleNames()->first()}}</td>
                                
                                <td>
                                    <a href="{{route('admin.user.edit',$data->id)}}" class="btn btn-info"                                        >
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('admin.user.destroy', $data->id)}}" method="POST"
                                        class="d-inline" onclick="return confirm('Yakin Hapus ?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->
        </div>
      {{--   <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div> --}}
    </div>
</section>
@endsection