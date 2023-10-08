<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('pages.backend.dashboard', [
            /* 'customer' => $customer,
            'transaksi' => $transaksi,
            'totalHpp' => $totalHpp,
            'ekspedisi' => $ekspedisi,
            'orderBelumLunas' => $orderBelumLunas */
        ]);

        // dd($total);
    }
}
