<?php

namespace Sandis\Gallery\Api\Data;

/**
 * Image Gallery interface.
 */
interface GalleryInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const GALLERY_ID      = 'gallery_id';
    const IDENTIFIER    = 'identifier';
    const TITLE         = 'title';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return GalleryInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return GalleryInterface
     */
    public function setIdentifier($identifier);

    /**
     * Set title
     *
     * @param string $title
     * @return GalleryInterface
     */
    public function setTitle($title);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return GalleryInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return GalleryInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return GalleryInterface
     */
    public function setIsActive($isActive);
}
