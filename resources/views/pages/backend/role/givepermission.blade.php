@extends('layouts.backend.index')
@section('content')
<div id="home">
    
    <div class="container mt-5">
        @if (session('status'))
        <div class="alert alert-{{session('type')}}">
            {{ session('status') }}
        </div>
    @endif
        <div class="row">
            <div class="col-sm-4">
                <form method="POST" action="{{ route('admin.role.givepermission', $role->id) }}">
                    @csrf
                    <div class="card mt-4 card-rounded">
                        <div class="card-header bg-primary text-white">
                            <i class="fa fa-plus"></i> Hak Akses Level User
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="permission">Hak Akses</label>
                                <select class="form-select" id="inputGroupSelect01" name="permission">
                                    <option selected disabled>Pilih Hak Akses role user</option>
                                    @foreach ($permissions as $permission)
                                      <option value="{{$permission->name}}">{{$permission->name}}</option>
                                    @endforeach                                                                                                         
                                  </select>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary btn-md"t><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-8">
                <div class="card mt-4 card-rounded">
                    <div class="card-header bg-primary text-white">
                        <i class="fa fa-tags"></i> Hak Akses
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Hak Akses</th>
                                        <th>Aksi</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        @if ($role->permissions)
                                        @foreach ($role->permissions as $role_permission)


                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{$role_permission->name}}</td>
                                        <td>
                                            <form action="{{route('admin.role.revokepermission',[$role->id, $role_permission->id])}}" method="POST"
                                                class="d-inline" onclick="return confirm('Yakin Hapus ?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        
                                        {{-- <td>
                                            <a href="https://jasatitipsulawesi.com/kategori/26/edit"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="https://jasatitipsulawesi.com/kategori/26" method="POST"
                                                class="d-inline" onclick="return confirm('Yakin Hapus ?')">
                                                <input type="hidden" name="_token"
                                                    value="rRgE8GKWyHiBrJhVk7HOJCOlUMQtmIqwKtlW5J7p"> <input
                                                    type="hidden" name="_method" value="delete"> <button
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td> --}}
                                        @endforeach
                                        @endif
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection