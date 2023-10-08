@extends('layouts.backend.index')
@section('content')
<!-- header -->
<div class="clearfix"></div>
@if (session('status'))
<div class="alert alert-{{session('type')}}">
    {{ session('status') }}
</div>
@endif
<div id="home">
    
    <div class="container-fluid mt-5">                                
        <div class="d-flex justify-content-end ">    
            @role('SuperAdmin')        
            <a href="{{ route('admin.sales.create') }}" class="btn btn-primary btn-sm shadow-sm ">
                <i class="fas fa-plus"></i>
                <span>Tambah Data</span>
            </a>    
            @else
            <a href="{{ route('sales.sales.create') }}" class="btn btn-primary btn-sm shadow-sm ">
                <i class="fas fa-plus"></i>
                <span>Tambah Data</span>
            </a> 
            @endrole        
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="card card-rounded">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <i class="fa fa-cubes"></i>
                @hasanyrole('SuperAdmin|Manager')
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalExport">
                    <i class="fas fa-file-excel mr-2"></i> Export
                </button>
                
                @endhasanyrole                
            </div>
            
            
            <div class="card-body">
                @if(count($sales) > 0)
                <div class="text-center" style="text-transform: capitalize; white-space: nowrap;">
                    <table id="data-table-search" class="table table-bordered table-sm table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Number</th>
                                <th>Tanggal</th>
                                <th>Price</th>
                                <th>qty</th>                                
                                <th class=" end-0 bg-white " style="border-left-width: 0px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->number }}</td>
                                <td>{{ $sale->date }}</td>  
                                @foreach ($sale->salesDetail as $salesDetail)
                                    
                                    <td>{{ $salesDetail->price }}</td>  
                                    <td>{{ $salesDetail->qty }}</td>  
                                @endforeach                              
                                <td> 
                                    @role('SuperAdmin')                                   
                                    <a href="{{ route('admin.sales.edit', $sale->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST"
                                        class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger delete-confirm" data-name="{{ $sale->name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>                                        
                                    </form>
                                    @endrole 

                                    @role('Sales')                                   
                                    <a href="{{ route('sales.sales.edit', $sale->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('sales.sales.destroy', $sale->id) }}" method="POST"
                                        class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger delete-confirm" data-name="{{ $sale->name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>                                        
                                    </form>
                                    @endrole 
                                                                 
                                </td>                                                                                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="d-flex justify-content-center mt-2">
                    <h4>Data Penjualan belum ada</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('.delete-confirm').click(function(event){
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Kamu Yakin Hapus data  '+ name + '!',
            text: "Kamu tidak dapat mengembalikan data yang dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                form.submit();
            }
        });
    });
</script>


@endsection