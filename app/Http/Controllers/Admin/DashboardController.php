<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       /*  $customer = Customer::get()->count();
        $transaksi = Transaction::get()->count();

        $totalHpp = Product::where("archive", false)->select(DB::raw('sum(selling_price * stock) as total'))->pluck('total')->first();
        $ekspedisi = Order::where('status_antar', 'Packing')->get()->count();
        $orderBelumLunas = Order::where('status_pembayaran', 'belum lunas')->get()->count(); */


        // $totalHpp =$product->selling_price;

        $inventory = Inventory::get()->count();
        $sales = Sale::get()->count();
        $purchase = Purchase::get()->count();

        return view('pages.backend.dashboard', [
            'inventory' => $inventory,
            'sales' => $sales,
            'purchase' => $purchase,            
        ]);

        // dd($total);
    }
}
