<?php

namespace Mautic\WechatBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ConfigType
 *
 * @package Mautic\WechatBundle\Form\Type
 */
class ConfigType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'wechat_enabled',
            'yesno_button_group',
            array(
                'label' => 'mautic.wechat.config.form.wechat.enabled',
                'data'  => (bool) $options['data']['wechat_enabled'],
                'attr'  => array(
                    'tooltip' => 'mautic.wechat.config.form.wechat.enabled.tooltip'
                )
            )
        );

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'wechatconfig';
    }
}
