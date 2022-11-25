<?php

namespace RoundPartner\Tests\Unit;

/**
 * Class MailServiceFactoryTest
 */
class MailServiceFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests factory methods
     */
    public function testCreateMailService()
    {
        $service = \RoundPartner\MailService\MailServiceFactory::createService('testkey', 'mailinator.com');
        $this->assertInstanceOf('\RoundPartner\MailService\MailService', $service);
    }
}
