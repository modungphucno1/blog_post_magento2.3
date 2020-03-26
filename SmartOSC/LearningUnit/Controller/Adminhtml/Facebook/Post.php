<?php

namespace SmartOSC\LearningUnit\Controller\Adminhtml\Facebook;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;

class Post extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SmartOSC_LearningUnit::fb_post');
    }
}
