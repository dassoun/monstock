<?php

class Application_Form_Categorie extends Zend_Form
{

    public function init()
    {
        // Début Id
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->setDecorators(array('ViewHelper'));
        
        $this->addElement($id);
        // Fin Id

        // Début Libellé
        $libelle = new Zend_Form_Element_Text('libelle');
        $libelle->setLabel('libellé');
        $libelle->setRequired();
        
        $filter = new Zend_Filter_StringTrim();
        $libelle->addFilter($filter);
        
        $validator = new Zend_Validate_NotEmpty();
        $validator->setMessage('Le libellé est obligatoire', Zend_Validate_NotEmpty::IS_EMPTY);
        $libelle->addValidator($validator);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(128);
        $validator->setMessage('Le libellé ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $libelle->addValidator($validator);
        
        $this->addElement($libelle);
        // Fin Libellé
        
        // On enlève les décorateurs par défaut
        $this->setElementDecorators(array('ViewHelper', 'Errors', 'HtmlTag', 'Label'));
    }
}
