<?php

namespace Modules\IcommerceFreeshipping\Repositories\Eloquent;

use Modules\IcommerceFreeshipping\Repositories\ConfigurationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentConfigurationRepository extends EloquentBaseRepository implements ConfigurationRepository
{

	public function getConfiguration()
    {
        return $this->model->orderBy('created_at', 'DESC')->first();
    }

}