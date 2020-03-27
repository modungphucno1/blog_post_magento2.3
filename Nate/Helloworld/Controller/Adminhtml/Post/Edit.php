<?php

namespace Nate\Helloworld\Controller\Adminhtml\Post;

use Nate\Helloworld\Controller\Adminhtml\Post;

class Edit extends Post
{
    public function execute()
    {
        $newsId = $this->getRequest()->getParam('post_id');
        $model = $this->_postFactory->create();

        if ($newsId) {
            $model->load($newsId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('helloworld_post', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Nate_Helloworld::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Post'));

        return $resultPage;
    }
}
