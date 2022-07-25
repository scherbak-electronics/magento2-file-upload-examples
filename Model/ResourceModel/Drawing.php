<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Drawing extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('shch_document_drawing', 'drawing_id');
    }
}

