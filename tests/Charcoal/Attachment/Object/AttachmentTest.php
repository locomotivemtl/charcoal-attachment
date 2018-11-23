<?php

namespace Charcoal\Tests\Attachment\Object;

use InvalidArgumentException;

use Charcoal\Attachment\Object\Attachment;

/**
 *
 */
class AttachmentTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var Attachment
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
        $this->obj = new Attachment([
            'logger' => $container['logger'],
            'metadata_loader' => $container['metadata/loader'],
            'container' => $container
        ]);
    }

    /**
     * @return void
     */
    public function testDefaults()
    {
        $this->assertEquals('charcoal/attachment/object/attachment', $this->obj->type());
        $this->assertEquals('attachment', $this->obj->microType());

        $this->assertTrue($this->obj->showTitle());
        $this->assertEquals('', $this->obj->title());
        $this->assertNull($this->obj->subtitle());
        $this->assertNull($this->obj->description());
        $this->assertNull($this->obj->keywords());
        $this->assertNull($this->obj->file());
        $this->assertNull($this->obj->fileLabel());
        $this->assertNull($this->obj->fileSize());
        $this->assertNull($this->obj->fileType());
        $this->assertNull($this->obj->link());
        $this->assertNull($this->obj->linkLabel());
        $this->assertNull($this->obj->thumbnail());
        $this->assertNull($this->obj->embed());
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
        $this->assertFalse($this->obj->isLink());
        $this->assertFalse($this->obj->isText());
        $this->assertFalse($this->obj->isVideo());
    }

    public function testSetType()
    {
        $this->assertEquals('charcoal/attachment/object/attachment', $this->obj->type());
        $ret = $this->obj->setType('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->type());

        $this->expectException(InvalidArgumentException::class);
        $this->obj->setType(0);
    }

    public function testSetTitle()
    {
        $this->assertEquals('', $this->obj->title());
        $ret = $this->obj->setTitle('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->title());
    }

    public function testSetShowTitle()
    {
        $this->assertTrue($this->obj->showTitle());
        $ret = $this->obj->setShowTitle(false);
        $this->assertSame($ret, $this->obj);
        $this->assertFalse($this->obj->showTitle());
    }

    public function testSetSubtitle()
    {
        $this->assertEquals('', $this->obj->subtitle());
        $ret = $this->obj->setSubtitle('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->subtitle());
    }

    public function testSetDescription()
    {
        $this->assertEquals('', $this->obj->description());
        $ret = $this->obj->setDescription('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->description());
    }

    public function testSetKeywords()
    {
        $this->assertEquals('', $this->obj->keywords());
        $ret = $this->obj->setKeywords('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->keywords());
    }

    public function testSetThumbnail()
    {
        $this->assertEquals('', $this->obj->thumbnail());
        $ret = $this->obj->setThumbnail('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->thumbnail());
    }

    public function testSetFile()
    {
        $this->assertEquals('', $this->obj->file());
        $ret = $this->obj->setFile('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->file());
    }

    public function testSetLink()
    {
        $this->assertEquals('', $this->obj->link());
        $ret = $this->obj->setLink('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->link());
    }

    public function testSetFileLabel()
    {
        $this->assertEquals('', $this->obj->fileLabel());
        $ret = $this->obj->setFileLabel('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->fileLabel());
    }

    public function testSetLinkLabel()
    {
        $this->assertEquals('', $this->obj->linkLabel());
        $ret = $this->obj->setLinkLabel('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->linkLabel());
    }

    public function testSetEmbed()
    {
        $this->assertEquals('', $this->obj->embed());
        $ret = $this->obj->setEmbed('foo');
        $this->assertSame($ret, $this->obj);
        $this->assertEquals('foo', $this->obj->embed());
    }
}
