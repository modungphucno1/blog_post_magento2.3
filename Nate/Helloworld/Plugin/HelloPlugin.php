<?php
namespace Nate\Helloworld\Plugin;

class HelloPlugin
{
    public function beforeSayHello(\Nate\Helloworld\Block\Display $subject)
    {
        echo '<br> Hi';
    }

    public function afterSayHello(\Nate\Helloworld\Block\Display $subject,$result)
    {
        echo '<br> Goodbye';
        return $result;
    }

    public function aroundSayHello(\Nate\Helloworld\Block\Display $subject,\Closure $proceed)
    {
        echo '<br> step1';
        $proc = $proceed();
        echo '<br> step2';
        return $proc;
    }
}