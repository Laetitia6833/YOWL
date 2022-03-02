<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allBaskets()
    {
        return Basket::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $request->validate([
            'name' => ['required'],
        ]);


        dump($request);
        $basket = new Basket();
        $basket->name = $request->name;
        $basket->producteur_id = $request->producteur_id;
        $basket->content = $request->content;
        $basket->quantity = $request->quantity;
        $basket->price = $request->price;
        // dump($request);
        $basket->save();
        if (!empty($request->image) || $request->image !== null) {

            $filename = 'basket-' . time() . '.' . $request->image->extension();
            $path = '/images/basket_img/' . $filename;

            $basket->image_path = $path;
            $request->image->move(public_path('images/basket_img'), $filename);
            $basket->save();
        }

        return response()->json();
    }

    public function delete($id)
    {
        return Basket::find($id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        //
    }
}
