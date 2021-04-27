<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exceptions\AppException;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;

class StoreController extends Controller
{
    public function listCategories(Request $request)
    {
        $category_list = ProductCategory::get_category_list();
		return response()->data(['category_list' => $category_list]);
    }

    public function listProducts(Request $request)
    {
    	if(isset($request->category_id)){
    		$is_exist = ProductCategory::get_product_category_by_id($request->category_id);
    		if(empty($is_exist)){
				throw new AppException("Invalid category.");
    		}
    	}
    	$product_category = Product::list_products(isset($request->category_id) ? $request->category_id:'');
    	return response()->data(['product_list' => $product_category]);
    }

    public function addProductToCart(AddToCartRequest $request)
    {
		$requestData = $request->validated();
		$product_exists = Product::get_product_by_id($requestData['product_id']);
		if(empty($product_exists)){
			throw new AppException("Product Not Found.Please add a valid product.");
		}
    	$insert_array = [
    		'user_id'    => Auth::User()->id,
    		'product_id' => $requestData['product_id'],
    		'created_at' => date('Y-m-d H:i:s')
    	];
    	Cart::insert_in_cart($insert_array);
    	return response()->success();
    }

    public function listCart($value='')
    {
    	$cart_list = Cart::list_cart(Auth::User()->id);
    	return response()->data(['cart_list' => $cart_list]);
    }
}
