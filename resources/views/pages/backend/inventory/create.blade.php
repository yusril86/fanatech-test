@extends('layouts.backend.index')
@section('content')
{{-- <script>
    const types = @json($types) // {!! json_encode($types) !!}
    console.log({types});
</script> --}}
<div class="row">
    <form method="POST" action="{{route('admin.inventory.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card card-rounded">
            <div class="card-header bg-primary text-white">
                <i class="fa fa-plus"></i> Tambah Barang
            </div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="form-group">
                        <label for="">Kode Barang</label>
                        <div class="input-group is-invalid">
                            <input type="text" class="mt-1 form-control @error('code') border-danger @enderror"
                                name="code" id="code" placeholder="" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <div class="input-group is-invalid">
                            <input type="text" class="mt-1 form-control @error('name') border-danger @enderror"
                                name="name" id="name" placeholder="" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group @error('price') border-danger @enderror">
                        <label for="">Harga</label>
                        <br>
                        <div class="input-group is-invalid">
                            <input type="number" name="price" class="mt-1 form-control" value="" placeholder="0" />
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                              
              
                
                <div class="row mb-3">
                    <div class="form-group @error('stock') border-danger @enderror">
                        <label for="">Stock</label>
                        <br>
                        <div class="input-group is-invalid">
                            <input type="number" name="stock" class="mt-1 form-control" value="" placeholder="0" />
                            @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>                
             
                

                <div class="form-group row">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
      
        @endsection