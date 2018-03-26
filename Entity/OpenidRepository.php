<?php
namespace MauticPlugin\WechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class OpenidRepository
 */
class OpenidRepository extends CommonRepository
{
    /**
     * @param string $openId
     *
     * @return array
     */
    public function findByOpenId($openId)
    {
        $q = $this->createQueryBuilder('e')
            ->where('e.openId = :identifier')
            ->setParameter('identifier', strval($openId));

        return $q->getQuery()->getArrayResult();
    }

    /**
     * @param string $accountId, $leaId
     *
     * @return string
     */
    public function getOpenId($accountId, $leaId)
    {
        $q = $this->createQueryBuilder('e')
            ->where('e.account = :accountId and e.lead = :leaId')
            ->setParameter('accountId', strval($accountId))
            ->setParameter('leaId', strval($leaId));

        $ary = $q->getQuery()->getArrayResult();
        if (!isset($ary) || count($ary) == 0) {
            return null;
        } else {
            return $ary[0]['openId'];
        }
    }

    /**
     * @return string
     */
    protected function getDefaultOrder()
    {
        return array(
            array('e.open_id', 'ASC')
        );
    }

    /**
     * @return string
     */
    public function getTableAlias()
    {
        return 'e';
    }
}
