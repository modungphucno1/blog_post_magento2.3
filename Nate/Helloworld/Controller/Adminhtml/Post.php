<?php

namespace Nate\Helloworld\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use \Nate\Helloworld\Model\PostFactory;

class Post extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Result page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * News model factory
     *
     * @var \Nate\Helloworld\Model\PostFactory
     */
    protected $_postFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param PostFactory $postFactory
     */
    protected $urlBuilder;

    const URL_PATH_EDIT = 'nate_helloworld/post/edit';
    const URL_PATH_DELETE = 'nate_helloworld/post/delete';
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        PostFactory $postFactory,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * News access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tutorial_SimpleNews::manage_post');
    }

    public function execute()
    {
    }
}
