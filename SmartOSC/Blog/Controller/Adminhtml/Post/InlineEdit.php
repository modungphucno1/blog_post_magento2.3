<?php


namespace SmartOSC\Blog\Controller\Adminhtml\Post;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SmartOSC_Blog::post';

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PostFactory $postFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostFactory $postFactory,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $postId) {
                    /** @var Post $post */
                    $post = $this->blockRepository->getById($post);
                    try {
                        $post->setData(array_merge($post->getData(), $postItems[$post]));
                        $this->blockRepository->save($post);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithPostId(
                            $post,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param Post $post
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPostId(Post $post, $errorText)
    {
        return '[Post ID: ' . $post->getId() . '] ' . $errorText;
    }
}
