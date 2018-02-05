<?php

return array(
    'routes' => array(
        'main'   => array(
            'mautic_wechat_index'  => array(
                'path'       => '/wechats/{page}',
                'controller' => 'MauticWechatBundle:Account:index'
            ),
            'mautic_wechat_message_action' => array(
                'path'       => '/wechats/message/{objectAction}/{objectId}',
                'controller' => 'MauticWechatBundle:Message:execute'
            ),
            'mautic_wechat_news_action' => array(
                'path'       => '/wechats/news/{objectAction}/{objectId}',
                'controller' => 'MauticWechatBundle:News:execute'
            ),
            'mautic_wechat_article_action' => array(
                'path'       => '/wechats/article/{objectAction}/{objectId}',
                'controller' => 'MauticWechatBundle:Article:execute'
            ),
        ),
        'public' => array(
            'mautic_wechat_event'         => array(
                'path'       => '/wechats/event',
                'controller' => 'MauticWechatBundle:Public:eventAgent'
            ),
        )
    ),
    'services'    => array(
        'events'  => array(
            'mautic.wechat.configbundle.subscriber' => array(
                'class' => 'Mautic\WechatBundle\EventListener\ConfigSubscriber'
            ),
            'mautic.wechat.campaignbundle.subscriber' => array(
                'class' => 'Mautic\WechatBundle\EventListener\CampaignSubscriber'
            )
        ),
        'forms' => array(
            'mautic.form.type.wechatconfig'  => array(
                'class' => 'Mautic\WechatBundle\Form\Type\ConfigType',
                'alias' => 'wechatconfig'
            ),
            'mautic.form.type.account_list'     => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\AccountListType',
                'arguments' => 'mautic.factory',
                'alias'     => 'account_list'
            ),
            'mautic.form.type.accountfollow_list' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\AccountFollowType',
                'arguments' => 'mautic.factory',
                'alias'     => 'accountfollow_list'
            ),
            'mautic.form.type.message' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\MessageType',
                'arguments' => 'mautic.factory',
                'alias'     => 'message'
            ),
            'mautic.form.type.message_list'     => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\MessageListType',
                'arguments' => 'mautic.factory',
                'alias'     => 'message_list'
            ),
            'mautic.form.type.messagesend_list' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\MessageSendType',
                'arguments' => 'mautic.factory',
                'alias'     => 'messagesend_list'
            ),
            'mautic.form.type.news' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\NewsType',
                'arguments' => 'mautic.factory',
                'alias'     => 'news'
            ),
            'mautic.form.type.article' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\ArticleType',
                'arguments' => 'mautic.factory',
                'alias'     => 'article'
            ),
            'mautic.form.type.stat' => array(
                'class'     => 'Mautic\WechatBundle\Form\Type\StatType',
                'arguments' => 'mautic.factory',
                'alias'     => 'stat'
            ),
        ),
        'helpers' => array(
            'mautic.helper.wechat' => array(
                'class'     => 'Mautic\WechatBundle\Helper\WechatHelper',
                'arguments' => 'mautic.factory',
                'alias'     => 'wechat_helper'
            )
        ),
        'other' => array(
            'mautic.wechat.api' => array(
                'class'     => 'Mautic\WechatBundle\Api\WechatApi',
                'arguments' => array(
                    'mautic.factory',
                ),
                'alias' => 'wechat_api'
            )
        )
    ),
    'parameters' => array(
        'wechat_enabled' => false
    )
);
