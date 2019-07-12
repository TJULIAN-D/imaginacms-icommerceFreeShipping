<?php

namespace Modules\Icommercefreeshipping\Repositories\Eloquent;

use Modules\Icommercefreeshipping\Repositories\IcommerceFreeshippingRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentIcommerceFreeshippingRepository extends EloquentBaseRepository implements IcommerceFreeshippingRepository
{

    function calculate($parameters,$conf){
        
        $countryCode = isset($parameters["shipping_country_code"]) ? $parameters["shipping_country_code"] : null;

        if($countryCode!=null){

            $geozoneFreeID = setting('icommercefreeshipping::geozone');
            // Ojo Metodo del Icommerce para q revise las geozonas (Juan)
            // $countryCode 
            //$geozoneExistFree = metodo($parameters["options"])
            $geozoneExistFree = true;

            if($geozoneExistFree){

                $items = json_decode($parameters["products"]["items"]);
                //$items = $parameters["products"]["items"];

                return $this->getResult($items,$conf);

            }else{

                return [
                    'status' => 'error',
                 'msj' => trans('icommercefreeshipping::icommercefreeshippings.messages.withoutfree')
                ];
            }


        }else{
            return [
                'status' => 'error',
                'msj' => trans('icommercefreeshipping::icommercefreeshippings.messages.notavailable')
            ]; 
        }
       
    }



    function getResult($items,$conf){

        $totalCar = 0;
		
		foreach ($items as $key => $item) {
			// Without FreeShipping
			if ($item->freeshipping == 0) {
                $totalCar = $totalCar + ($item->price * $item->quantity);
			}
		}

		if($totalCar>=$conf->minimum){

            $response["msj"] = "success";
            $response["items"] = null;
			$response["price"] = 0;
        	$response["priceshow"] = false;

	    	return $response;

		}else{

			 return [
           		'status' => 'error',
            	'msj' => trans('icommercefreeshipping::icommercefreeshippings.messages.totalmininum')." ".$conf->minimum
            ];
            
		}
    }

}
