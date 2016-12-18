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
            //$data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $fournisseur = new Application_Model_Fournisseur();
                $fournisseur->setNom($form->getValue('nom'))
                        ->setVille($form->getValue('ville'))
                        ->setSite_web($form->getValue('site_web'));
                
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
                $fournisseur->setId($form->getValue('id'));
                $fournisseur->setNom($form->getValue('nom'));
                $fournisseur->setVille($form->getValue('ville'));
                $fournisseur->setSite_web($form->getValue('site_web'));
                
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

    public function removeAction()
    {
        if ($this->_request->isPost()){
            $confirm = $this->_request->getPost('confirm');
            
            if ($confirm === 'Oui') {
                $id = $this->_request->getParam('id');
                $this->mapper->delete($id);
            }
            
            return $this->_helper->redirector->gotoRoute([
                'controller' => 'fournisseur'
            ], false, true);
        }
        
        $this->showAction();
    }
    
    public function showAction()
    {
        $id = $this->_request->getParam('id');
        
        if (!$id) {
            throw new Zend_Controller_Router_Exception('No id', 404);
        }
        
        $cond[] = ['id = ?', $id];
        $fournisseur = $this->mapper->find($id);
        
        if (!$fournisseur) {
            throw new Zend_Controller_Router_Exception('No fournisseur', 404);
        }
        
        $this->view->fournisseur = $fournisseur;
    }
}



