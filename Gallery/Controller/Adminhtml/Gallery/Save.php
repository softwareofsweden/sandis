<?php

namespace Sandis\Gallery\Controller\Adminhtml\Gallery;

use Magento\Backend\App\Action\Context;
use Sandis\Gallery\Api\GalleryRepositoryInterface;
use Sandis\Gallery\Model\Gallery;
use Sandis\Gallery\Model\GalleryFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Save extends \Sandis\Gallery\Controller\Adminhtml\Gallery
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var GalleryFactory
     */
    private $galleryFactory;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param GalleryFactory|null $galleryFactory
     * @param GalleryRepositoryInterface|null $galleryRepository
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        GalleryFactory $galleryFactory = null,
        GalleryRepositoryInterface $galleryRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->galleryFactory = $galleryFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(GalleryFactory::class);
        $this->galleryRepository = $galleryRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(GalleryRepositoryInterface::class);
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Gallery::STATUS_ENABLED;
            }
            if (empty($data['gallery_id'])) {
                $data['gallery_id'] = null;
            }

            /** @var \Sandis\Gallery\Model\Gallery $model */
            $model = $this->galleryFactory->create();

            $id = $this->getRequest()->getParam('gallery_id');
            if ($id) {
                try {
                    $model = $this->galleryRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This gallery no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->galleryRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the gallery.'));
                $this->dataPersistor->clear('image_gallery');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['gallery_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the gallery.'));
            }

            $this->dataPersistor->set('image_gallery', $data);
            return $resultRedirect->setPath('*/*/edit', ['gallery_id' => $this->getRequest()->getParam('gallery_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
