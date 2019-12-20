<?php

namespace Charcoal\Attachment\Traits;

use InvalidArgumentException;

// From 'charcoal-attachment'
use Charcoal\Attachment\Interfaces\AttachableInterface;
use Charcoal\Attachment\Interfaces\AttachmentAwareInterface;
use Charcoal\Attachment\Interfaces\AttachmentContainerInterface;
use Charcoal\Attachment\Interfaces\JoinInterface;
use Charcoal\Attachment\Object\Join;

/**
 * Provides support for accessing an attachment's relationship.
 *
 * Implementation of {@see \Charcoal\Attachment\Interfaces\AttachmentRelationInterface}
 */
trait AttachmentRelationTrait
{
    /**
     * The object's relationship.
     *
     * @var JoinInterface|null
     */
    protected $pivot;

    /**
     * Retrieve the attachment/object relationship.
     *
     * @return JoinInterface|null
     */
    public function pivot()
    {
        return $this->pivot;
    }

    /**
     * Set the attachment/object relationship.
     *
     * @param  mixed $pivot The relationship object ID or instance.
     * @return self
     */
    public function setPivot($pivot)
    {
        $this->pivot = $this->resolvePivot($pivot);

        return $this;
    }

    /**
     * Resolve the relationship of a attachment/object.
     *
     * @param  mixed $pivot The relationship object ID or instance.
     * @throws InvalidArgumentException If the pivot array structure is invalid.
     * @return JoinInterface|null
     */
    protected function resolvePivot($pivot)
    {
        if (empty($pivot)) {
            return null;
        }

        if ($pivot instanceof JoinInterface) {
            return $pivot;
        }

        $data  = $pivot;
        $pivot = $this->modelFactory()->create(Join::class);

        if (is_string($data) && strpos($data, '_') > 1) {
            $data = array_combine([ 'objType', 'objId' ], explode('_', $data, 1));
        }

        if (is_scalar($data)) {
            return $pivot->load($data);
        } elseif (is_array($data)) {
            $data = array_merge([
                'objType'      => null,
                'objId'        => null,
                'attachmentId' => null,
                'group'         => AttachmentContainerInterface::DEFAULT_GROUPING,
            ], $data);

            if ($this instanceof AttachableInterface) {
                if (!isset($data['attachmentId']) && $this->id()) {
                    $data['attachmentId'] = $this->id();
                }
            } elseif ($this instanceof AttachmentAwareInterface) {
                if (!isset($data['objId']) && $this->id()) {
                    $data['objId'] = $this->id();
                }

                if (!isset($data['objType'])) {
                    $data['objType'] = $this->objType();
                }
            }

            if (isset($data['objType']) && isset($data['objId'])) {
                $pivot->setObjectType($data['objType']);
                $pivot->setObjectId($data['objId']);
                $pivot->setGroup($data['group']);

                if (isset($data['attachmentId'])) {
                    $pivot->setAttachmentId($data['attachmentId']);

                    $query = '
                        SELECT
                            *
                        FROM
                           `%table`
                        WHERE 1 = 1
                           AND `%objType` = :objType
                           AND `%objId` = :objId
                           AND `%att_id` = :att_id
                           AND `%group`  = :group
                        LIMIT
                           1';

                    $query = strtr($query, [
                        '%table'   => $pivot->source()->table(),
                        '%objType' => 'objectType',
                        '%objId'   => 'objectId',
                        '%att_id'  => 'attachmentId',
                        '%group'   => 'group',
                    ]);

                    $binds = [
                        'objType' => $data['objType'],
                        'objId'   => $data['objId'],
                        'att_id'  => $data['attachmentId'],
                        'group'   => $data['group'],
                    ];

                    $pivot->loadFromQuery($query, $binds);
                }

                return $pivot;
            } else {
                throw new InvalidArgumentException('Invalid Pivot Array Structure');
            }
        }

        return $pivot;
    }

    /**
     * Retrieve the object model factory.
     *
     * @return \Charcoal\Factory\FactoryInterface
     */
    abstract protected function modelFactory();
}
