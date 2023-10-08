@extends('layouts.backend.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Daftar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route("admin.user.store")}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Sandi') }}</label>
                            <div class="col-md-6 d-flex align-items-center position-relative">
                                <input id="password" style="padding-right: 2rem !important" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                <span role="button" class="position-absolute" style="right:20px !important"
                                    onclick="showPassword(this)">
                                    <i class="fas fa-eye"></i>
                                    <i class="fas fa-eye-slash" style="display: none"></i>
                                </span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('role') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="name" autofocus> --}}
                                <div class="input-group mb-3">
                                    <select class="form-select" id="inputGroupSelect01" name="role">
                                      <option selected disabled>Pilih role user</option>
                                      @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
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
                                    {{ __('Daftar') }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
       function showPassword(self) {
        var x = document.getElementById("password");
        if (x.type === "password") {
        x.type = "text";
        self.firstElementChild.style.display = "none"
        self.lastElementChild.style.display = "inline"
        } else {
            x.type = "password";
            self.firstElementChild.style.display = "inline"
            self.lastElementChild.style.display = "none"
        }
    }
</script>
@endsection