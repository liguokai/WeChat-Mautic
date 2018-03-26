<?php
namespace MauticPlugin\MauticWechatBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\ConfigBundle\ConfigEvents;
use Mautic\ConfigBundle\Event\ConfigBuilderEvent;

/**
 * Class ConfigSubscriber
 *
 * @package MauticPlugin\MauticWechatBundle\EventListener
 */
class ConfigSubscriber extends CommonSubscriber
{

    /**
     * @return array
     */
    static public function getSubscribedEvents ()
    {
        return array(
            ConfigEvents::CONFIG_ON_GENERATE => array('onConfigGenerate', 0)
        );
    }

    public function onConfigGenerate (ConfigBuilderEvent $event)
    {
        $event->addForm(array(
            'bundle'     => 'WechatBundle',
            'formAlias'  => 'wechatconfig',
            'formTheme'  => 'MauticWechatBundle:FormTheme\Config',
            'parameters' => $event->getParametersFromConfig('MauticWechatBundle')
        ));
    }
}
