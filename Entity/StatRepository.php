<?php
namespace MauticPlugin\WechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class StatRepository
 *
 * @package MauticPlugin\WechatBundle\Entity
 */
class StatRepository extends CommonRepository
{
    /**
     * @return string
     */
    public function getTableAlias()
    {
        return 'stat';
    }

}

