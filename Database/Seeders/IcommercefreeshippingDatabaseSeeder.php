<?php

namespace Modules\Icommercefreeshipping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class IcommercefreeshippingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentTableSeeder::class);
        //$this->call(GeozoneTableSeeder::class);
    }
}
