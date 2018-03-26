<?php

namespace MauticPlugin\WechatBundle\Form\Type;

use Mautic\CoreBundle\Factory\MauticFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AccountListType
 *
 * @package MauticPlugin\WechatBundle\Form\Type
 */
class AccountListType extends AbstractType
{
    private $repo;

    /**
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory) {
        $this->repo = $factory->getModel('wechat')->getRepository('Account');

        $this->repo->setCurrentUser($factory->getUser());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $repo      = $this->repo;

        $resolver->setDefaults(
            array(
                'choices'     => function (Options $options) use ($repo) {
                    static $choices;

                    if (is_array($choices)) {
                        return $choices;
                    }

                    $choices = array();

                    $accounts  = $repo->getAccountList('', 0, 0);
                    foreach ($accounts as $account) {
                        $choices[$account['id']] = $account['name'];
                    }

                    return $choices;
                },
                'expanded'    => false,
                'multiple'    => true,
                'required'    => false,
                'empty_value' => function (Options $options) {
                    return (empty($options['choices'])) ? 'mautic.wechat.no.accounts.note' : 'mautic.core.form.chooseone';
                },
                'disabled'    => function (Options $options) {
                    return (empty($options['choices']));
                },
            )
        );
    }

    /**
     * @return string
     */
    public function getName() {
        return "account_list";
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'choice';
    }
}
