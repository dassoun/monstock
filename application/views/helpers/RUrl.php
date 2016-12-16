<?php

class Zend_View_Helper_RUrl extends Zend_View_Helper_Abstract
{
    /**
     * 
     * @param type $params
     * @return type
     */
    public function RUrl($params) {
        
        return $this->view->url($params, false, true);
    }
}