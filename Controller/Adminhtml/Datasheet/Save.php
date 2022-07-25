<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Controller\Adminhtml\Datasheet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Shch\Document\Api\ConfigInterface;
use Shch\Document\Model\DatasheetRepository;

class Save extends Action
{
    private DataPersistorInterface $dataPersistor;
    private DatasheetRepository $datasheetRepository;
    private UploaderFactory $uploaderFactory;
    private WriteInterface $mediaDirectory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param DatasheetRepository $datasheetRepository
     * @param UploaderFactory $uploaderFactory
     * @param Filesystem $filesystem
     * @throws FileSystemException
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        DatasheetRepository $datasheetRepository,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->datasheetRepository = $datasheetRepository;
        $this->uploaderFactory = $uploaderFactory;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('datasheet_id');

            //$model = $this->_objectManager->create(Datasheet::class)->load($id);
            $model = $this->datasheetRepository->get($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Datasheet no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $uploader = $this->uploaderFactory->create(['fileId' => 'file_name']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $absolutePath = $this->mediaDirectory->getAbsolutePath(ConfigInterface::DATASHEET_FILES_FOLDER);
            $result = $uploader->save($absolutePath);
            if (empty($result['file'])) {
                $this->messageManager->addErrorMessage('File was not uploaded, datasheet not saved.');
                $this->dataPersistor->set('shch_document_datasheet', $data);
                return $resultRedirect->setPath('*/*/edit', ['datasheet_id' => $this->getRequest()->getParam('datasheet_id')]);
            }
            $data['file_name'] = $result['file'];
            $model->setData($data);

            try {
                $this->datasheetRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Datasheet.'));
                $this->dataPersistor->clear('shch_document_datasheet');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['datasheet_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Datasheet.'));
            }

            $this->dataPersistor->set('shch_document_datasheet', $data);
            return $resultRedirect->setPath('*/*/edit', ['datasheet_id' => $this->getRequest()->getParam('datasheet_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

