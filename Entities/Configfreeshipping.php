<?php

namespace Modules\IcommerceFreeshipping\Entities;


class Configfreeshipping
{
  
  private $status;
  private $minimum;
  
  public function __construct()
  {
    $this->status = setting('icommercefreeshipping::status');
    $this->minimum = setting('icommercefreeshipping::minimum');
  }
  
  
  
  public function getData()
  {
    return (object) [
      'status' => $this->status,
      'minimum' => $this->minimum
    ];
  }

}