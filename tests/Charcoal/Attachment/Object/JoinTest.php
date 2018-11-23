<?php

namespace Charcoal\Tests\Attachment\Object;

use Charcoal\Attachment\Object\Join;

/**
 *
 */
class JoinTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var Join
     */
    private $obj;

    /**
     * @return void
     */
    public function setUp()
    {
        $container = $this->getContainer();

        $provider = $this->getContainerProvider();
        $provider->registerBaseUrl($container);
        $provider->registerModelFactory($container);
        $provider->registerCollectionLoader($container);

        $this->obj = new Join([
            'logger'            => $container['logger'],
            'metadata_loader'   => $container['metadata/loader'],
            'container'         => $container
        ]);
    }

    /**
     * @return void
     */
    public function testDefaults()
    {
        $this->assertNull($this->obj->objectType());
        $this->assertNull($this->obj->objectId());
        $this->assertNull($this->obj->attachmentId());
        $this->assertNull($this->obj->group());
    }
}
