<?php

class Application_Form_Article extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('enctype', 'multipart/form-data');
        
        // Début Id
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->setDecorators(array('ViewHelper'));
        
        $this->addElement($id);
        // Fin Id

        // Début Désignation
        $designation = new Zend_Form_Element_Text('designation');
        $designation->setLabel('Désignation');
        $designation->setRequired();
        
        $filter = new Zend_Filter_StringTrim();
        $designation->addFilter($filter);
        
        $validator = new Zend_Validate_NotEmpty();
        $validator->setMessage('La Désignation est obligatoire', Zend_Validate_NotEmpty::IS_EMPTY);
        $designation->addValidator($validator);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(256);
        $validator->setMessage('La Désignation ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $designation->addValidator($validator);
        
        $this->addElement($designation);
        // Fin Libellé
        
        //Début Image
/*        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Image')
            ->setDestination('C:\www\MesProjets\TestZF1\public\upload');
        // ensure only 1 file
        $image->addValidator('Count', false, 1);
        // limit to 100K
        $image->addValidator('Size', false, 102400);
        // only JPEG, PNG, and GIFs
        $image->addValidator('Extension', false, 'jpg,png,gif');
        
        //$filter = new Zend_Filter_Null(Zend_Filter_Null::STRING);
        //$image->addFilter($filter);
        
        $this->addElement($image);
        // Fin Image
*/        
        // Début Catégorie
        $categorie = new Zend_Form_Element_Select('categorie_id');
        $categorie->setLabel('Catégorie');
        
        $categorie->setRegisterInArrayValidator(false);
        
        $filter = new Zend_Filter_Null(Zend_Filter_Null::INTEGER);
        $categorie->addFilter($filter);
        
        $this->addElement($categorie);
        // Fin Catégorie
    }
}

