<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shch\Document\Api\Data\DatasheetInterface;
use Shch\Document\Api\Data\DatasheetInterfaceFactory;
use Shch\Document\Api\Data\DatasheetSearchResultsInterface;
use Shch\Document\Api\Data\DatasheetSearchResultsInterfaceFactory;
use Shch\Document\Api\DatasheetRepositoryInterface;
use Shch\Document\Model\ResourceModel\Datasheet as ResourceDatasheet;
use Shch\Document\Model\ResourceModel\Datasheet\CollectionFactory as DatasheetCollectionFactory;

class DatasheetRepository implements DatasheetRepositoryInterface
{

    /**
     * @var DatasheetCollectionFactory
     */
    protected DatasheetCollectionFactory $datasheetCollectionFactory;

    /**
     * @var ResourceDatasheet
     */
    protected ResourceDatasheet $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @var Datasheet
     */
    protected $searchResultsFactory;

    /**
     * @var DatasheetInterfaceFactory
     */
    protected $datasheetFactory;


    /**
     * @param ResourceDatasheet $resource
     * @param DatasheetInterfaceFactory $datasheetFactory
     * @param DatasheetCollectionFactory $datasheetCollectionFactory
     * @param DatasheetSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceDatasheet $resource,
        DatasheetInterfaceFactory $datasheetFactory,
        DatasheetCollectionFactory $datasheetCollectionFactory,
        DatasheetSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->datasheetFactory = $datasheetFactory;
        $this->datasheetCollectionFactory = $datasheetCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(DatasheetInterface $datasheet)
    {
        try {
            $this->resource->save($datasheet);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the datasheet: %1',
                $exception->getMessage()
            ));
        }
        return $datasheet;
    }

    /**
     * @inheritDoc
     */
    public function get($datasheetId): DatasheetInterface
    {
        $datasheet = $this->datasheetFactory->create();
        $this->resource->load($datasheet, $datasheetId);
        return $datasheet;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $criteria): DatasheetSearchResultsInterface
    {
        $collection = $this->datasheetCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(DatasheetInterface $datasheet)
    {
        try {
            $datasheetModel = $this->datasheetFactory->create();
            $this->resource->load($datasheetModel, $datasheet->getDatasheetId());
            $this->resource->delete($datasheetModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Datasheet: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($datasheetId)
    {
        return $this->delete($this->get($datasheetId));
    }
}

