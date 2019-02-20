<?php

namespace Modules\Icommercefreeshipping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Icommerce\Entities\ShippingMethod;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $options['init'] = "Modules\Icommercefreeshipping\Http\Controllers\Api\IcommerceFreeshippingApiController";
        $options['minimum'] = "";
        
        $params = array(
            'title' => trans('icommercefreeshipping::icommercefreeshippings.single'),
            'description' => trans('icommercefreeshipping::icommercefreeshippings.description'),
            'name' => config('asgard.icommercefreeshipping.config.shippingName'),
            'status' => 0,
            'options' => $options
        );

        ShippingMethod::create($params);
    }
}
