<?php

class CategorieController extends Zend_Controller_Action
{

    /**
     * @var Application_Model_Mapper_Categorie
     */
    protected $mapper = null;

    public function init()
    {
        /* Initialize action controller here */
        $dbTable = new Application_Model_DbTable_Categorie();
        $this->mapper = new Application_Model_Mapper_Categorie($dbTable);
    }

    public function indexAction()
    {
        $this->view->categories = $this->mapper->findAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Categorie();
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $categorie = new Application_Model_Categorie();
                $categorie->setLibelle($data['libelle']);
                
                $this->mapper->insert($categorie);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'categorie'
                ], false, true);
            }
        }
        
        $this->view->formCategorie = $form;
    }

    public function modifyAction()
    {
        $form = new Application_Form_Categorie();
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $categorie = new Application_Model_Categorie();
                $categorie->setId($data['id']);
                $categorie->setLibelle($data['libelle']);
                
                $this->mapper->update($categorie);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'categorie'
                ], false, true);
            } else {
                $form->populate();
                var_dump('toto');
                die;
            }
        } else {
            $params = $this->_request->getParams();
            $id = $params['id'];
            $categorie = $this->mapper->find($id);
            
            $data['id'] = $categorie->getId();
            $data['libelle'] = $categorie->getLibelle();
            
            $form->populate($data);
        }
        
        $this->view->formCategorie = $form;
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
                'controller' => 'categorie'
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
        
        $categorie = $this->mapper->find($id);
        
        if (!$categorie) {
            throw new Zend_Controller_Router_Exception('No contact', 404);
        }
        
        $this->view->categorie = $categorie;
        
        // On va chercher les Articles liés à la Catégorie
        $dbTableArticle = new Application_Model_DbTable_Article();
        $dbTableArticleMapper = new Application_Model_Mapper_Article($dbTableArticle);
        $where = [];
        $where[] = ['categorie_id = ?', $categorie->getId()];
        $articles = $dbTableArticleMapper->findAll($where);
        $this->view->articles = [];
        foreach($articles as $article) {
            $this->view->articles[] = $article;
        }
    }


}







