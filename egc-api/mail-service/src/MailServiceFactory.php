<?php

namespace RoundPartner\MailService;

use RoundPartner\MailService\Entity\Configuration;

/**
 * Class MailServiceFactory
 *
 * @package MailService
 */
class MailServiceFactory
{

    const DEFAULT_PLUGIN = 'MailGun';

    /**
     * Factory method to create new mail service
     *
     * @param string $key
     * @param string $endpoint
     * @return MailService
     */
    public static function createService($key, $endpoint)
    {
        $config = new Configuration();
        $config->plugin = self::DEFAULT_PLUGIN;
        $config->key = $key;
        $config->endpoint = $endpoint;
        return new MailService($config);
    }
}
