<?php
namespace MauticPlugin\MauticWechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class StatRepository
 *
 * @package MauticPlugin\MauticWechatBundle\Entity
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

