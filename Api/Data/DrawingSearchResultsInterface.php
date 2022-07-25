<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api\Data;

interface DrawingSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Drawing list.
     * @return \Shch\Document\Api\Data\DrawingInterface[]
     */
    public function getItems();

    /**
     * Set file_name list.
     * @param \Shch\Document\Api\Data\DrawingInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

