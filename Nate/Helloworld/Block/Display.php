<?php
namespace Nate\Helloworld\Block;
class Display extends \Magento\Framework\View\Element\Template
{
    protected $_postFactory;
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
    \Nate\Helloworld\Model\PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function sayHello()
    {
        var_dump('123');
        return __('<br> Hello World');
    }
    public function getPostCollection(){
        $post = $this->_postFactory->create();
        return $post->getCollection();
    }
}