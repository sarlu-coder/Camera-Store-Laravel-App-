<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        
        $product_category = ProductCategory::get_category_list();

        $data = [
            [
                'name'   		=> 'Nikkon D850',
                'description'   => 'PROFESSIONAL PHOTO AND VIDEO PERFORMANCE: 16 megapixel Micro Four Thirds sensor with no low pass filter to confidently capture sharp images with a high dynamic range and artifact free performance; WiFi enabled',
                'price'    		=> 40990.00,
                'make'    		=> 2018
            ],[
                'name'   		=> 'Cannon D850',
                'description'   => 'PROFESSIONAL PHOTO AND VIDEO PERFORMANCE: 16 megapixel Micro Four Thirds sensor with no low pass filter to confidently capture sharp images with a high dynamic range and artifact free performance; WiFi enabled',
                'price'    		=> 50990.00,
                'make'    		=> 2019
            ],[
                'name'   		=> 'Nikkon C575',
                'description'   => 'PROFESSIONAL PHOTO AND VIDEO PERFORMANCE: 16 megapixel Micro Four Thirds sensor with no low pass filter to confidently capture sharp images with a high dynamic range and artifact free performance; WiFi enabled',
                'price'    		=> 30990.00,
                'make'    		=> 2020
            ]
        ];

        $insert_array = [];
        $i = 0;
        foreach ($data as $key => $value) {

            foreach ($product_category as $ke => $val) {

                $insert_array[$i++] = [
                    'category_id'   => $val['id'],
                    'name'   		=> $value['name'],
	                'description'   => $value['description'],
	                'price'    		=> $value['price'],
	                'make'    		=> $value['make'],
	                'created_at'    => date('Y-m-d H:i:s'),
                ];
            }
        }

        Product::insert($insert_array);
    }
}
