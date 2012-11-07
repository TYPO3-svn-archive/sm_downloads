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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Sm_downloads_Controller_FileController.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Simpel Downloadcenter
 *
 * @author Stefan Masztalerz <stefan.masztalerz@aoemedia.de>
 */
class Tx_Sm_downloads_Controller_FileControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_SmDownloads_Domain_Model_File
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_SmDownloads_Domain_Model_File();
	}

	public function tearDown() {
		unset($this->fixture);
	}

    /**
     * @test
     */
    public function downloadAction(){
        $controller = $this->getMock('Tx_SmDownloads_Controller_FileController', array('isValidPath'));

        $reflector = new ReflectionProperty('Tx_SmDownloads_Controller_FileController', 'settings');
        $reflector->setAccessible(true);
        $reflector->setValue($controller, array( 'flexform'
                                                 => array ( 'path'
                                                            => 'typo3conf/ext/sm_downloads/Tests/Dummy/')));

        $fileName = 'localconf.php';
        $path = 'typo3conf/';
        $this->assertEquals('File not found', $controller->downloadAction($fileName, ' ', $path));

        $fileName = 'walla_walla.JPG';
        $path = 'typo3conf/ext/sm_downloads/Tests/Dummy/';
        $this->assertEquals('File not found', $controller->downloadAction($fileName, ' ', $path));

        $fileName = 'localconf.php';
        $path = 'typo3conf/ext/sm_downloads/Tests/Dummy/../../../';
        $this->assertEquals('File not found', $controller->downloadAction($fileName, ' ', $path));

        $fileName = 'IMG_1234.JPG';
        $path = 'typo3conf/ext/sm_downloads/Tests/Dummy/';
        $this->assertEquals(TRUE, $controller->downloadAction($fileName, ' ', $path));

    }
}
?>