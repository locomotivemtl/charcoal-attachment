<?php

namespace Charcoal\Tests\Attachment\Traits;

use Charcoal\Attachment\Traits\AttachmentAwareTrait;

/**
 *
 */
class AttachmentAwareTraitTest extends \PHPUnit\Framework\TestCase
{
    use \Charcoal\Tests\ContainerIntegrationTrait;

    /**
     * @var AttachmentAwareTrait
     */
    private $obj;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->obj = $this->getMockForTrait(AttachmentAwareTrait::class);
    }


    public function testGetAttachments()
    {
        //$ret = $this->obj->getAttachments();
        //$this->assertEquals([], $ret);
    }
}
