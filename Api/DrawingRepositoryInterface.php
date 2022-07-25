<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DrawingRepositoryInterface
{

    /**
     * Save Drawing
     * @param \Shch\Document\Api\Data\DrawingInterface $drawing
     * @return \Shch\Document\Api\Data\DrawingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Shch\Document\Api\Data\DrawingInterface $drawing
    );

    /**
     * Retrieve Drawing
     * @param string $drawingId
     * @return \Shch\Document\Api\Data\DrawingInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($drawingId);

    /**
     * Retrieve Drawing matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shch\Document\Api\Data\DrawingSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Drawing
     * @param \Shch\Document\Api\Data\DrawingInterface $drawing
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Shch\Document\Api\Data\DrawingInterface $drawing
    );

    /**
     * Delete Drawing by ID
     * @param string $drawingId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($drawingId);
}

