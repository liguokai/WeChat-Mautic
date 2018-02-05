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
 * Class Article
 *
 * @package Mautic\WechatBundle\Entity
 */
class Article extends FormEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $thumbMediaId;

    /**
     * @var string
     */
    private $digest;

    /**
     * @var string
     */
    private $sourceUrl;

    /**
     * @var string
     */
    private $showCover;

    /**
     * @var string
     */
    private $tags;

    /**
     * @var string
     */

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata (ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('wechat_message_articles')
            ->setCustomRepositoryClass('Mautic\WechatBundle\Entity\ArticleRepository');

        $builder->addId();

        $builder->createField('name', 'string')
            ->build();

        $builder->createField('title', 'string')
            ->build();

        $builder->createField('author', 'string')
            ->nullable()
            ->build();

        $builder->createField('content', 'string')
            ->nullable()
            ->build();

        $builder->createField('thumbMediaId', 'string')
            ->columnName('thumb_media_id')
            ->nullable()
            ->build();

        $builder->createField('digest', 'string')
            ->nullable()
            ->build();

        $builder->createField('sourceUrl', 'string')
            ->columnName('source_url')
            ->nullable()
            ->build();

        $builder->createField('showCover', 'string')
            ->columnName('show_cover')
            ->nullable()
            ->build();

        $builder->createField('tags', 'string')
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
     * @return mixed
     */
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
    }

    /**
     * @param mixed $thumbMediaId
     */
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
    }

    /**
     * @return mixed
     */
    public function getDigest()
    {
        return $this->digest;
    }

    /**
     * @param mixed $digest
     */
    public function setDigest($digest)
    {
        $this->digest = $digest;
    }

    /**
     * @return mixed
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * @param mixed $sourceUrl
     */
    public function setSourceUrl($sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
    }

    /**
     * @return mixed
     */
    public function getShowCover()
    {
        return $this->showCover;
    }

    /**
     * @param mixed $showCover
     */
    public function setShowCover($showCover)
    {
        $this->showCover = $showCover;
    }

    /**
     * @return tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return tags
     */
    public function getWechatType()
    {
        return null;
    }

    /**
     * @return string
     */
    public function _getName()
    {
        return 'Article';
    }
}
