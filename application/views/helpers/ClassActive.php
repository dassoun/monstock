<?php

class Zend_View_Helper_ClassActive extends Zend_View_Helper_Abstract
{
    public function classActive($params) {
        $retour = '';
        
        $currentUrl = $this->view->url();
        
        $destUrl = $this->view->url($params, false, true);
        
        if ($currentUrl == $destUrl) {
            $retour = ' class="active"';
        }
        
        return $retour;
    }
}