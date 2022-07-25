<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shch\Document\Api\Data\DrawingInterface;
use Shch\Document\Api\Data\DrawingInterfaceFactory;
use Shch\Document\Api\Data\DrawingSearchResultsInterfaceFactory;
use Shch\Document\Api\DrawingRepositoryInterface;
use Shch\Document\Model\ResourceModel\Drawing as ResourceDrawing;
use Shch\Document\Model\ResourceModel\Drawing\CollectionFactory as DrawingCollectionFactory;

class DrawingRepository implements DrawingRepositoryInterface
{

    /**
     * @var DrawingCollectionFactory
     */
    protected $drawingCollectionFactory;

    /**
     * @var DrawingInterfaceFactory
     */
    protected $drawingFactory;

    /**
     * @var ResourceDrawing
     */
    protected $resource;

    /**
     * @var Drawing
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceDrawing $resource
     * @param DrawingInterfaceFactory $drawingFactory
     * @param DrawingCollectionFactory $drawingCollectionFactory
     * @param DrawingSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceDrawing $resource,
        DrawingInterfaceFactory $drawingFactory,
        DrawingCollectionFactory $drawingCollectionFactory,
        DrawingSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->drawingFactory = $drawingFactory;
        $this->drawingCollectionFactory = $drawingCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(DrawingInterface $drawing)
    {
        try {
            $this->resource->save($drawing);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the drawing: %1',
                $exception->getMessage()
            ));
        }
        return $drawing;
    }

    /**
     * @inheritDoc
     */
    public function get($drawingId)
    {
        $drawing = $this->drawingFactory->create();
        $this->resource->load($drawing, $drawingId);
        if (!$drawing->getId()) {
            throw new NoSuchEntityException(__('Drawing with id "%1" does not exist.', $drawingId));
        }
        return $drawing;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->drawingCollectionFactory->create();
        
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
    public function delete(DrawingInterface $drawing)
    {
        try {
            $drawingModel = $this->drawingFactory->create();
            $this->resource->load($drawingModel, $drawing->getDrawingId());
            $this->resource->delete($drawingModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Drawing: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($drawingId)
    {
        return $this->delete($this->get($drawingId));
    }
}

