<?php

namespace MauticPlugin\MauticSocialBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;
use Symfony\Component\Form\Form;

/**
 * Class TweetController.
 */
class TweetController extends FormController
{
    /**
     * @return mixed
     */
    protected function getModelName()
    {
        return 'social.tweet';
    }

    /**
     * @return mixed
     */
    protected function getJsLoadMethodPrefix()
    {
        return 'socialTweet';
    }

    /**
     * @return mixed
     */
    protected function getRouteBase()
    {
        return 'mautic_tweet';
    }

    /**
     * @param null $objectId
     *
     * @return mixed
     */
    protected function getSessionBase($objectId = null)
    {
        return 'mautic_tweet';
    }

    /**
     * @return mixed
     */
    protected function getTemplateBase()
    {
        return 'MauticSocialBundle:Tweet';
    }

    /**
     * @return mixed
     */
    protected function getTranslationBase()
    {
        return 'mautic.integration.Twitter';
    }

    /**
     * @return mixed
     */
    protected function getPermissionBase()
    {
        return 'mauticSocial:tweets';
    }

    /**
     * Define options to pass to the form when it's being created.
     *
     * @return array
     */
    protected function getEntityFormOptions()
    {
        return [
            'update_select'      => $this->getUpdateSelect(),
            'allow_extra_fields' => true,
        ];
    }

    /**
     * Get updateSelect value from request.
     *
     * @return string|bool
     */
    public function getUpdateSelect()
    {
        return ('POST' == $this->request->getMethod())
            ? $this->request->request->get('twitter_tweet[updateSelect]', false, true)
            : $this->request->get('updateSelect', false);
    }

    /**
     * Set custom form themes, etc.
     *
     * @param string $action
     *
     * @return \Symfony\Component\Form\FormView
     */
    protected function getFormView(Form $form, $action)
    {
        return $form->createView();
    }

    /**
     * @param int $page
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function indexAction($page = 1)
    {
        return parent::indexStandard($page);
    }

    /**
     * Generates new form and processes post data.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function newAction()
    {
        return parent::newStandard();
    }

    /**
     * Get the template file.
     *
     * @param $file
     *
     * @return string
     */
    protected function getTemplateName($file, string $engine = self::ENGINE_TWIG)
    {
        if (('form.html.twig' === $file) && 1 == $this->request->get('modal')) {
            return parent::getTemplateName('form.modal.html.twig');
        }

        if ('form.html.twig' === $file && 1 == $this->request->get('modal')) {
            return parent::getTemplateName('form.modal.html.twig', $engine);
        }

        return parent::getTemplateName($file, $engine);
    }

    /**
     * Generates edit form and processes post data.
     *
     * @param int  $objectId
     * @param bool $ignorePost
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function editAction($objectId, $ignorePost = false)
    {
        return parent::editStandard($objectId, $ignorePost);
    }

    /**
     * Displays details.
     *
     * @param $objectId
     *
     * @return array|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function viewAction($objectId)
    {
        return $this->forward('MauticPlugin\MauticSocialBundle\Controller\TweetController::editAction', [
            'objectId' => $objectId,
        ]);
    }

    /**
     * Clone an entity.
     *
     * @param int $objectId
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function cloneAction($objectId)
    {
        return parent::cloneStandard($objectId);
    }

    /**
     * Deletes the entity.
     *
     * @param int $objectId
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($objectId)
    {
        return parent::deleteStandard($objectId);
    }

    /**
     * Deletes a group of entities.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function batchDeleteAction()
    {
        return parent::batchDeleteStandard();
    }
}
