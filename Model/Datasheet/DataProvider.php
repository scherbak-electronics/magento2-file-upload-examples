<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Model\Datasheet;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Shch\Document\Model\ConfigProvider;
use Shch\Document\Model\ResourceModel\Datasheet\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var DataPersistorInterface
     */
    protected DataPersistorInterface $dataPersistor;

    /**
     * @var array
     */
    protected array $loadedData;

    /**
     * @inheritDoc
     */
    protected $collection;

    private ConfigProvider $configProvider;


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param ConfigProvider $configProvider
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        ConfigProvider $configProvider,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->configProvider = $configProvider;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->loadedData = [];
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if (!empty($this->loadedData[$model->getId()]['file_name'])) {
                $this->loadedData[$model->getId()]['file_name_text'] = $this->configProvider->getMediaUrl($model->getData('file_name'));
            }
        }
        $data = $this->dataPersistor->get('shch_document_datasheet');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('shch_document_datasheet');
        }
        return $this->loadedData;
    }
}

