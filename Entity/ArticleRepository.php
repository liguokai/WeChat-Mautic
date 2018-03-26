<?php
namespace MauticPlugin\MauticWechatBundle\Entity;

use Doctrine\ORM\NoResultException;
use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class ArticleRepository
 *
 * @package MauticPlugin\MauticWechatBundle\Entity
 */
class ArticleRepository extends CommonRepository
{
    /**
     * @param      $smsId
     * @param null $listId
     *
     * @return array
     */
    public function getArticles($Type)
    {
        $q = $this->_em->getConnection()->createQueryBuilder();
        $q->select('article.id')
            ->from(MAUTIC_TABLE_PREFIX . 'wechat_message_articles', 'article')
            ->where('article.id = :id')
            ->setParameter('id', $id);

        $result = $q->execute()->fetchAll();

        return $result;
    }

    /**
     * @return string
     */
    public function getTableAlias()
    {
        return 'article';
    }

}

