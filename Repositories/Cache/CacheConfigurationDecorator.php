<?php

namespace Modules\IcommerceFreeshipping\Repositories\Cache;

use Modules\IcommerceFreeshipping\Repositories\ConfigurationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheConfigurationDecorator extends BaseCacheDecorator implements ConfigurationRepository
{
    public function __construct(ConfigurationRepository $configuration)
    {
        parent::__construct();
        $this->entityName = 'icommercefreeshipping.configurations';
        $this->repository = $configuration;
    }
}
