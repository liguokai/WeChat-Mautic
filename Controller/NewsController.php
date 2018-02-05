<?php
namespace Mautic\WechatBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;
use Mautic\CoreBundle\Helper\BuilderTokenHelper;
use Mautic\CoreBundle\Helper\EmojiHelper;
use Mautic\CoreBundle\Helper\InputHelper;
use Mautic\CoreBundle\Templating\TemplateNameParser;
use Mautic\WechatBundle\WechatEvents;
use Mautic\WechatBundle\Entity;
use Mautic\WechatBundle\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class NewsController extends FormController
{
    /**
     * Generates new form and processes post data
     *
     * @param  News $entity
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction($entity = null)
    {
        $model = $this->factory->getModel('wechat');

        if (!$entity instanceof News) {
            /** @var \Mautic\WechatBundle\Entity\Wechat $entity */
            $entity  = $model->getEntity('News');
        }

        $method  = $this->request->getMethod();
        $session = $this->factory->getSession();

        //set the page we came from
        $page   = $session->get('mautic.wechat.page', 1);
        $action = $this->generateUrl('mautic_wechat_news_action', array('objectAction' => 'new'));

        //create the form
        $form = $model->createForm($entity, $this->get('form.factory'), $action, array('csrf_protection' => false));

        if ($method == 'POST') {
            if (! $cancelled = $this->isFormCancelled($form)) {
                if ($this->isFormValid($form)) {
                    //form is valid so process the data
                    $model->saveEntity($entity);
                }else{
                    return new Response("<html>isFormValid invalid!!!!!!!!!!!</html>", 200, array('Content-Type' => 'text/html; charset=utf-8'));
                }
            }
        }

        return new Response("<html>news new test controller!!!!!!!!!!!</html>", 200, array('Content-Type' => 'text/html; charset=utf-8'));
    }

}
