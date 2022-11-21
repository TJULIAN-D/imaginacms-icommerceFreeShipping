<?php

namespace Modules\Icommercefreeshiping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IcommercefreeshipingModuleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();
  

    $columns = [
      ["config" => "config", "name" => "config"],
      ["config" => "crud-fields", "name" => "crud_fields"],
      ["config" => "permissions", "name" => "permissions"],
    ];
  
    $moduleRegisterService = app("Modules\Isite\Services\RegisterModuleService");
  
    $moduleRegisterService->registerModule("icommercefreeshiping", $columns, 1);
  }
}
