<?php

namespace Modules\IcommerceFreeshipping\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\IcommerceFreeshipping\Entities\Configfreeshipping;
use Modules\IcommerceFreeshipping\Http\Requests\CreateConfigurationRequest;
use Modules\IcommerceFreeshipping\Http\Requests\UpdateConfigurationRequest;
use Modules\IcommerceFreeshipping\Repositories\ConfigurationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Setting\Repositories\SettingRepository;

class ConfigfreeshippingController extends AdminBaseController
{
  /**
   * @var ConfigurationRepository
   */
  private $configuration;
  private $setting;
  public function __construct(ConfigurationRepository $configuration, SettingRepository $setting)
  {
    parent::__construct();
    $this->setting = $setting;
    $this->configuration = $configuration;
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  CreateConfigurationRequest $request
   * @return Response
   */
  public function store(CreateConfigurationRequest $request)
  {
    
    $this->configuration->create($request->all());
    
    return redirect()->route('admin.icommerce.shipping.index')
      ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icommercefreeshipping::configurations.title.configurations')]));
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  Configfreeshipping $configuration
   * @param  UpdateConfigurationRequest $request
   * @return Response
   */
  public function update(Configfreeshipping $configuration, UpdateConfigurationRequest $request)
  {
    
    if ($request->status == 'on')
      $request['status'] = "1";
    else
      $request['status'] = "0";
    
    $data = $request->all();
    $token = $data['_token'];
    unset($data['_token']);
    unset($data['_method']);
    $newData['_token'] = $token;
    foreach ($data as $key => $val)
      $newData['icommercefreeshipping::' . $key] = $val;
    $this->setting->createOrUpdate($newData);

    return redirect()->route('admin.icommerce.shipping.index')
      ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icommercefreeshipping::configurations.title.configurations')]));
  }
  
  
}
