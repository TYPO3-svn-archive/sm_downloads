<?php

########################################################################
# Extension Manager/Repository config file for ext "sm_downloads".
#
# Auto generated 04-11-2012 13:14
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Simple Downloadcenter',
    'description' => 'a very simple download plugin.
Making Downloadlinks & Folders all by its own. Just upload, maybe add your styles.',
    'category' => 'plugin',
    'author' => 'Stefan Masztalerz',
    'author_email' => 'stefan.masztalerz@aoemedia.de',
    'author_company' => 'AOEmedia',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '1.0.1',
    'constraints' => array(
        'depends' => array(
            'extbase' => '1.3',
            'fluid' => '1.3',
            'typo3' => '4.5-0.0.0',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
    '_md5_values_when_last_written' => 'a:19:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"9b35";s:14:"ext_tables.php";s:4:"72f3";s:14:"ext_tables.sql";s:4:"d41d";s:37:"Classes/Controller/FileController.php";s:4:"8476";s:29:"Classes/Domain/Model/File.php";s:4:"108a";s:44:"Classes/Domain/Repository/FileRepository.php";s:4:"6f2e";s:42:"Classes/ViewHelpers/fileSizeViewHelper.php";s:4:"9a1b";s:33:"Configuration/FlexForms/setup.xml";s:4:"14f0";s:40:"Resources/Private/Language/locallang.xml";s:4:"644d";s:77:"Resources/Private/Language/locallang_csh_tx_smdownloads_domain_model_file.xml";s:4:"d520";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"95e8";s:38:"Resources/Private/Layouts/Default.html";s:4:"c0e0";s:42:"Resources/Private/Templates/File/List.html";s:4:"fdc1";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:59:"Resources/Public/Icons/tx_smdownloads_domain_model_file.gif";s:4:"905a";s:24:"Tests/Dummy/IMG_1234.JPG";s:4:"6dea";s:44:"Tests/Unit/Controller/FileControllerTest.php";s:4:"ff8e";s:14:"doc/manual.sxw";s:4:"661d";}',
);

?>