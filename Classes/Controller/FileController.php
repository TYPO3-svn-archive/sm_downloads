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
class Tx_SmDownloads_Controller_FileController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * fileRepository
	 *
	 * @var Tx_SmDownloads_Domain_Repository_FileRepository
	 */
	protected $fileRepository;

	/**
	 * injectFileRepository
	 *
	 * @param Tx_SmDownloads_Domain_Repository_FileRepository $fileRepository
	 * @return void
	 */
	public function injectFileRepository(Tx_SmDownloads_Domain_Repository_FileRepository $fileRepository) {
		$this->fileRepository = $fileRepository;
	}

	/**
	 * action list
	 * @param string $path
     * @param string $folderName
	 * @return void
	 */
	public function listAction($folderName = NULL,$path = NULL) {
        if (!$path){
            $path = $this->settings['flexform']['path'];
        } else {
            $path = $path.$folderName.'/';
        }
        if (empty($path)){
            return Tx_Extbase_Utility_Localization::translate('missingConfig', 'sm_downloads');
        } else {

            $files = $this->fileRepository->getFilesByPath($path);
            $this->view->assign('files', $files);
            $this->view->assign('path', $path);
        }
    }

	/**
	 * action download
	 *
	 * @param string $fileName
     * @param string $mime
     * @param string $path
	 * @return boolean
	 */
	public function downloadAction($fileName,$mime, $path) {
        $isValid = $this->isValid($path, $fileName);
        if ($isValid){
            header('HTTP/1.1 200 OK');
            header('Content-type: '.$mime);
            header('Content-Disposition: attachment; filename="'.$fileName.'"');
            readfile($path.$fileName);
            return TRUE;
        } else {
            return Tx_Extbase_Utility_Localization::translate('fileNotFound', 'sm_downloads');
        }
	}

    /**
     * @param $path
     * @return bool
     */
    private function isValid($path, $fileName){
        $inRightFolder = strpos($path, $this->settings['flexform']['path']);
        $relative = strpos("../", $this->settings['flexform']['path']); //is not allowed
        if((TRUE === $inRightFolder || $inRightFolder === 0) && FALSE === $relative && TRUE === is_file($_SERVER['DOCUMENT_ROOT'].'/'.$path.$fileName)) {
            return TRUE;
        }
        return FALSE;
    }
}
?>