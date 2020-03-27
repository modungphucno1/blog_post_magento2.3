<?php

namespace Nate\Helloworld\Observer;

class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('data_send');
        $displayText .= '123';
        echo $displayText;
        return $this;
    }
}