<?php

class Tx_SmDownloads_ViewHelpers_iconViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

    /**
     * Render fileicons
     *
     * @param string $mime
     * @param array $settings
     * @return
     */
    public function render($mime, $settings) {
        $path = t3lib_extMgm::extRelPath('sm_downloads').'Resources/Public/Icons/';
        $title = '';
        $src = '';

        if (strpos($mime, 'image') !== FALSE){
            $title = 'image';
            $src = '';
            if ($settings['imageIcon']){
                $src = $settings['imageIcon'];
            }
        } elseif (strpos($mime, 'pdf') !== FALSE){
            $src = $path.'RTEmagicC_icon_pdf.png';
            if ($settings['pdfIcon']){
                $src = $settings['pdfIcon'];
            }
            $title = 'pdf';
        } elseif (strpos($mime, 'indd') !== FALSE){
            $title = 'indd';
            $src = $path.'RTEmagicC_icon_indd_50.png';
            if ($settings['inddIcon']){
                $src = $settings['inddIcon'];
            }
        }

        if ($src) {
            $image = '<img src="'.$src.'" title="'.$title.'" />';
        } else {
            $image = '';
        }
        return $image;


    }

}
?>