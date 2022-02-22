<?php

declare(strict_types=1);

namespace Application\Db\Model;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\Feature;

class UserManagementTableGateway extends AbstractTableGateway
{
    public function __construct(Adapter $slaveAdapter)
    {
        $this->table = 'user_management';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->featureSet->addFeature(new Feature\MasterSlaveFeature($slaveAdapter));
        $this->initialize();
    }
}
