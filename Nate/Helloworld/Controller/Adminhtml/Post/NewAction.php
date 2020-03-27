<?php

namespace Nate\Helloworld\Controller\Adminhtml\Post;


use Nate\Helloworld\Controller\Adminhtml\Post;

class NewAction extends Post
{
    /**
     * Create new news action
     *
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}