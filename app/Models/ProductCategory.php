<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at','deleted_at','created_by','updated_by'];
    public static function get_category_list()
    {
    	return ProductCategory::get()->toArray();
    }

    public static function get_product_category_by_id($id)
    {
    	return ProductCategory::where('id',$id)->first();
    }
}
