<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class setinsedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seetings')->delete();

        $data=[
            ['key' => 'default_local','value'=> 'ar'],
            ['key' => 'default_timezone','value' => 'Africa/cairo'],
            ['key' => 'supported_currents','value' => ['USD','LE','SAR']],
            ['key' => 'default_currency','value' => 'USD'],
            ['key' => 'store_email','value' => 'admin@ecommerce.test'],
            ['key' => 'search_engin','value' => '0'],
            ['key' => 'local_shipping_cost','value' => '0'],
            ['key' => 'outer_shipping_cost','value' => '0'],
            ['key' => 'free_shipping_cost','value' => '0']
        ];


      /*  foreach ($data as $n) {
            DB::table('seetings')->insert([$n]);
      */

       DB::table('seetings')->insert([

       ]);
    }
}
