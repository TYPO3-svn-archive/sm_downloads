<?php

class Tx_SmDownloads_ViewHelpers_FileSizeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

    /**
     * Render optimal file size
     *
     * @param string $byte
     * @return
     */
    public function render($byte) {
        $byte = (int) $byte;
        if ($byte <= 1024 ){
            return $byte.' Byte';
        }
        $kiloByte = $byte / 1024;
        if ($byte >= 1024 && $kiloByte < 1024 ){
            return round($kiloByte).' KB';
        }
        $megaByte = $kiloByte / 1024;
        if ($kiloByte >= 1024 && $megaByte < 1024 ){
            return round($megaByte, 1).' MB';
        }
        $gigaByte = $megaByte / 1024;
        if ($megaByte > 1024 ){
            return round($gigaByte, 2).' GB';
        }

    }

}
?>