<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model\ResourceModel\Drawing;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'drawing_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Shch\Document\Model\Drawing::class,
            \Shch\Document\Model\ResourceModel\Drawing::class
        );
    }
}

