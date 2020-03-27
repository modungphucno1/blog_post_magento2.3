<?php

namespace Nate\HelloWorld\Controller\Adminhtml\Post;

use Nate\Helloworld\Controller\Adminhtml\Post;
use Nate\Helloworld\Model\PostFactory;

class Save extends Post
{

    public function execute()
    {
        $data = $this->_request->getParam('post');
        $postModel = $this->_postFactory->create();
        $redirect = '*/*/index';
        if (!empty($data['post_id'])) {
            if (!empty($this->_request->getParam('back'))) {
            $redirect = $this->urlBuilder->getUrl(
                static::URL_PATH_EDIT,
                [
                    'post_id' => $data['post_id']
                ]
            );            }

            $postModel->setData('post_id', $data['post_id']);
        }
        $postModel->setData('name', $data['name']);
        $postModel->setData('post_content', $data['post_content']);
        $postModel->setData('status', $data['status']);
        $postModel->save();

        $this->_redirect($redirect);
        $this->messageManager->addSuccess(__('The data has been saved.'));
    }
}