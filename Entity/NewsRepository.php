<?php
namespace MauticPlugin\WechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class NewsRepository
 *
 * @package MauticPlugin\WechatBundle\Entity
 */
class NewsRepository extends CommonRepository
{
    /**
     * @param      $smsId
     * @param null $listId
     *
     * @return array
     */
    public function getNews($id)
    {
        $q = $this->_em->getConnection()->createQueryBuilder();
        $q->select('news.id')
            ->from(MAUTIC_TABLE_PREFIX . 'wechat_message_news', 'news')
            ->where('news.id = :id')
            ->setParameter('id', $id);

        $result = $q->execute()->fetchAll();

        return $result;
    }

    /**
     * @return string
     */
    public function getTableAlias()
    {
        return 'news';
    }

}

