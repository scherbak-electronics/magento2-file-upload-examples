<?php
/**
 * Copyright © Scherbak Electronics All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shch\Document\Api\Data;

interface DrawingInterface
{

    const DRAWING_ID = 'drawing_id';
    const FILE_NAME = 'file_name';
    const TITLE = 'title';

    /**
     * Get drawing_id
     * @return string|null
     */
    public function getDrawingId();

    /**
     * Set drawing_id
     * @param string $drawingId
     * @return \Shch\Document\Drawing\Api\Data\DrawingInterface
     */
    public function setDrawingId($drawingId);

    /**
     * Get file_name
     * @return string|null
     */
    public function getFileName();

    /**
     * Set file_name
     * @param string $fileName
     * @return \Shch\Document\Drawing\Api\Data\DrawingInterface
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
     * @return \Shch\Document\Drawing\Api\Data\DrawingInterface
     */
    public function setTitle($title);
}

