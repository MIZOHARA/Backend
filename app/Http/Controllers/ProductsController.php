<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\productUpdateRequest;
use App\Http\Resources\products_otp_resource;
use App\Models\otp;
use App\Models\productOtp;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function product_otp(Request $request)
    {

    }
    public function Store_product(ProductRequest $productRequest)
    {
        $validate_code = productOtp::where('name',$productRequest->name)->where('otpcode',$productRequest->otpcode)->first();
        if ($validate_code) {
            Products::create($productRequest->all());
            $validate_code->delete();
            return response()->json(['message'=>'done']);
        }
        else {
            return response()->json(['message'=>'no auth']);
        }
    }

    public function edit_product(productUpdateRequest $productUpdateRequest, Products $products)
    {
        $validate_code = productOtp::where('name',$productUpdateRequest->name)->where('otpcode',$productUpdateRequest->otpcode)->first();
        if ($validate_code){
            $products->update($productUpdateRequest->all());
            $validate_code->delete();
            return response()->json(['message'=>'update successfully','data'=>$products]);
        }
        else {
            return response()->json(['message'=>'not found']);
        }
    }

    public function validate_product(Request $request)
    {
        $product = Products::where('name',$request->name)->first();
        if ($product){
            $product_otp = productOtp::create([
               'name'=>$request->name,
                'otpcode'=>rand(100000,999999)
            ]);
            return response()->json(['message'=>'product exist','otp'=>new products_otp_resource($product_otp)]);
        }
    }
}
