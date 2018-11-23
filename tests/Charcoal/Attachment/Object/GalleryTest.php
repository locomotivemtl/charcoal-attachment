<?php

namespace Charcoal\Tests\Attachment\Object;

use Charcoal\Attachment\Object\Gallery;

/**
 *
 */
class GalleryTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var Gallery
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

        $this->obj = new Gallery([
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
        $this->assertEquals('charcoal/attachment/object/gallery', $this->obj->type());
        $this->assertEquals('gallery', $this->obj->microType());
    }

    /**
     * @return false
     */
    public function testTypes()
    {
        $this->assertFalse($this->obj->isAccordion());
        $this->assertTrue($this->obj->isAttachmentContainer());
        $this->assertFalse($this->obj->isEmbed());
        $this->assertFalse($this->obj->isFile());
        $this->assertTrue($this->obj->isGallery());
        $this->assertFalse($this->obj->isImage());
        $this->assertFalse($this->obj->isLink());
        $this->assertFalse($this->obj->isText());
        $this->assertFalse($this->obj->isVideo());
    }
}
