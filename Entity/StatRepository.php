<?php
namespace Mautic\WechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class StatRepository
 *
 * @package Mautic\WechatBundle\Entity
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

