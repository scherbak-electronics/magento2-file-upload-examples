<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api\Data;

interface DatasheetInterface
{

    const TITLE = 'title';
    const FILE_NAME = 'file_name';
    const DATASHEET_ID = 'datasheet_id';

    /**
     * Get datasheet_id
     * @return string|null
     */
    public function getDatasheetId();

    /**
     * Set datasheet_id
     * @param string $datasheetId
     * @return \Shch\Document\Datasheet\Api\Data\DatasheetInterface
     */
    public function setDatasheetId($datasheetId);

    /**
     * Get file_name
     * @return string|null
     */
    public function getFileName();

    /**
     * Set file_name
     * @param string $fileName
     * @return \Shch\Document\Datasheet\Api\Data\DatasheetInterface
     */
    public function setFileName($fileName);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Shch\Document\Datasheet\Api\Data\DatasheetInterface
     */
    public function setTitle($title);
}

