<?php

use Modules\IcommerceFreeshipping\Entities\Configfreeshipping;

if (! function_exists('icommercefreeshipping_get_configuration')) {

    function icommercefreeshipping_get_configuration()
    {

    	$configuration = new Configfreeshipping();
    	return $configuration->getData();

    }

}

// Initial Method
if (! function_exists('icommercefreeshipping_Init')) {

	function icommercefreeshipping_Init($products, $options = array()){

		$countryFree = "";
		if (setting('icommerce::country-freeshipping')) {
            $countryFree = setting('icommerce::country-freeshipping');
        }

		if(!empty($countryFree)){

			$valueTotal = $products["total"];
        	$items = $products["items"];

        	$countryCode = isset($options["countryCode"]) && $options["countryCode"]!="null" ? $options["countryCode"] : null;

			if($countryCode!=null){

				if($countryCode == $countryFree){

					return icommercefreeshipping_Calculate($items);

				}else{
					return [
	              		'msj' => 'error',
	              		'data' => trans('icommercefreeshipping::configurations.messages.notavailable')
	            	];
				}
	        }else{
	        	return [
	              'msj' => 'error',
	              'data' => trans('icommercefreeshipping::configurations.messages.msjini')
	            ];
	        }
        }else{
        	return [
           		'msj' => 'error',
            	'data' => trans('icommercefreeshipping::configurations.messages.withoutfree')
        	];
        }
       
	}

}


// Calcule the total of the car only products Without Freeshipping
if (! function_exists('icommercefreeshipping_Calculate')) {

	function icommercefreeshipping_Calculate($items){

		$conf = icommercefreeshipping_get_configuration();

		$totalCar = 0;
		
		foreach ($items as $key => $item) {
			// Without FreeShipping
			if ($item->freeshipping == 0) {
                $totalCar = $totalCar + ($item->price * $item->quantity);
			}
		}

		if($totalCar>=$conf->minimum){

			$response["price"] = 0;
        	$response["priceshow"] = false;

        	$response["data"] = null;
	    	$response["msj"] = "success";

	    	return $response;

		}else{
			 return [
           		'msj' => 'error',
            	'data' => trans('icommercefreeshipping::configurations.messages.totalmininum')." ".$conf->minimum
        	];
		}

	}

}