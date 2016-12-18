<?php

class Application_Form_ArticleFournisseur extends Zend_Form
{

    public function init()
    {
        // Début Id
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $id->setDecorators(array('ViewHelper'));
        
        $this->addElement($id);
        // Fin Id
        
        // Début Article
        $article = new Zend_Form_Element_Select('article_id');
        $article->setLabel('Article');
        
        $article->setRegisterInArrayValidator(false);
        
        $this->addElement($article);
        // Fin Article
        
        // Début Fournisseur
        $fournisseur = new Zend_Form_Element_Select('fournisseur_id');
        $fournisseur->setLabel('Fournisseur');
        
        $fournisseur->setRegisterInArrayValidator(false);
        
        $this->addElement($fournisseur);
        // Fin Catégorie

        // Début Ref Fournisseur
        $ref_fournisseur = new Zend_Form_Element_Text('ref_fournisseur');
        $ref_fournisseur->setLabel('Référence Fournisseur');
        
        $filter = new Zend_Filter_StringTrim();
        $ref_fournisseur->addFilter($filter);
        
        $filter = new Zend_Filter_Null(Zend_Filter_Null::STRING);
        $ref_fournisseur->addFilter($filter);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(64);
        $validator->setMessage('La Référence Fournisseur ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $ref_fournisseur->addValidator($validator);
        
        $this->addElement($ref_fournisseur);
        // Fin Ref Fournisseur
        
        // Début Prix
        $prix = new Zend_Form_Element_Text('prix');
        //$prix->setAttrib('data-mask', '9999.99');
        $prix->setLabel('Prix');
        
        $filter = new Zend_Filter_Null(Zend_Filter_Null::STRING);
        $prix->addFilter($filter);
        
        //$filter = new Zend_Filter_LocalizedToNormalized();
        //$prix->addFilter($filter);
        
        $validator = new Zend_Validate_Float();
        $validator->setMessage("Il semble que la valeur '%value%' ne soit pas correcte.", Zend_Validate_Float::NOT_FLOAT);
        $prix->addValidator($validator);
        
        $this->addElement($prix);
        // Fin Prix
        
        // Début Page Web
        $page_web = new Zend_Form_Element_Text('page_web');
        $page_web->setLabel('Page Web');
        
        $filter = new Zend_Filter_StringTrim();
        $page_web->addFilter($filter);
        
        $filter = new Zend_Filter_Null(Zend_Filter_Null::STRING);
        $page_web->addFilter($filter);
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(256);
        $validator->setMessage('La Référence Fournisseur ne doit pas dépasser %max% caractères', Zend_Validate_StringLength::TOO_LONG);
        $page_web->addValidator($validator);
        
        $this->addElement($page_web);
        // Fin Page Web
    }
}

