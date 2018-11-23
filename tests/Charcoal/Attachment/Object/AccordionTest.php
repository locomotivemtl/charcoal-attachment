<?php

namespace Charcoal\Tests\Attachment\Object;

use Charcoal\Attachment\Object\Accordion;

/**
 *
 */
class AccordionTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var Accordion
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

        $this->obj = new Accordion([
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
        $this->assertEquals('charcoal/attachment/object/accordion', $this->obj->type());
        $this->assertEquals('accordion', $this->obj->microType());
    }

    /**
     * @return false
     */
    public function testTypes()
    {
        $this->assertTrue($this->obj->isAccordion());
        $this->assertTrue($this->obj->isAttachmentContainer());
        $this->assertFalse($this->obj->isEmbed());
        $this->assertFalse($this->obj->isFile());
        $this->assertFalse($this->obj->isGallery());
        $this->assertFalse($this->obj->isImage());
        $this->assertFalse($this->obj->isLink());
        $this->assertFalse($this->obj->isText());
        $this->assertFalse($this->obj->isVideo());
    }
}
