<?php

namespace MauticPlugin\MauticWechatBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CampaignBundle\Event\CampaignBuilderEvent;
use Mautic\CampaignBundle\CampaignEvents;
use MauticPlugin\MauticWechatBundle\WechatEvents;
use MauticPlugin\MauticWechatBundle\Event\WechatEvent;

/*
 * Class CampaignSubscriber
 *
 * @package MauticWechatBundle
 */
class CampaignSubscriber extends CommonSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            WechatEvents::WECHAT_ON_ARTICLE_OPENED => array('onWechatArticleOpened', 0),
            CampaignEvents::CAMPAIGN_ON_BUILD => array('onCampaignBuild', 0)
        );
    }

    public function onCampaignBuild(CampaignBuilderEvent $event)
    {
        if ($this->factory->getParameter('wechat_enabled')) {
            $action = array(
                'label' =>  'mautic.wechat.campaign.event.send_message',
                'description' => 'mautic.wechat.campaign.event.send_message_descr',
                'callback'         => array('\MauticPlugin\MauticWechatBundle\Helper\WechatHelper', 'send'),
                'formType'        => 'messagesend_list',
                'formTypeOptions'  => array('update_select' => 'campaignevent_properties_message'),
                'formTheme'        => 'MauticSmsBundle:FormTheme\WechatSendList',
            );
            $event->addAction('wechat.send_message', $action);

            $trigger = array(
                'label'           => 'mautic.wechat.campaign.event.account_followed',
                'description'     => 'mautic.wechat.campaign.event.account_followed_descr',
                'formType'        => 'accountfollow_list',
            );
            $event->addLeadDecision('wechat.account_followed', $trigger);

            $trigger = array(
                'label'           => 'mautic.wechat.campaign.event.message_received',
                'description'     => 'mautic.wechat.campaign.event.message_received_descr'
            );
            $event->addLeadDecision('wechat.message_received', $trigger);

            $trigger = array(
                'label'       => 'mautic.wechat.campaign.event.article_opened',
                'description' => 'mautic.wechat.campaign.event.article_opened_descr',
                'callback'         => array('\MauticPlugin\MauticWechatBundle\Helper\WechatHelper', 'validateOpenedArticle'),
            );
            $event->addLeadDecision('wechat.article_opened', $trigger);
        }
    }

    public function onWechatArticleOpened(WechatEvent $event)
    {
        $this->factory->getLogger()->error('--------onWechatArticleOpened');
        $stat = $event->getStat();
        $this->factory->getModel('campaign')->triggerEvent('wechat.article_opened', $stat, 'wechat.article_opened' . $stat->getId());
    }

}
