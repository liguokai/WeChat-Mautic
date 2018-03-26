<?php
namespace MauticPlugin\WechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class MessageRepository
 *
 * @package MauticPlugin\WechatBundle\Entity
 */
class MessageRepository extends CommonRepository
{
    /**
     * @param      $smsId
     * @param null $listId
     *
     * @return array
     */
    public function getMessage($Id)
    {
        $q = $this->_em->getConnection()->createQueryBuilder();
        $q->select('m.lead_id')
            ->from(MAUTIC_TABLE_PREFIX . 'wechat_messages', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $Id);

        $result = $q->execute()->fetchAll();

        return $result;
    }

    /**
     * @param string $search
     * @param int    $limit
     * @param int    $start
     *
     * @return array
     */
    public function getMessageList($search = '', $limit = 10, $start = 0)
    {
        $q = $this->createQueryBuilder('m');
        $q->select('partial m.{id, name, title}');

        if (!empty($search)) {
            $q->andWhere($q->expr()->like('m.title', ':search'))
                ->setParameter('search', "{$search}%");
        }

        $q->orderBy('m.title');

        if (!empty($limit)) {
            $q->setFirstResult($start)
                ->setMaxResults($limit);
        }

        return $q->getQuery()->getArrayResult();
    }

    /**
     * @return string
     */
    public function getTableAlias()
    {
        return 'm';
    }

}

