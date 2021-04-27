<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $hidden = ['updated_at','deleted_at','created_by','updated_by'];

    public static function insert_in_cart($insert_array)
    {
    	Cart::insert($insert_array);
    }

    public static function list_cart($user_id)
    {
    	return Cart::select('products.id as product_id','products.name','products.description','products.price','products.make','product_categories.category','product_categories.type as category_type','product_categories.model as category_model','cart.created_at')->join('products','cart.product_id','=','products.id')->join('product_categories','products.category_id','=','product_categories.id')->where('user_id',$user_id)->get();
    }

}
