<?php
namespace MauticPlugin\WechatBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;
use Mautic\CoreBundle\Helper\BuilderTokenHelper;
use Mautic\CoreBundle\Helper\EmojiHelper;
use Mautic\CoreBundle\Helper\InputHelper;
use Mautic\CoreBundle\Templating\TemplateNameParser;
use MauticPlugin\WechatBundle\WechatEvents;
use MauticPlugin\WechatBundle\Entity;
use MauticPlugin\WechatBundle\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class PublicController extends FormController
{
    /**
     * Generates new form and processes post data
     *
     * @param  Stat $entity
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function eventAgentAction($entity = null)
    {
        $model = $this->factory->getModel('wechat');

        if (!$entity instanceof Stat) {
            /** @var \MauticPlugin\WechatBundle\Entity\Wechat $entity */
            $entity  = $model->getEntity('Stat');
        }

        $request = $this->request;

        $method  = $request->getMethod();

        $openId =  $request->get('openId');
        $originalId =  $request->get('originalId');
        $eventType = $request->get('eventType');

        if ($method == 'POST') {
            $entity->setOpenId($openId);
            $entity->setOriginalId($originalId);
            $entity->setEventType($eventType);
            $model->processWechatEvent($entity, $request);

            return new Response('{"status":200, "message":"ok"}', 200, array('Content-Type' => 'application/json;charset=UTF-8'));
        }else{
            return new Response('{"status":4000, "message":"This method is not supported."}', 200, array('Content-Type' => 'application/json;charset=UTF-8'));
        }
    }
}
