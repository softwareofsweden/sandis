<?php

namespace Sandis\Gallery\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Image Gallery CRUD interface.
 */
interface GalleryRepositoryInterface
{
    /**
     * Save gallery.
     *
     * @param \Sandis\Gallery\Api\Data\GalleryInterface $gallery
     * @return \Sandis\Gallery\Api\Data\GalleryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\GalleryInterface $gallery);

    /**
     * Retrieve gallery.
     *
     * @param int $galleryId
     * @return \Sandis\Gallery\Api\Data\GalleryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($galleryId);

    /**
     * Delete gallery.
     *
     * @param \Sandis\Gallery\Api\Data\GalleryInterface $gallery
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\GalleryInterface $gallery);

    /**
     * Delete gallery by ID.
     *
     * @param int $galleryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($galleryId);
}
