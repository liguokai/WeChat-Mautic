<?php
namespace MauticPlugin\MauticWechatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Helper\EmojiHelper;

/**
 * Class Account
 *
 * @package MauticPlugin\MauticWechatBundle\Entity
 */
class Account
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
    private $description;

    /**
     * @var string
     */
    private $original_id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $app_id;

    /**
     * @var string
     */
    private $app_secret;

    /**
     * @var string
     */
    private $aes_key;

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata (ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('wechat_accounts')
            ->setCustomRepositoryClass('MauticPlugin\MauticWechatBundle\Entity\AccountRepository');

        $builder->addIdColumns();

        $builder->createField('original_id', 'string')
            ->build();

        $builder->createField('token', 'string')
            ->build();

        $builder->createField('app_id', 'string')
            ->nullable()
            ->build();

        $builder->createField('app_secret', 'string')
            ->nullable()
            ->build();

        $builder->createField('aes_key', 'string')
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $app_id
     *
     * @return $this
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param $app_secret
     *
     * @return $this
     */
    public function setAppSecret($app_secret)
    {
        $this->app_secret = $app_secret;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->app_secret;
    }

    /**
     * @param $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param $aes_key
     *
     * @return $this
     */
    public function setAesKey($aes_key)
    {
        $this->aes_key = $aes_key;

        return $this;
    }

    /**
     * @return string
     */
    public function getAesKey()
    {
        return $this->aes_key;
    }

    /**
     * @return string
     */
    public function _getName()
    {
        return 'Account';
    }
}


