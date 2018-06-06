<?php

namespace Sandis\Gallery\Model;

use Sandis\Gallery\Api\GalleryRepositoryInterface;
use Sandis\Gallery\Api\Data;
use Sandis\Gallery\Model\ResourceModel\Gallery as ResourceGallery;
use Sandis\Gallery\Model\ResourceModel\Gallery\CollectionFactory as GalleryCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Class GalleryRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GalleryRepository implements GalleryRepositoryInterface
{
    /**
     * @var ResourceGallery
     */
    protected $resource;

    /**
     * @var GalleryFactory
     */
    protected $blockFactory;

    /**
     * @var GalleryCollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Sandis\Gallery\Api\Data\GalleryInterfaceFactory
     */
    protected $dataGalleryFactory;


    /**
     * @param ResourceGallery $resource
     * @param GalleryFactory $galleryFactory
     * @param Data\GalleryInterfaceFactory $dataGalleryFactory
     * @param GalleryCollectionFactory $galleryCollectionFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceGallery $resource,
        GalleryFactory $galleryFactory,
        \Sandis\Gallery\Api\Data\GalleryInterfaceFactory $dataGalleryFactory,
        GalleryCollectionFactory $galleryCollectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->resource = $resource;
        $this->galleryFactory = $galleryFactory;
        $this->galleryCollectionFactory = $galleryCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataGalleryFactory = $dataGalleryFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Save Gallery data
     *
     * @param \Sandis\Gallery\Api\Data\GalleryInterface $gallery
     * @return Gallery
     * @throws CouldNotSaveException
     */
    public function save(Data\GalleryInterface $gallery)
    {
        try {
            $this->resource->save($gallery);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $gallery;
    }

    /**
     * Load Gallery data by given Gallery Identity
     *
     * @param string $galleryId
     * @return Gallery
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($galleryId)
    {
        $gallery = $this->galleryFactory->create();
        $this->resource->load($gallery, $galleryId);
        if (!$gallery->getId()) {
            throw new NoSuchEntityException(__('CMS Block with id "%1" does not exist.', $galleryId));
        }
        return $gallery;
    }

     /**
     * Delete Gallery
     *
     * @param \Sandis\Gallery\Api\Data\GalleryInterface $gallery
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\GalleryInterface $gallery)
    {
        try {
            $this->resource->delete($gallery);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Gallery by given Gallery Identity
     *
     * @param string $galleryId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($galleryId)
    {
        return $this->delete($this->getById($galleryId));
    }

}
