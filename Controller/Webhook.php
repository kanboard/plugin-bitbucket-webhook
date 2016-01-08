<?php

namespace Kanboard\Plugin\BitbucketWebhook\Controller;

use Kanboard\Controller\Base;
use Kanboard\Plugin\BitbucketWebhook\WebhookHandler;

/**
 * Webhook Controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Webhook extends Base
{
    /**
     * Handle Bitbucket webhooks
     *
     * @access public
     */
    public function handler()
    {
        $this->checkWebhookToken();

        $bitbucketWebhook = new WebhookHandler($this->container);
        $bitbucketWebhook->setProjectId($this->request->getIntegerParam('project_id'));

        $result = $bitbucketWebhook->parsePayload(
            $this->request->getHeader('X-Event-Key'),
            $this->request->getJson()
        );

        echo $result ? 'PARSED' : 'IGNORED';
    }
}
