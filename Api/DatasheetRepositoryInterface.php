<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DatasheetRepositoryInterface
{

    /**
     * Save Datasheet
     * @param \Shch\Document\Api\Data\DatasheetInterface $datasheet
     * @return \Shch\Document\Api\Data\DatasheetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Shch\Document\Api\Data\DatasheetInterface $datasheet
    );

    /**
     * Retrieve Datasheet
     * @param string $datasheetId
     * @return \Shch\Document\Api\Data\DatasheetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($datasheetId);

    /**
     * Retrieve Datasheet matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shch\Document\Api\Data\DatasheetSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Datasheet
     * @param \Shch\Document\Api\Data\DatasheetInterface $datasheet
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Shch\Document\Api\Data\DatasheetInterface $datasheet
    );

    /**
     * Delete Datasheet by ID
     * @param string $datasheetId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($datasheetId);
}

