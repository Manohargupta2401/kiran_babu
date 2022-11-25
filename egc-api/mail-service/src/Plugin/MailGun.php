<?php

namespace RoundPartner\MailService\Plugin;

use RoundPartner\MailService\Entity\Configuration;
use RoundPartner\MailService\MailServiceInterface;
use RoundPartner\MailService\Entity\Response;
use RoundPartner\MailService\Entity\ResponseBody;

class MailGun implements MailServiceInterface
{

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var \Mailgun\Mailgun
     */
    protected $service;

    /**
     * MailGun constructor.
     *
     * @param Configuration $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->service = new \Mailgun\Mailgun($config->key);
    }

    /**
     * @param $service
     *
     * @return MailGun
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param array $postData
     *
     * @return \RoundPartner\MailService\Entity\Response
     */
    public function sendMessage($postData)
    {
        $response = $this->service->sendMessage($this->config->endpoint, $postData);
        return $this->getResponseFromJson($response);
    }

    /**
     * @param $response
     * @return Response
     */
    private function getResponseFromJson($response)
    {
        $responseEntity = new Response();
        $responseEntity->responseCode = $response->http_response_code;
        $responseEntity->body = $this->getResponseBodyFromJson($response->http_response_body);
        return $responseEntity;
    }

    /**
     * @param $body
     * @return ResponseBody
     */
    private function getResponseBodyFromJson($body)
    {
        $responseBody = new ResponseBody();
        $responseBody->id = $body->id;
        $responseBody->message = $body->message;
        return $responseBody;
    }
}
