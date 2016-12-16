<?php

class ArticleFournisseurController extends Zend_Controller_Action
{

    /**
     * @var Application_Model_Mapper_ArticleFournisseur
     */
    protected $mapper = null;

    public function init()
    {
        /* Initialize action controller here */
        $dbTable = new Application_Model_DbTable_ArticleFournisseur();
        $this->mapper = new Application_Model_Mapper_ArticleFournisseur($dbTable);
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $form = new Application_Form_ArticleFournisseur();
        
        $dbTableArtticle = new Application_Model_DbTable_Article();
        $dbTableArticleMapper = new Application_Model_Mapper_Article($dbTableArtticle);
        $articles = $dbTableArticleMapper->findAll();
        $this->view->articles = [];
        foreach($articles as $article) {
            $this->view->articles[$article->getId()] = $article->getDesignation();
        }
        
        $dbTableFournisseur = new Application_Model_DbTable_Fournisseur();
        $dbTableFournisseurMapper = new Application_Model_Mapper_Fournisseur($dbTableFournisseur);
        $fournisseurs = $dbTableFournisseurMapper->findAll();
        $this->view->fournisseurs = [];
        foreach($fournisseurs as $fournisseur) {
            $this->view->fournisseurs[$fournisseur->getId()] = $fournisseur->getNom();
        }
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if ($form->isValid($data)) {
                $articleFournisseur = new Application_Model_ArticleFournisseur();
                
                $article = $dbTableArticleMapper->find($data['article_id']);
                $fournisseur = $dbTableFournisseurMapper->find($data['fournisseur_id']);
                
                $articleFournisseur->setArticle($article);
                $articleFournisseur->setFournisseur($fournisseur);
                $articleFournisseur->setRef_fournisseur($data['ref_fournisseur']);
                $articleFournisseur->setPrix($data['prix']);
                $articleFournisseur->setPage_web($data['page_web']);
                
                $this->mapper->insert($articleFournisseur);
                
                return $this->_helper->redirector->gotoRoute([
                    'controller' => 'article'
                ], false, true);
            }
        } else {
            $data['article_id'] = $this->_request->getParam('idarticle');
            $data['fournisseur_id'] = $this->_request->getParam('idfournisseur');

            $form->populate($data);
        }
        
        $this->view->formArticleFournisseur = $form;
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

    public function showAction()
    {
        $id = $this->_request->getParam('id');
        
        if (!$id) {
            throw new Zend_Controller_Router_Exception('No id', 404);
        }
        
        $cond[] = ['af.id = ?', $id];
        $articleFournisseur = $this->mapper->findAll($cond);
        
        if (!$articleFournisseur) {
            throw new Zend_Controller_Router_Exception('No contact', 404);
        }
        
        $this->view->articleFournisseur = $articleFournisseur;
    }


}







