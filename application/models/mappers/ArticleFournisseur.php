<?php

class Application_Model_Mapper_ArticleFournisseur
{
    /** @var Application_Model_DbTable_ArticleFournisseur */
    protected $dbTable;
    
    public function __construct(Application_Model_DbTable_ArticleFournisseur $dbTable) 
    {
        $this->dbTable = $dbTable;
    }
    
    /** 
     * @return Application_Model_ArticleFournisseur[] Tous les articles
     */
    public function findAll($where=null)
    {
//        if($_GET['name']) $where[] = 'name LIKE :name';
//        if($_GET['city']) $where[] = 'city LIKE :city';
//        if(isset($_GET['gender'])) $where[] = 'gender = :gender';
//        if(count($where)) {
//            $sql = 'SELECT * FROM user WHERE '.implode(' AND ',$where);
//            $stmt = cnn()->prepare($sql);
//            $name = '%'.$_GET['name'].'%';
//            if($_GET['name']) $stmt->bindValue(':name', '%'.$_GET['name'].'%', PDO::PARAM_STR);
//            $city = '%'.$_GET['city'].'%';
//            if($_GET['city']) $stmt->bindParam(':city', $city, PDO::PARAM_STR);
//            if(isset($_GET['gender'])) $stmt->bindParam(':gender', $_GET['gender'], PDO::PARAM_BOOL);
//            $stmt->execute();
//            if($data = $stmt->fetchAll()) {
//                echo json_encode($data);
//            }
//        }
        
        
        $select = $this->dbTable->select();
        $select->setIntegrityCheck(false);
        $select->from(['af' => 'article_fournisseur'],
                        ['id', 'article_id', 'fournisseur_id', 'ref_fournisseur', 'prix', 'page_web']);
        $select->joinLeft(['f' => 'fournisseur'],
                            'af.fournisseur_id = f.id',
                            ['nom', 'ville', 'site_web']);
        $select->joinLeft(['a' => 'article'],
                            'af.article_id = a.id',
                            ['designation', 'image', 'categorie_id']);
        $select->joinLeft(['c' => 'categorie'],
                            'a.categorie_id = c.id',
                            ['libelle']);
        $select->order('designation ASC');
        
        if (!is_null($where)) {
            foreach($where as $cond) {
                $select->where($cond[0], $cond[1]);
            }
        }
        
        $articleFournisseurs = $this->dbTable->fetchAll($select)->toArray();
        
        $listArticleFournisseur = [];
        foreach($articleFournisseurs as $articleFournisseur) {
            $obj = new Application_Model_ArticleFournisseur();
            $obj->setId($articleFournisseur['id'])
                ->setRef_fournisseur($articleFournisseur['ref_fournisseur'])
                ->setPrix($articleFournisseur['prix']);
            
            $article = new Application_Model_Article();
            $article->setId($articleFournisseur['article_id'])
                    ->setDesignation($articleFournisseur['designation']);
                    //->setCategorie_id($articleFournisseur['categorie_id']);
            
            $obj->setArticle($article);
            
            $fournisseur = new Application_Model_Fournisseur();
            $fournisseur->setId($articleFournisseur['fournisseur_id'])
                    ->setNom($articleFournisseur['nom'])
                    ->setVille($articleFournisseur['ville'])
                    ->setSite_web($articleFournisseur['site_web']);
            
            $obj->setFournisseur($fournisseur);
            
            
            $listArticleFournisseur[] = $obj;
        }
        
        return $listArticleFournisseur;
    }
    
    public function insert(Application_Model_ArticleFournisseur $articleFournisseur)
    {
        $data = [];
        
        $data['article_id'] = $articleFournisseur->getArticle()->getId();
        $data['fournisseur_id'] = $articleFournisseur->getFournisseur()->getId();
        $data['ref_fournisseur'] = $articleFournisseur->getRef_fournisseur();
        $data['prix'] = $articleFournisseur->getPrix();
        $data['page_web'] = $articleFournisseur->getPage_web();
        
        $id = $this->dbTable->insert($data);
        $articleFournisseur->setId($id);
        
        return $id;
    }
    
    public function delete($id)
    {
        $this->dbTable->delete(['id = ?' => $id]);
    }
    
    public function update(Application_Model_ArticleFournisseur $articleFournisseur)
    {
        $data = [];
        $data['article_id'] = $articleFournisseur->getArticle()->getId();
        $data['fournisseur_id'] = $articleFournisseur->getFournisseur()->getId();
        $data['ref_fournisseur'] = $articleFournisseur->getRef_fournisseur();
        $data['prix'] = $articleFournisseur->getPrix();
        $data['page_web'] = $articleFournisseur->getPage_web();
        
        //var_dump($data); die;
        
        $where = $this->dbTable->getAdapter()->quoteInto('id = ?', $articleFournisseur->getId());
        
        $this->dbTable->update($data, $where);
    }
    
    public function find($id)
    {
        $articleFournisseur = $this->dbTable->fetchRow(['id = ?' => $id]);
        
        if (!$articleFournisseur){
            return false;
        }
        
        $dbTableArticle = new Application_Model_DbTable_Article();
        $mapperArticle = new Application_Model_Mapper_Article($dbTableArticle);
        $article = new Application_Model_Article();
        $article = $mapperArticle->find($articleFournisseur['article_id']);
        
        $dbTableFournisseur = new Application_Model_DbTable_Fournisseur();
        $mapperFournisseur = new Application_Model_Mapper_Fournisseur($dbTableFournisseur);
        $fournisseur = new Application_Model_Fournisseur();
        $fournisseur = $mapperFournisseur->find($articleFournisseur['fournisseur_id']);
        
        $obj = new Application_Model_ArticleFournisseur();
        $obj->setId($articleFournisseur['id'])
            ->setArticle($mapperArticle->find($articleFournisseur['article_id']))
            ->setFournisseur($mapperFournisseur->find($articleFournisseur['fournisseur_id']))
            ->setRef_fournisseur($articleFournisseur['ref_fournisseur'])
            ->setPrix($articleFournisseur['prix'])
            ->setPage_web($articleFournisseur['page_web']);
        
        return $obj;
    }
}