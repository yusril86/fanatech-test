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
            <a href="{{ route('admin.inventory.create') }}" class="btn btn-primary btn-sm shadow-sm ">
                <i class="fas fa-plus"></i>
                <span>Tambah Data</span>
            </a>            
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
                @if(count($inventories) > 0)
                <div class="text-center" style="text-transform: capitalize; white-space: nowrap;">
                    <table id="data-table-search" class="table table-bordered table-sm table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th data-search="tanggal">Name</th>
                                <th>Price</th>
                                <th>Stock</th>                                
                                <th class=" end-0 bg-white " style="border-left-width: 0px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inventory->code }}</td>
                                <td>{{ $inventory->name }}</td>
                                <td>{{ $inventory->price}}</td>
                                <td>{{ $inventory->stock }}</td>  
                                <td>
                                    <a href="{{ route('admin.inventory.edit', $inventory->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.inventory.destroy', $inventory->id) }}" method="POST"
                                        class="d-inline" >
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger delete-confirm" data-name="{{ $inventory->name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>                                        
                                    </form>                                
                                </td>                                                                                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="d-flex justify-content-center mt-2">
                    <h4>Data Inventory belum ada</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- filter --}}

{{-- <div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="modalExportLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-export" action="{{route('transaction.export')}}" method="post">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalExportLabel">Export Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="export_by" class="form-label">
                            Export By
                        </label>
                        <select name="export_by" id="export_by" class="form-control form-select">
                            <option value="">Semua</option>
                            <option value="date">Tanggal</option>
                            <option value="month">Bulan</option>
                        </select>
                    </div>
                    <input type="hidden" name="ekspedisi" value="true">
                    <div class="row" id="wrapper-date" style="display:none">
                        <div class="col-sm-6 mb-4">
                            <label for="export_start" class="form-label">
                                <i class="fa fa-calendar mr-2 pt-1"></i> Mulai Tanggal
                            </label>
                            <input type="date" class="form-control" name="export_start" required id="export"
                                aria-describedby="basic-addon2" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="export_end" class="form-label">
                                <i class="fa fa-calendar mr-2 pt-1"></i> Sampai Tanggal
                            </label>
                            <input type="date" class="form-control" name="export_end" id="export"
                                aria-describedby="basic-addon2" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div id="wrapper-month" style="display:none">
                        <label for="export_start" class="form-label">
                            <i class="fa fa-calendar mr-2 pt-1"></i> Mulai Tanggal
                        </label>
                        <input type="month" class="form-control" name="export_month" required id="export"
                            aria-describedby="basic-addon2" value="{{date('Y-m')}}">
                    </div>
                    <div class="mb-4">
                        <label for="export_by" class="form-label">
                            Status Pembayaran
                        </label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control form-select">
                            <option value="">Semua</option>
                            <option value="lunas">Lunas</option>
                            <option value="belum_lunas">Belum Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success"
                        onclick="this.previousElementSibling.click();document.querySelector('#form-export').submit();">
                        <i class="fas fa-file-excel mr-2"></i>
                        Export</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- <script>
    function exportSetDate(value){
        const exports = document.querySelectorAll("#export");
        
        if(exports.length > 0){
            exports.forEach(element => {
                element.value = value
            });
        }
    }

    const export_end = document.querySelector("input[name='export_end']")
    const export_start = document.querySelector("input[name='export_start']")
    const export_month = document.querySelector("input[name='export_month']")
    const export_by = document.querySelector("#export_by")
    const wrapper_date = document.querySelector("#wrapper-date")
    const wrapper_month = document.querySelector("#wrapper-month")

    export_start.onchange = function(){
        export_end.setAttribute("min", this.value)
        if(this.value > export_end.value) export_end.value = this.value
    }

    export_by.onchange = function(){
        let value = this.value
        if(export_start.value == "") export_start.value = "{{date('Y-m-d')}}";
        if(export_month.value == "") export_month.value = "{{date('Y-m')}}";

        if(value != ""){
            if(value == 'date') {
                wrapper_month.style.display = "none"
                return wrapper_date.style.display = "flex";
            }
            wrapper_date.style.display = "none"
            return wrapper_month.style.display = "block"
        }
        wrapper_month.style.display = "none"
        wrapper_date.style.display = "none"
        
    }
</script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('.delete-confirm').click(function(event){
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Kamu Yakin Hapus Inventory '+ name + '!',
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