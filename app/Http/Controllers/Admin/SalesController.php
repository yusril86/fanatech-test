<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SaleExport;
use App\Models\Sale;
use App\Models\Inventory;
use App\Models\SaleDetail;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idUser = Auth::user()->id;

        if (Auth::user()->hasRole(['SuperAdmin', 'Manager'])){
            $sales = Sale::all();
        }else{

            $sales = Sale::where('user_id', $idUser)->orderBy('created_at', 'DESC')->get();
        }        

        return view('pages.backend.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::all();
        return view('pages.backend.sale.create', compact('inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        

        $validation = $request->validate([
            'number' => 'required',
            'date' => 'required'
        ]);

        $validation['user_id'] = $idUser;

        Sale::create($validation);

        $getIdSales = Sale::latest()->first()?->id ;
        $validationSaleDetail = $request->validate([
            'qty' => 'required',                     
            'price' => 'required'
        ]);
        $validationSaleDetail['inventory_id'] = $request->inventory_id;
        $validationSaleDetail['sales_id'] = $getIdSales;

        SalesDetail::create($validationSaleDetail);

        if (Auth::user()->hasRole('SuperAdmin')){
            return to_route('admin.sales.index')->with([
                'status' => 'Behasil tambah data',
                'type' => 'success'
            ]);
        }else{
            return to_route('sales.sales.index')->with([
                'status' => 'Behasil tambah data',
                'type' => 'success'
            ]);
        }

    //    dd($getIdSales);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sale = Sale::findOrFail($id);
        return view('pages.backend.sale.edit',compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = Sale::findOrFail($id);

        $validation = $request->validate([
            'number' => 'required',
            'date' => 'required'
        ]);

        $sale->update($validation);

        if (Auth::user()->hasRole('SuperAdmin')){
            return to_route('admin.sales.index')->with([
                'status' => 'Behasil Ubah data',
                'type' => 'success'
            ]);
        }else{
            return to_route('sales.sales.index')->with([
                'status' => 'Behasil Ubah data',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return back()->with([
                'status' => 'Behasil Hapus data',
                'type' => 'success'
        ]);
    }

    public function getInventoryPrice($inventoryId)
    {
        $inventory = Inventory::find($inventoryId);

        if ($inventory) {
            return response()->json(['price' => $inventory->price, 'stock' =>  $inventory->stock]);
        }

        return response()->json(['price' => null,'stock' => null]);
    }

    public function export() 
    {
        return Excel::download(new SaleExport, 'sales.xlsx');
    }
}
