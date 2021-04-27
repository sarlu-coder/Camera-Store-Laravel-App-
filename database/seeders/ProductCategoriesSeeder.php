<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductCategory::truncate();
        $data = [

            [
                'category'      => 'Nikkon',
                'type'   		=> 'Mirrorless',
                'model'    		=> 2018,
                'created_at'    => date('Y-m-d H:i:s'),
            ],[
                'category'      => 'Nikkon',
                'type'   		=> 'Full Frame',
                'model'    		=> 2019,
                'created_at'    => date('Y-m-d H:i:s'),
            ],[
                'category'      => 'Nikkon',
                'type'   		=> 'Point and Shoot',
                'model'    		=> 2020,
                'created_at'    => date('Y-m-d H:i:s'),
            ],[
                'category'      => 'Cannon',
                'type'   		=> 'Mirrorless',
                'model'    		=> 2018,
                'created_at'    => date('Y-m-d H:i:s'),
            ],[
                'category'      => 'Cannon',
                'type'   		=> 'Full Frame',
                'model'    		=> 2019,
                'created_at'    => date('Y-m-d H:i:s'),
            ],[
                'category'      => 'Cannon',
                'type'   		=> 'Point and Shoot',
                'model'    		=> 2020,
                'created_at'    => date('Y-m-d H:i:s'),
            ]
        ];
        ProductCategory::insert($data);
    }
}
