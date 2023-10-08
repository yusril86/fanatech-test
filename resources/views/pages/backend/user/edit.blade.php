@extends('layouts.backend.index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Daftar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route("admin.user.update",$user->id)}}">
                        @method("PUT")
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                            <div class="col-12 col-md-6">
                                <input type="name" id="name" name="name" class="form-control form-control-sm @error('name')
                                            is-invalid
                                        @enderror" style="border-radius: .8rem !important"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-12 col-md-6">
                                <input type="email" id="email" name="email" class="form-control form-control-sm @error('email')
                                            is-invalid
                                        @enderror" style="border-radius: .8rem !important"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Hak Akes') }}</label>

                            <div class="col-md-6">                            
                                <div class="input-group mb-3">
                                    <select class="form-select" id="inputGroupSelect01" name="role">
                                        <option selected disabled>Pilih Level User</option>
                                        @foreach ($userRole as $role)
                                            <option value="{{$role->name}}" {{ $role->name == $user->getRoleNames()->first() ? 'selected': 'null'}} >{{$role->name}}</option>
                                        @endforeach                                       
                                    </select>
                                </div>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                   

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a  class="btn btn-outline-danger" href="{{route("admin.user.index")}}">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ubah') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection