<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Productline;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class ProductlineController extends BaseController
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productline  $productline
     * @return \Illuminate\Http\Response
     */
    public function show(Productline $productline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productline  $productline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$ref)
    {
        $productline = Productline::where('ref',$ref)->first();
        $productline->qte = $request->qte;
        $productline->save();
        return $this->sendResponse($productline, 'qte was successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productline  $productline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productline $productline)
    {
        //
    }
}
