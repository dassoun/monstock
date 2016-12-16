<?php

class FournisseurController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $dbTable = new Application_Model_DbTable_Fournisseur();
        $this->mapper = new Application_Model_Mapper_Fournisseur($dbTable);
    }

    public function indexAction()
    {
        $this->view->fournisseurs = $this->mapper->findAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Fournisseur();
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $fournisseur = new Application_Model_Fournisseur();
                $fournisseur->setNom($data['nom'])
                        ->setVille($data['ville'])
                        ->setSite_web($data['site_web']);
                
                $this->mapper->insert($fournisseur);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'fournisseur'
                ], false, true);
            }
        }
        
        $this->view->formFournisseur = $form;
    }

    public function modifyAction()
    {
        $form = new Application_Form_Fournisseur();
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $fournisseur = new Application_Model_Fournisseur();
                $fournisseur->setId($data['id']);
                $fournisseur->setNom($data['nom']);
                $fournisseur->setVille($data['ville']);
                $fournisseur->setSite_web($data['site_web']);
                
                $this->mapper->update($fournisseur);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'fournisseur'
                ], false, true);
            } else {
                $form->populate($data);
            }
        } else {
            $params = $this->_request->getParams();
            $id = $params['id'];
            $fournisseur = $this->mapper->find($id);
            
            $data['id'] = $fournisseur->getId();
            $data['nom'] = $fournisseur->getNom();
            $data['ville'] = $fournisseur->getVille();
            $data['site_web'] = $fournisseur->getSite_web();
            
            $form->populate($data);
        }
        
        $this->view->formFournisseur = $form;
    }

}



