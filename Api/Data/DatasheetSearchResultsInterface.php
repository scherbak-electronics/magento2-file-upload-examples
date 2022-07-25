<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api\Data;

interface DatasheetSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Datasheet list.
     * @return \Shch\Document\Api\Data\DatasheetInterface[]
     */
    public function getItems();

    /**
     * Set file_name list.
     * @param \Shch\Document\Api\Data\DatasheetInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

