<?php

namespace Charcoal\Tests\Attachment\Object;

use Charcoal\Attachment\Object\Link;

/**
 *
 */
class LinkTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var Link
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

        $this->obj = new Link([
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
        $this->assertEquals('charcoal/attachment/object/link', $this->obj->type());
        $this->assertEquals('link', $this->obj->microType());
    }

    /**
     * @return false
     */
    public function testTypes()
    {
        $this->assertFalse($this->obj->isAccordion());
        $this->assertFalse($this->obj->isAttachmentContainer());
        $this->assertFalse($this->obj->isEmbed());
        $this->assertFalse($this->obj->isFile());
        $this->assertFalse($this->obj->isGallery());
        $this->assertFalse($this->obj->isImage());
        $this->assertTrue($this->obj->isLink());
        $this->assertFalse($this->obj->isText());
        $this->assertFalse($this->obj->isVideo());
    }
}
