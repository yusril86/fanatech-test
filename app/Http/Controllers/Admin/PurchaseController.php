<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idUser = Auth::user()->id;
        $purchases = Purchase::where('user_id', $idUser)->orderBy('created_at', 'DESC')->get();

        return view('pages.backend.purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::all();
        return view('pages.backend.purchase.create', compact('inventories'));
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

        Purchase::create($validation);

        $getIdPurchase = Purchase::latest()->first()?->id ;
        $validationSaleDetail = $request->validate([
            'qty' => 'required',                     
            'price' => 'required'
        ]);
        $validationSaleDetail['inventory_id'] = $request->inventory_id;
        $validationSaleDetail['purchases_id'] = $getIdPurchase;

        PurchaseDetail::create($validationSaleDetail);

        if (Auth::user()->hasRole('SuperAdmin')){
            return to_route('admin.purchase.index')->with([
                'status' => 'Behasil tambah data',
                'type' => 'success'
            ]);
        }else{
            return to_route('purchases.purchase.index')->with([
                'status' => 'Behasil tambah data',
                'type' => 'success'
            ]);
        }
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
        $purchase = Purchase::findOrFail($id);
        return view('pages.backend.purchase.edit',compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchase = Purchase::findOrFail($id);

        $validation = $request->validate([
            'number' => 'required',
            'date' => 'required'
        ]);

        $purchase->update($validation);

        if (Auth::user()->hasRole('SuperAdmin')){
            return to_route('admin.purchase.index')->with([
                'status' => 'Behasil Ubah data',
                'type' => 'success'
            ]);
        }else{
            return to_route('purchases.purchase.index')->with([
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
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return back()->with([
                'status' => 'Behasil Hapus data',
                'type' => 'success'
        ]);
    }
}
