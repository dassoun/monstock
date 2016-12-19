<?php

class ArticleController extends Zend_Controller_Action
{

    /**
     * @var Application_Model_Mapper_Article
     */
    protected $mapper = null;

    public function init()
    {
        /* Initialize action controller here */
        $dbTable = new Application_Model_DbTable_Article();
        $this->mapper = new Application_Model_Mapper_Article($dbTable);
    }

    public function indexAction()
    {
        $this->view->articles = $this->mapper->findAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Article();
        
        $dbTableCategorie = new Application_Model_DbTable_Categorie();
        $dbTableCategorieMapper = new Application_Model_Mapper_Categorie($dbTableCategorie);
        $categories = $dbTableCategorieMapper->findAll();
        $this->view->categories = [];
        foreach($categories as $categorie) {
            $this->view->categories[$categorie->getId()] = $categorie->getLibelle();
        }
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            //var_dump($data); die;
            if ($form->isValid($data)) {
                $article = new Application_Model_Article();
                
                $dbTableCategorie = new Application_Model_DbTable_Categorie();
                $dbTableCategorieMapper = new Application_Model_Mapper_Categorie($dbTableCategorie);
                $categorie = $dbTableCategorieMapper->find($data['categorie_id']);
                
                $article->setDesignation($form->getValue('designation'))
                        //->setImage($form->image->getFileName())
                        ->setQuantite_stock($form->getValue('quantite_stock'))
                        ->setCategorie($categorie);
                
                //$form->image->receive();
                
                $this->mapper->insert($article);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'article'
                ], false, true);
            }
        }
        
        $this->view->formArticle = $form;
    }

    public function modifyAction()
    {
        $form = new Application_Form_Article();
        
        $dbTableCategorie = new Application_Model_DbTable_Categorie();
        $dbTableCategorieMapper = new Application_Model_Mapper_Categorie($dbTableCategorie);
        $categories = $dbTableCategorieMapper->findAll();
        $this->view->categories = [];
        foreach($categories as $categorie) {
            $this->view->categories[$categorie->getId()] = $categorie->getLibelle();
        }
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $article = new Application_Model_Article();
                $article->setId($data['id']);
                $article->setDesignation($form->getValue('designation'));
                $article->setQuantite_stock($form->getValue('quantite_stock'));
                $article->setCategorie($dbTableCategorieMapper->find($data['categorie_id']));
                
                $this->mapper->update($article);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'article'
                ], false, true);
            } else {
                //$form->populate();
                echo('erreur');
                //var_dump($form->getMessages()); //error messages
                //echo($form->getErrors()); // error codes
            }
        } else {
            $params = $this->_request->getParams();
            $id = $params['id'];
            $article = $this->mapper->find($id);
            
            $data['id'] = $article->getId();
            $data['designation'] = $article->getDesignation();
            $data['quantite_stock'] = $article->getQuantite_stock();
            $data['categorie_id'] = $article->getCategorie()->getId();
            
            $form->populate($data);
        }
        
        $this->view->formArticle = $form;
    }

    public function showAction()
    {
        $id = $this->_request->getParam('id');
        
        if (!$id) {
            throw new Zend_Controller_Router_Exception('No id', 404);
        }
        
        $article = $this->mapper->find($id);
        
        if (!$article) {
            throw new Zend_Controller_Router_Exception('No contact', 404);
        }
        
        $this->view->article = $article;
        
        // On va chercher les Fournisseurs liés à l'Article
        $dbTableArticleFournisseur = new Application_Model_DbTable_ArticleFournisseur();
        $dbTableArticleFournisseurMapper = new Application_Model_Mapper_ArticleFournisseur($dbTableArticleFournisseur);
        $where = [];
        $where[] = ['article_id = ?', $article->getId()];
        $articleFournisseurs = $dbTableArticleFournisseurMapper->findAll($where);
        //var_dump($articleFournisseurs);
        $this->view->articleFournisseur = [];
        foreach($articleFournisseurs as $articleFournisseur) {
            //$obj = new Application_Model_ArticleFournisseur();
            //$obj = $articleFournisseur;
            $this->view->articleFournisseur[] = $articleFournisseur;
            //var_dump($obj);
        }
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
                'controller' => 'article'
            ], false, true);
        }
        
        $this->showAction();
    }
}

