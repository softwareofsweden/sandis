<?php

namespace Sandis\Gallery\Controller\Adminhtml\Gallery;

class Delete extends \Sandis\Gallery\Controller\Adminhtml\Gallery
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('gallery_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Sandis\Gallery\Model\Gallery::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the gallery.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['gallery_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a gallery to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
