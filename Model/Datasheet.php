<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model;

use Magento\Framework\Model\AbstractModel;
use Shch\Document\Api\Data\DatasheetInterface;

class Datasheet extends AbstractModel implements DatasheetInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Shch\Document\Model\ResourceModel\Datasheet::class);
    }

    /**
     * @inheritDoc
     */
    public function getDatasheetId()
    {
        return $this->getData(self::DATASHEET_ID);
    }

    /**
     * @inheritDoc
     */
    public function setDatasheetId($datasheetId)
    {
        return $this->setData(self::DATASHEET_ID, $datasheetId);
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

