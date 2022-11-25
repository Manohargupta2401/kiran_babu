<?php

namespace RoundPartner\MailService;

/**
 * Interface MailServiceInterface
 *
 * @package MailService
 */
interface MailServiceInterface
{
    /**
     * @param array $postData
     *
     * @return \RoundPartner\MailService\Entity\Response
     */
    public function sendMessage($postData);
}
