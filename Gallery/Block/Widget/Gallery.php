<?php

namespace Sandis\Gallery\Block\Widget;

/**
 * Image Gallery Widget
 *
 */
class Gallery extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{

    /**
     * @var array
     */
    protected $_images;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    protected function getGalleryId()
    {
        return $this->getData('gallery_id');
    }

    public function getImages()
    {
        if (!$this->_images) {
            $this->_images = array(
                'filename_1.jpg' => array(
                    'thumbnail' => 'http://placehold.it/200x200',
                    'image' => 'http://placehold.it/1200x1200',
                ),
                'filename_2.jpg' => array(
                    'thumbnail' => 'http://placehold.it/200x200',
                    'image' => 'http://placehold.it/1200x1200',
                ),
            );
        }

        return $this->_images;
    }

}
