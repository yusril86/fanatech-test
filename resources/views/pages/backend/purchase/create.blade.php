@extends('layouts.backend.index')
@section('content')
{{-- <script>
    const types = @json($types) // {!! json_encode($types) !!}
    console.log({types});
</script> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Daftar') }}</div>

                <div class="card-body">
                    @role('SuperAdmin')
                    <form method="POST" action="{{route("admin.purchase.store")}}">
                    @endrole
                    @role('Purchase')
                    <form method="POST" action="{{route("purchases.purchase.store")}}">
                    @endrole
                        @csrf

                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="">Nomor </label>
                                    <div class="input-group is-invalid">
                                        <input type="text" class="mt-1 form-control @error('number') border-danger @enderror"
                                            name="number" id="number" placeholder="" required>
                                        @error('number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <div class="input-group is-invalid">
                                        <input type="date" class="mt-1 form-control @error('date') border-danger @enderror"
                                            name="date" id="date" placeholder="" required>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <label for="inventory" class="col-md-4 col-form-label ">{{ __('Inventory') }}</label>
                                <div class="col-md-12">                        
                                    <div class="input-group mb-3">
                                        <select class="form-select js-example-basic-single" id="inventory_id" name="inventory_id">
                                            <option selected disabled>Pilih inventory</option>
                                            @foreach ($inventories as $inventory)
                                             <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('inventory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="form-group @error('price') border-danger @enderror">
                                    <label for="">Harga</label>
                                    <br>
                                    <div class="input-group is-invalid">
                                        <input id="price" type="number" name="price" class="mt-1 form-control" value="" placeholder="0" readonly/>
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
            
            
            
                            <div class="row mb-3">
                                <div class="form-group @error('qty') border-danger @enderror">
                                    <label for="">qty</label>
                                    <br>
                                    <div class="input-group is-invalid">
                                        <input  type="number" name="qty" id="qty" class="mt-1 form-control" value="" placeholder="0" />
                                        @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
            
            
                            {{-- <div class="form-group row">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div> --}}
                        </div>                          
                                               

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a  class="btn btn-outline-danger" href="{{route("admin.sales.index")}}">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Simpan') }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        @role('SuperAdmin') 
        $('#inventory_id').change(function () {
            var selectedInventoryId = $(this).val();
            var qty = $('#qty').val('');
            
            // Mengirim permintaan AJAX untuk mendapatkan harga berdasarkan inventory_id      
            $.ajax({                                
                url: '{{ route("admin.getInventoryPrice", ":inventoryId") }}'.replace(':inventoryId', selectedInventoryId),
                type: 'GET',
                success: function (data) {
                    if (data.price) {
                        $('#price').val(data.price);
                    } else {
                        $('#price').val('');
                    }
                    
                },
                error: function () {
                    alert('Gagal mendapatkan harga dari database.');
                }
            });  
                            
            @endrole  
            
            @role('Purchase')
            $('#inventory_id').change(function () {
            var selectedInventoryId = $(this).val();
            var qty = $('#qty').val('');
            
            // Mengirim permintaan AJAX untuk mendapatkan harga berdasarkan inventory_id      
            $.ajax({                                
                url: '{{ route("purchases.getInventoryPrice", ":inventoryId") }}'.replace(':inventoryId', selectedInventoryId),
                type: 'GET',
                success: function (data) {
                    if (data.price) {
                        $('#price').val(data.price);
                    } else {
                        $('#price').val('');
                    }
                    
                },
                error: function () {
                    alert('Gagal mendapatkan harga dari database.');
                }
            }); 
            @endrole
        });
    });
    </script>   
       
       
        @endsection