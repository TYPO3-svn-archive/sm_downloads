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
class Tx_SmDownloads_Domain_Repository_FileRepository extends Tx_Extbase_Persistence_Repository {

    /**
     * @param $path
     * @return array
     */
    public function getFilesByPath($path){
        $files = array();
        $handle = opendir($path);
        $folders = array();
        $filterFolderImages = array();
        while ($file = readdir ($handle)) {
            if($file != "." && $file != "..") {
                $fileObj = new Tx_SmDownloads_Domain_Model_File();
                $fileObj->setName($file);
                if (class_exists('finfo')){
                    $finfo = new finfo;
                    $mime = $finfo->file($path.$file, FILEINFO_MIME);
                } else {
                    $mime = $this->detect_mime($file);
                }
                $fileObj->setMime($mime);

                if(is_dir($path."/".$file)) {
                    $fileObj->setIsFolder(TRUE);
                    if (is_file($path."/".$file.'.png')){
                        $fileObj->setFolderImage($path."/".$file.'.png');
                        $filterFolderImages[] = $file.'.png';
                    }
                    $folders[] = $fileObj;
                } else {
                    $fileObj->setSize(filesize($path."/".$file));
                    $files[] = $fileObj;
                }
            }
        }
        $files = $this->filterFiles($filterFolderImages, $files);
        $files = array_merge($folders, $files);
        closedir($handle);
        return $files;
    }

    /**
     * @param array $filesToDrop
     * @param array $files
     * @return array
     */
    private function filterFiles(array $filesToDrop,array $files){
        foreach ($files as $file){
            if (in_array($file->getName(), $filesToDrop) == FALSE){
                $filteredFiles[] = $file;
            }
        }
        return $filteredFiles;
    }

    private function detect_mime($filename) {
        $filetype=strrchr($filename, ".");

        switch ($filetype) {
            case ".zip": $mime="application/zip"; break;
            case ".ez":  $mime="application/andrew-inset"; break;
            case ".hqx": $mime="application/mac-binhex40"; break;
            case ".cpt": $mime="application/mac-compactpro"; break;
            case ".doc": $mime="application/msword"; break;
            case ".bin": $mime="application/octet-stream"; break;
            case ".dms": $mime="application/octet-stream"; break;
            case ".lha": $mime="application/octet-stream"; break;
            case ".lzh": $mime="application/octet-stream"; break;
            case ".exe": $mime="application/octet-stream"; break;
            case ".class": $mime="application/octet-stream"; break;
            case ".so":  $mime="application/octet-stream"; break;
            case ".dll": $mime="application/octet-stream"; break;
            case ".oda": $mime="application/oda"; break;
            case ".pdf": $mime="application/pdf"; break;
            case ".ai":  $mime="application/postscript"; break;
            case ".eps": $mime="application/postscript"; break;
            case ".ps":  $mime="application/postscript"; break;
            case ".smi": $mime="application/smil"; break;
            case ".smil": $mime="application/smil"; break;
            case ".xls": $mime="application/vnd.ms-excel"; break;
            case ".ppt": $mime="application/vnd.ms-powerpoint"; break;
            case ".wbxml": $mime="application/vnd.wap.wbxml"; break;
            case ".wmlc": $mime="application/vnd.wap.wmlc"; break;
            case ".wmlsc": $mime="application/vnd.wap.wmlscriptc"; break;
            case ".bcpio": $mime="application/x-bcpio"; break;
            case ".vcd": $mime="application/x-cdlink"; break;
            case ".pgn": $mime="application/x-chess-pgn"; break;
            case ".cpio": $mime="application/x-cpio"; break;
            case ".csh": $mime="application/x-csh"; break;
            case ".dcr": $mime="application/x-director"; break;
            case ".dir": $mime="application/x-director"; break;
            case ".dxr": $mime="application/x-director"; break;
            case ".dvi": $mime="application/x-dvi"; break;
            case ".spl": $mime="application/x-futuresplash"; break;
            case ".gtar": $mime="application/x-gtar"; break;
            case ".hdf": $mime="application/x-hdf"; break;
            case ".js":  $mime="application/x-javascript"; break;
            case ".skp": $mime="application/x-koan"; break;
            case ".skd": $mime="application/x-koan"; break;
            case ".skt": $mime="application/x-koan"; break;
            case ".skm": $mime="application/x-koan"; break;
            case ".latex": $mime="application/x-latex"; break;
            case ".nc":  $mime="application/x-netcdf"; break;
            case ".cdf": $mime="application/x-netcdf"; break;
            case ".sh":  $mime="application/x-sh"; break;
            case ".shar": $mime="application/x-shar"; break;
            case ".swf": $mime="application/x-shockwave-flash"; break;
            case ".sit": $mime="application/x-stuffit"; break;
            case ".sv4cpio": $mime="application/x-sv4cpio"; break;
            case ".sv4crc": $mime="application/x-sv4crc"; break;
            case ".tar": $mime="application/x-tar"; break;
            case ".tcl": $mime="application/x-tcl"; break;
            case ".tex": $mime="application/x-tex"; break;
            case ".texinfo": $mime="application/x-texinfo"; break;
            case ".texi": $mime="application/x-texinfo"; break;
            case ".t":   $mime="application/x-troff"; break;
            case ".tr":  $mime="application/x-troff"; break;
            case ".roff": $mime="application/x-troff"; break;
            case ".man": $mime="application/x-troff-man"; break;
            case ".me":  $mime="application/x-troff-me"; break;
            case ".ms":  $mime="application/x-troff-ms"; break;
            case ".ustar": $mime="application/x-ustar"; break;
            case ".src": $mime="application/x-wais-source"; break;
            case ".xhtml": $mime="application/xhtml+xml"; break;
            case ".xht": $mime="application/xhtml+xml"; break;
            case ".zip": $mime="application/zip"; break;
            case ".au":  $mime="audio/basic"; break;
            case ".snd": $mime="audio/basic"; break;
            case ".mid": $mime="audio/midi"; break;
            case ".midi": $mime="audio/midi"; break;
            case ".kar": $mime="audio/midi"; break;
            case ".mpga": $mime="audio/mpeg"; break;
            case ".mp2": $mime="audio/mpeg"; break;
            case ".mp3": $mime="audio/mpeg"; break;
            case ".aif": $mime="audio/x-aiff"; break;
            case ".aiff": $mime="audio/x-aiff"; break;
            case ".aifc": $mime="audio/x-aiff"; break;
            case ".m3u": $mime="audio/x-mpegurl"; break;
            case ".ram": $mime="audio/x-pn-realaudio"; break;
            case ".rm":  $mime="audio/x-pn-realaudio"; break;
            case ".rpm": $mime="audio/x-pn-realaudio-plugin"; break;
            case ".ra":  $mime="audio/x-realaudio"; break;
            case ".wav": $mime="audio/x-wav"; break;
            case ".pdb": $mime="chemical/x-pdb"; break;
            case ".xyz": $mime="chemical/x-xyz"; break;
            case ".bmp": $mime="image/bmp"; break;
            case ".gif": $mime="image/gif"; break;
            case ".ief": $mime="image/ief"; break;
            case ".jpeg": $mime="image/jpeg"; break;
            case ".jpg": $mime="image/jpeg"; break;
            case ".jpe": $mime="image/jpeg"; break;
            case ".png": $mime="image/png"; break;
            case ".tiff": $mime="image/tiff"; break;
            case ".tif": $mime="image/tiff"; break;
            case ".djvu": $mime="image/vnd.djvu"; break;
            case ".djv": $mime="image/vnd.djvu"; break;
            case ".wbmp": $mime="image/vnd.wap.wbmp"; break;
            case ".ras": $mime="image/x-cmu-raster"; break;
            case ".pnm": $mime="image/x-portable-anymap"; break;
            case ".pbm": $mime="image/x-portable-bitmap"; break;
            case ".pgm": $mime="image/x-portable-graymap"; break;
            case ".ppm": $mime="image/x-portable-pixmap"; break;
            case ".rgb": $mime="image/x-rgb"; break;
            case ".xbm": $mime="image/x-xbitmap"; break;
            case ".xpm": $mime="image/x-xpixmap"; break;
            case ".xwd": $mime="image/x-xwindowdump"; break;
            case ".igs": $mime="model/iges"; break;
            case ".iges": $mime="model/iges"; break;
            case ".msh": $mime="model/mesh"; break;
            case ".mesh": $mime="model/mesh"; break;
            case ".silo": $mime="model/mesh"; break;
            case ".wrl": $mime="model/vrml"; break;
            case ".vrml": $mime="model/vrml"; break;
            case ".css": $mime="text/css"; break;
            case ".html": $mime="text/html"; break;
            case ".htm": $mime="text/html"; break;
            case ".asc": $mime="text/plain"; break;
            case ".txt": $mime="text/plain"; break;
            case ".rtx": $mime="text/richtext"; break;
            case ".rtf": $mime="text/rtf"; break;
            case ".sgml": $mime="text/sgml"; break;
            case ".sgm": $mime="text/sgml"; break;
            case ".tsv": $mime="text/tab-separated-values"; break;
            case ".wml": $mime="text/vnd.wap.wml"; break;
            case ".wmls": $mime="text/vnd.wap.wmlscript"; break;
            case ".etx": $mime="text/x-setext"; break;
            case ".xml": $mime="text/xml"; break;
            case ".xsl": $mime="text/xml"; break;
            case ".mpeg": $mime="video/mpeg"; break;
            case ".mpg": $mime="video/mpeg"; break;
            case ".mpe": $mime="video/mpeg"; break;
            case ".qt":  $mime="video/quicktime"; break;
            case ".mov": $mime="video/quicktime"; break;
            case ".mxu": $mime="video/vnd.mpegurl"; break;
            case ".avi": $mime="video/x-msvideo"; break;
            case ".movie": $mime="video/x-sgi-movie"; break;
            case ".asf": $mime="video/x-ms-asf"; break;
            case ".asx": $mime="video/x-ms-asf"; break;
            case ".wm":  $mime="video/x-ms-wm"; break;
            case ".wmv": $mime="video/x-ms-wmv"; break;
            case ".wvx": $mime="video/x-ms-wvx"; break;
            case ".ice": $mime="x-conference/x-cooltalk"; break;
        }

        return $mime;
    }
}
?>