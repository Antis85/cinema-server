<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
//use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Sale;
use Illuminate\Http\Response;

class AdminSaleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      return Sale::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaleRequest  $request
     * @return Response
     */
    public function store(SaleRequest $request): Response
    {
        $validated=$request->validated();
            Sale::create($validated);
            return response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        return Sale::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SaleRequest  $request
     * @param  Sale  $sale
     * @return bool
     */
    public function update(SaleRequest $request, Sale $sale): bool
    {
        $sale->fill($request->validated());
        Hall::get()->each->update(['is_started_sales'=>$sale['start_sales']]);
        return $sale->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Sale  $sale
     * @return ?Response
     */
    public function destroy(Sale $sale): ?Response
    {
        if ($sale->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
