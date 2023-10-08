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
                <div class="card-header">{{ __('Edit Purchase') }}</div>

                <div class="card-body">
                    @role('SuperAdmin')
                    <form method="POST" action="{{route("admin.purchase.update",$purchase->id)}}">
                    @else
                    <form method="POST" action="{{route("purchases.purchase.update",$purchase->id)}}">
                    @endrole
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="">Nomor </label>
                                    <div class="input-group is-invalid">
                                        <input type="text" class="mt-1 form-control @error('number') border-danger @enderror"
                                            name="number" id="number" placeholder="" value="{{$purchase->number}}" required>
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
                                            name="date" id="date" placeholder="" value="{{ date("$purchase->date", strtotime($purchase->date)); }}" required>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                     
                                        
            
            
                                       
                        </div>                          
                                               

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a  class="btn btn-outline-danger" href="{{route("admin.purchase.index")}}">
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
        });
    });
    </script>   
       
       
        @endsection