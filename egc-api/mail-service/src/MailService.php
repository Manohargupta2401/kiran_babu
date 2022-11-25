<?php

namespace RoundPartner\MailService;

use Mailgun\Connection\Exceptions\MissingRequiredParameters;
use MailService\Entity\Configuration;
use MailService\Entity\Response;

/**
 * Class MailService
 *
 * @package MailService
 */
class MailService implements MailServiceInterface
{

    /**
     * @var MailServiceInterface
     */
    protected $plugin;

    /**
     * @var Response
     */
    protected $response;

    /**
     * MailService constructor.
     *
     * @param Configuration $config
     */
    public function __construct($config)
    {
        $this->plugin = PluginFactory::getPlugin($config);
    }

    /**
     * @param MailServiceInterface $plugin
     *
     * @return MailService
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;
        return $this;
    }

    /**
     * @return MailServiceInterface
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * @param array $postData
     *
     * @return bool
     */
    public function sendMessage($postData)
    {
        try {
            $this->response = $this->plugin->sendMessage($postData);
        } catch (MissingRequiredParameters $exception) {
            return false;
        }
        if ($this->response->responseCode == 200) {
            return true;
        }
        return false;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
