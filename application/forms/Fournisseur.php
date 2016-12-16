<?php

class Application_Form_Fournisseur extends Zend_Form
{

    public function init()
    {
        // Début Id
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->setDecorators(array('ViewHelper'));
        
        $this->addElement($id);
        // Fin Id

        // Début Nom
        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom');
        $nom->setRequired();
        
        $filter = new Zend_Filter_StringTrim();
        $nom->addFilter($filter);
        
        $validator = new Zend_Validate_NotEmpty();
        $validator->setMessage('Le Nom est obligatoire', Zend_Validate_NotEmpty::IS_EMPTY);
        $nom->addValidator($validator);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(128);
        $validator->setMessage('Le Nom ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $nom->addValidator($validator);
        
        $this->addElement($nom);
        // Fin Libellé
        
        // Début Ville
        $ville = new Zend_Form_Element_Text('ville');
        $ville->setLabel('ville');
        
        $filter = new Zend_Filter_StringTrim();
        $ville->addFilter($filter);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(64);
        $validator->setMessage('La Ville ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $ville->addValidator($validator);
        
        $this->addElement($ville);
        // Fin Ville
        
        // Début Site Web
        $site_web = new Zend_Form_Element_Text('site_web');
        $site_web->setLabel('Site Web');
        
        $filter = new Zend_Filter_StringTrim();
        $site_web->addFilter($filter);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(128);
        $validator->setMessage('Le Nom ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $site_web->addValidator($validator);
        
        $this->addElement($site_web);
        // Fin Site Web
    }
}

