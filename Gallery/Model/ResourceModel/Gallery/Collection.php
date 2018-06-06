<?php

namespace Sandis\Gallery\Model\ResourceModel\Gallery;

/**
 * Image Gallery collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Sandis\Gallery\Model\Gallery::class, \Sandis\Gallery\Model\ResourceModel\Gallery::class);
    }

    /**
     * Set ignore ID filter
     *
     * @param array $indexes
     * @return $this
     */
    public function setIgnoreIdFilter($indexes)
    {
        if (count($indexes)) {
            $this->addFieldToFilter('main_table.gallery_id', ['nin' => $indexes]);
        }
        return $this;
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('gallery_id', 'title');
    }

    /**
     * Retrieve option hash
     *
     * @return array
     */
    public function toOptionHash()
    {
        return parent::_toOptionHash('gallery_id', 'title');
    }
}
