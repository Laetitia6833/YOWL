<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{

    public function allProducts()
    {
        // $p = (Product::all());
        // dump($p);
        return Product::all();
    }

    public function add(Request $request)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'category_id' => ['required']
        // ]);
        dump($request);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->producteur_id = $request->producteur_id;
        $product->price = $request->price;
        // dump($request);
        $product->save();
        if (!empty($request->image) || $request->image !== null) {

            // dump($request);
            // dump($request->image);
            // dump($request->file->extension());
            // dump($request->image);
            $filename = 'product-' . time() . '.' . $request->image->extension();
            $path = '/images/product_img/' . $filename;
            // dump($path);
            // dump($filename);
            // dump($filename);
            $product->image_path = $path;
            $request->image->move(public_path('images/product_img'), $filename);
            $product->save();
            // dump($filename);
            // $name = $request->image->store('productImage', 'public');
            // $img = new Image();
            // $product_id = $product->image();
            // $img->product_id = $product->id;
            // $img->name = $filename;
            // $img->save();
            // dump($product->image());
            // $product->image()->add($img);
            // dump($request);

            // $product->image()->save($img);
        }

        return response()->json();

        // return Producteur::create($request->validate());
    }

    public function delete($id)
    {
        // dump(Product::find($id));
        return Product::find($id)->delete();
    }
}
