<?php

namespace MauticPlugin\WechatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\FormEntity;
use Mautic\CoreBundle\Helper\EmojiHelper;
use Mautic\CoreBundle\Entity\IpAddress;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\LeadBundle\Entity\LeadList;

/**
 * Class Openid
 *
 * @package MauticPlugin\WechatBundle\Entity
 */
class Openid
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $openId;

    /**
     * @var \Mautic\LeadBundle\Entity\Lead
     */
    private $lead;

    /**
     * @var \Mautic\LeadBundle\WechatEntity\Account
     */
    private $account;

    /**
     * @var bool
     */
    private $followed;

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata (ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('wechat_openids')
            ->setCustomRepositoryClass('MauticPlugin\WechatBundle\Entity\OpenidRepository')
            ->addIndex(array('open_id'), 'wechat_openids_openid_search');

        $builder->addId();

        $builder->createField('openId', 'string')
            ->columnName('open_id')
            ->build();

        $builder->createManyToOne('lead', 'Mautic\LeadBundle\Entity\Lead')
            ->inversedBy('wechat_openids')
            ->addJoinColumn('lead_id', 'id', false, false, 'CASCADE')
            ->build();

        $builder->createManyToOne('account', 'MauticPlugin\WechatBundle\Entity\Account')
            ->inversedBy('wechat_openids')
            ->addJoinColumn('account_id', 'id', false, false, 'CASCADE')
            ->build();

        $builder->createField('followed', 'boolean')
            ->columnName('followed')
            ->build();
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * @param $openId
     *
     * @return $this
     */
    public function setOpenId($openId)
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * @param $lead
     *
     * @return $this
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param $this
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param $followd
     *
     * @return $this
     */
    public function setFollowed($followed)
    {
        $this->followed = $followed;

        return $this;
    }

    /**
     * @return bool
     */
    public function getFollowed()
    {
        return $this->followed;
    }

    /**
     * @return string
     */
    public function _getName()
    {
        return 'Openid';
    }
}
