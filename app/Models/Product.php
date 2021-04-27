<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at','deleted_at','created_by','updated_by'];

    public static function list_products($category_id='')
    {
		$query = Product::select('products.*','product_categories.category','product_categories.type as category_type','product_categories.model as category_model')->join('product_categories','products.category_id','=','product_categories.id');
    	if(!empty($category_id)){
    		$query = $query->where('category_id',$category_id)->get();
    	}else{
    		$query = $query->get();
    	}
    	return $query;
    }

    public static function get_product_by_id($id)
    {
    	return Product::where('id',$id)->first();
    }
}
