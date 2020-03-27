<?php
namespace Nate\Helloworld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Nate\Helloworld\Model\PostFactory $postFactory
    )
    {

        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
//        $test = 'xyz->';
//        echo $test;
//        $this->_eventManager->dispatch('nate_helloworld_display_text', [
//            'data_send' => $test,
//        ]);
        return $this->_pageFactory->create();
    }
}
