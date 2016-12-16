<?php

class Application_Model_Mapper_Article
{
    /** @var Application_Model_DbTable_Article */
    protected $dbTable;
    
    public function __construct(Application_Model_DbTable_Article $dbTable) 
    {
        $this->dbTable = $dbTable;
    }
    
    /** 
     * @return Application_Model_Article[] Tous les articles
     */
    public function findAll($where=null)
    {
        $select = $this->dbTable->select();
        $select->order('designation ASC');
        
        if (!is_null($where)) {
            foreach($where as $cond) {
                $select->where($cond[0], $cond[1]);
            }
        }
        
        $articles = $this->dbTable->fetchAll($select)->toArray();
        
        $listArticle = [];
        foreach($articles as $article) {
            $obj = new Application_Model_Article();
            
            $dbTableCategorie = new Application_Model_DbTable_Categorie();
            $mapperCategorie = new Application_Model_Mapper_Categorie($dbTableCategorie);
            $categorie = new Application_Model_Categorie();
            $categorie = $mapperCategorie->find($article['categorie_id']);
            
            $obj->setId($article['id'])
                ->setDesignation($article['designation'])
                ->setCategorie($categorie);
            
            $listArticle[] = $obj;
        }
        
        return $listArticle;
    }
    
    public function update(Application_Model_Article $article)
    {
        $data = [];
        $data['designation'] = $article->getDesignation();
        $data['categorie_id'] = $article->getCategorie()->getId();
        
        //var_dump($data); die;
        
        $where = $this->dbTable->getAdapter()->quoteInto('id = ?', $article->getId());
        
        $this->dbTable->update($data, $where);
    }
    
    public function find($id)
    {
        $article = $this->dbTable->fetchRow(['id = ?' => $id]);
        
        if (!$article){
            return false;
        }
        
        $dbTableCategorie = new Application_Model_DbTable_Categorie();
        $mapperCategorie = new Application_Model_Mapper_Categorie($dbTableCategorie);
        $categorie = new Application_Model_Categorie();
        $categorie = $mapperCategorie->find($article['categorie_id']);
        
        $obj = new Application_Model_Article();
        $obj->setId($article['id'])
            ->setDesignation($article['designation'])
            ->setCategorie($categorie);
        
        return $obj;
    }
    
    public function delete($id)
    {
        $this->dbTable->delete(['id = ?' => $id]);
    }
    
    public function insert(Application_Model_Article $article)
    {
        $data = [];
        
        $data['designation'] = $article->getDesignation();
        $data['image'] = $article->getImage();
        $data['categorie_id'] = $article->getCategorie()->getCategorie_id();
        
        $id = $this->dbTable->insert($data);
        $article->setId($id);
        
        return $id;
    }
    
}