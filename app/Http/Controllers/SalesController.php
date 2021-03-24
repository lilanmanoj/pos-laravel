<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Sale;
use App\Models\Product;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale = new Sale();

        $data = [
            'items' => [],
            'methods' => $sale->getPaymentMethods(),
            'total_lines' => 0,
            'sub_total' => number_format(0, 2),
            'total' => number_format(0, 2),
            'paid' => number_format(0, 2),
            'balance' => number_format(0, 2)
        ];

        return Inertia::render('Sell', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Redirect::route('sales.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductByBarcode($barcode, Request $request)
    {
        $barcodePrefix = substr($barcode, 0, 4);
        $barcodeSuffix = (int) substr($barcode, 4);

        $weightKg = $barcodeSuffix / 1000;

        $product = Product::where('barcode_prefix', $barcodePrefix)->with([ 'productType', 'unit' ])->first();

        $items = $request->items;

        if ($product->count() > 0) {
            $item = [
                'item_no' => (int) count($items) + 1,
                'name' => $product->name,
                'qty' => round($weightKg, 3)." kg",
                'unit_price' => number_format($product->unit_price, 2),
                'total' => number_format($weightKg * (double) $product->unit_price, 2)
            ];

            array_push($items, $item);
        }

        $total = 0;

        foreach ($items as $item) {
            $total += (double) $item['total'];
        }

        $sale = new Sale();

        $data = [
            'items' => $items,
            'methods' => $sale->getPaymentMethods(),
            'total_lines' => count($items),
            'sub_total' => number_format($total, 2),
            'total' => number_format($total, 2),
            'paid' => $request->paid,
            'balance' => $request->balance
        ];

        return Inertia::render('Sell', $data);
    }
}
