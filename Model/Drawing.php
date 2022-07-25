<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model;

use Magento\Framework\Model\AbstractModel;
use Shch\Document\Api\Data\DrawingInterface;

class Drawing extends AbstractModel implements DrawingInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Shch\Document\Model\ResourceModel\Drawing::class);
    }

    /**
     * @inheritDoc
     */
    public function getDrawingId()
    {
        return $this->getData(self::DRAWING_ID);
    }

    /**
     * @inheritDoc
     */
    public function setDrawingId($drawingId)
    {
        return $this->setData(self::DRAWING_ID, $drawingId);
    }

    /**
     * @inheritDoc
     */
    public function getFileName()
    {
        return $this->getData(self::FILE_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setFileName($fileName)
    {
        return $this->setData(self::FILE_NAME, $fileName);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }
}

