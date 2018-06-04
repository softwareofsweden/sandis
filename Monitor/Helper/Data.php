<?php

namespace Sandis\Monitor\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * Run SQL query
     *
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        return $connection->fetchAll($sql);
    }

}

