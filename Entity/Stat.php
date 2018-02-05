<?php

namespace Mautic\WechatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\FormEntity;
use Mautic\CoreBundle\Helper\EmojiHelper;
use Mautic\CoreBundle\Entity\IpAddress;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\LeadBundle\Entity\LeadList;

/**
 * Class Stat
 *
 * @package Mautic\WechatBundle\Entity
 */
class Stat extends FormEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \Mautic\LeadBundle\WechatEntity\Account
     */
    private $account;

    /**
     * @var \Mautic\LeadBundle\WechatEntity\Message
     */
    private $message;

    /**
     * @var \Mautic\LeadBundle\WechatEntity\Article
     */
    private $article;

    /**
     * @var \Mautic\LeadBundle\WechatEntity\News
     */
    private $news;

    /**
     * @var \Mautic\LeadBundle\Entity\Lead
     */
    private $lead;

    /**
     * @var \Mautic\LeadBundle\Entity\LeadList
     */
    private $list;

    /**
     * @var \Mautic\CoreBundle\Entity\IpAddress
     */
    private $ipAddress;

    /**
     * @var \DateTime
     */
    private $dateSent;

    /**
     * @var \DateTime
     */
    private $dateRead;

    /**
     * @var string
     */
    private $eventType;

    /**
    * @var string
    */
    private $openId;

    /**
    * @var string
    */
    private $originalId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata (ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('wechat_stats')
            ->setCustomRepositoryClass('Mautic\WechatBundle\Entity\StatRepository')
            ->addIndex(array('account_id', 'lead_id'), 'stat_wechat_search')
            ->addIndex(array('message_id'), 'stat_wechat_message_search')
            ->addIndex(array('article_id'), 'stat_wechat_article_search')
            ->addIndex(array('news_id'), 'stat_wechat_news_search')
            ->addIndex(array('event_type'), 'stat_wechat_event_type_search');

        $builder->addId();

        $builder->createManyToOne('account', 'Mautic\WechatBundle\Entity\Account')
            ->inversedBy('stats')
            ->addJoinColumn('account_id', 'id', true, false, 'SET NULL')
            ->build();

        $builder->createManyToOne('message', 'Mautic\WechatBundle\Entity\Message')
            ->inversedBy('stats')
            ->addJoinColumn('message_id', 'id', true, false, 'SET NULL')
            ->build();

        $builder->createManyToOne('article', 'Mautic\WechatBundle\Entity\Article')
            ->inversedBy('stats')
            ->addJoinColumn('article_id', 'id', true, false, 'SET NULL')
            ->build();

        $builder->createManyToOne('news', 'Mautic\WechatBundle\Entity\News')
            ->inversedBy('stats')
            ->addJoinColumn('news_id', 'id', true, false, 'SET NULL')
            ->build();

        $builder->createManyToOne('list', 'Mautic\LeadBundle\Entity\LeadList')
            ->addJoinColumn('list_id', 'id', true, false, 'SET NULL')
            ->build();

        $builder->addLead(true, 'SET NULL');
        $builder->addIpAddress(true);

        $builder->createField('eventType', 'string')
            ->columnName('event_type')
            ->nullable()
            ->build();

        $builder->createField('openId', 'string')
            ->columnName('open_id')
            ->nullable()
            ->build();

        $builder->createField('originalId', 'string')
            ->columnName('original_id')
            ->nullable()
            ->build();

        $builder->createField('content', 'string')
            ->nullable()
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
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount(Account $account = null)
    {
        $this->account = $account;
    }

    /**
     * @param $mixed $message
     */
    public function setMessage(Message $message = null)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $mixed  $article
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param $mixed  $news
     */
    public function setNews(News $news = null)
    {
        $this->news = $news;
    }

    /**
     * @return News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @return Lead
     */
    public function getLead ()
    {
        return $this->lead;
    }

    /**
     * @param mixed $lead
     */
    public function setLead (Lead $lead = null)
    {
        $this->lead = $lead;
    }

    /**
     * @return \Mautic\LeadBundle\Entity\LeadList
     */
    public function getList ()
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList ($list)
    {
        $this->list = $list;
    }

    /**
     * @return IpAddress
     */
    public function getIpAddress ()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ip
     */
    public function setIpAddress (IpAddress $ip)
    {
        $this->ipAddress = $ip;
    }

    /**
     * @return mixed
     */
    public function getDateSent ()
    {
        return $this->dateSent;
    }

    /**
     * @param mixed $dateSent
     */
    public function setDateSent ($dateSent)
    {
        $this->dateSent = $dateSent;
    }

    /**
     * @return mixed
     */
    public function getDateRead ()
    {
        return $this->dateRead;
    }

    /**
     * @param mixed $dateSent
     */
    public function setDateRead ($dateRead)
    {
        $this->dateRead = $dateRead;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param mixed $eventType
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getOpenId ()
    {
        return $this->openId;
    }

    /**
     * @param mixed $openId
     */
    public function setOpenId ($openId)
    {
        $this->openId = $openId;
    }

    /**
     * @return mixed
     */
    public function getOriginalId ()
    {
        return $this->originalId;
    }

    /**
     * @param mixed $originalId
     */
    public function setOriginalId ($originalId)
    {
        $this->originalId = $originalId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


    /**
     * @return string
     */
    public function _getName()
    {
        return 'Stat';
    }

}
