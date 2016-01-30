<?php

namespace Kanboard\Plugin\BitbucketWebhook;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->on('app.bootstrap', function($container) {
            Translator::load($container['config']->getCurrentLanguage(), __DIR__.'/Locale');

            $container['eventManager']->register(WebhookHandler::EVENT_COMMIT, t('Bitbucket commit received'));
            $container['eventManager']->register(WebhookHandler::EVENT_ISSUE_OPENED, t('Bitbucket issue opened'));
            $container['eventManager']->register(WebhookHandler::EVENT_ISSUE_CLOSED, t('Bitbucket issue closed'));
            $container['eventManager']->register(WebhookHandler::EVENT_ISSUE_REOPENED, t('Bitbucket issue reopened'));
            $container['eventManager']->register(WebhookHandler::EVENT_ISSUE_ASSIGNEE_CHANGE, t('Bitbucket issue assignee change'));
            $container['eventManager']->register(WebhookHandler::EVENT_ISSUE_COMMENT, t('Bitbucket issue comment created'));
        });

        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_ISSUE_COMMENT);
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_COMMIT);
        $this->actionManager->getAction('\Kanboard\Action\TaskAssignUser')->addEvent(WebhookHandler::EVENT_ISSUE_ASSIGNEE_CHANGE);
        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_COMMIT);
        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_ISSUE_CLOSED);
        $this->actionManager->getAction('\Kanboard\Action\TaskCreation')->addEvent(WebhookHandler::EVENT_ISSUE_OPENED);
        $this->actionManager->getAction('\Kanboard\Action\TaskOpen')->addEvent(WebhookHandler::EVENT_ISSUE_REOPENED);

        $this->template->hook->attach('template:project:integrations', 'BitbucketWebhook:project/integrations');

        $this->route->addRoute('/webhook/bitbucket/:project_id/:token', 'webhook', 'handler', 'BitbucketWebhook');
    }

    public function getPluginName()
    {
        return 'Bitbucket Webhook';
    }

    public function getPluginDescription()
    {
        return t('Bind Bitbucket webhook events to Kanboard automatic actions');
    }

    public function getPluginAuthor()
    {
        return 'Frédéric Guillot';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-bitbucket-webhook';
    }
}
