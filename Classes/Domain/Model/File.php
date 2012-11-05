<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Stefan Masztalerz <stefan.masztalerz@aoemedia.de>, AOEmedia
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package sm_downloads
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_SmDownloads_Domain_Model_File extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * size
	 *
	 * @var string
	 */
	protected $size;

    /**
     * isFolder
     *
     * @var boolean
     */
    protected $isFolder = FALSE;

    /**
     * @var string $mime
     */
    protected $mime;

    /**
     * @param $mime
     */
    public function setMime($mime){
        $this->mime = $mime;
    }

    /**
     * @return string
     */
    public function getMime(){
        return $this->mime;
    }
    /**
     * @param boolean $bool
     */
    public function setIsFolder($bool){
        $this->isFolder = $bool;
    }

    /**
     * @return boolean 
     */
    public function getIsFolder(){
        return $this->isFolder;
    }
    /**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the size
	 *
	 * @return string $size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the size
	 *
	 * @param string $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = $size;
	}

}
?>