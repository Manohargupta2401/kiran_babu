<?php

namespace RoundPartner\Tests\Unit;

/**
 * Class PluginFactoryTest
 */
class PluginFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that a plugin can be loaded
     */
    public function testGetPlugin()
    {
        $config = new \RoundPartner\MailService\Entity\Configuration();
        $config->plugin = 'MailGun';
        $plugin = \RoundPartner\MailService\PluginFactory::getPlugin($config);
        $this->assertInstanceOf('\RoundPartner\MailService\Plugin\MailGun', $plugin);
    }

    /**
     * Tests that unknown plugins can be handled
     */
    public function testGetUnknownPlugin()
    {
        $this->setExpectedException('\Exception', 'Plugin FooBar not found.');
        $config = new \RoundPartner\MailService\Entity\Configuration();
        $config->plugin = 'FooBar';
        \RoundPartner\MailService\PluginFactory::getPlugin($config);
    }
}
