<?php

namespace Mautic\WechatBundle\Helper;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Mautic\LeadBundle\Entity\DoNotContact;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\CoreBundle\Factory\MauticFactory;
use Mautic\WechatBundle\Event\WechatSendEvent;
use Mautic\WechatBundle\WechatEvents;
use Mautic\WechatBundle\Entity\Account;
use Mautic\WechatBundle\Entity\Message;

class WechatHelper
{
    /**
     * @var MauticFactory
     */
    protected $factory;

    /**
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param MauticFactory $factory
     * @param               $lead
     * @param               $event
     *
     * @return boolean
     */
    public static function send(MauticFactory $factory, $lead, $event)
    {
        $logger = $factory->getLogger();


        /** @var \Mautic\LeadBundle\Model\LeadModel $leadModel */
        $leadModel = $factory->getModel('lead');
        if ($leadModel->isContactable($lead, 'wechat') !== DoNotContact::IS_CONTACTABLE) {
            return array('failed' => 1);
        }

        $leaId = $lead->getId();
        $campaignId = $event['campaign']['id'];

        if (empty($leaId) || empty($campaignId)) {
            return array('failed' => 1);
        }

        /** @var \Mautic\WechatBundle\Api\AbstractWechatApi $wechat */
        $wechatApi = $factory->getKernel()->getContainer()->get('mautic.wechat.api');

        /** @var \Mautic\WechatBundle\Model\WechatModel $wechatModel */
        $wechatModel = $factory->getModel('wechat');

        $messageId = (int) $event['properties']['message'];
        $logger->info('-------sendWechat: messageId: ' . print_r($messageId, true));
        /** @var array */
        $messageData = $wechatModel->getSendMessage($messageId);
        $campaignModel = $factory->getModel('campaign');

        $accountIds = $campaignModel->getRepository()->findByCampaignId($campaignId);
        foreach ($accountIds as  $key => $value) {
            $account = $wechatModel->getEntity('Account', $value['wechat_account_id']);
            if (empty($account)){
                continue;
            }

            $openId = $wechatModel->getRepository('Openid')->getOpenId($value['wechat_account_id'], $leaId);
            if (empty($openId)){
                continue;
            }

            $logger->info('-------sendWechat: openId: ' . print_r($openId, true));
            $logger->info('-------sendWechat: account: ' . print_r($account, true));
            $logger->info('-------sendWechat: messageData: ' . print_r($messageData, true));

            $metadata = $wechatApi->sendWechat($account, $openId, $messageData);

            // If there was a problem sending at this point, it's an API problem and should be requeued
            if ($metadata === false) {
                return false;
            }
        }

        return array(
            'type' => 'mautic.wechat.message',
            'status' => 'mautic.wechat.timeline.status.delivered',
        );
    }

    public static function validateOpenedArticle($eventDetails = null, $event, $factory)
    {
        $factory->getLogger()->info('-------validateOpenedArticle, begin');
        if ($eventDetails == null) {
            return false;
        }

        return true;
    }
}
