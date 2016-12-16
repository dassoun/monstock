<?php

class Application_Model_Mapper_Categorie
{
    /** @var Application_Model_DbTable_Categorie */
    protected $dbTable;
    
    public function __construct(Application_Model_DbTable_Categorie $dbTable) 
    {
        $this->dbTable = $dbTable;
    }
    
    /** 
     * @return Application_Model_Categorie[] Toutes les catégories
     */
    public function findAll()
    {
        $select = $this->dbTable->select();
        $select->order('libelle ASC');
        
        $categories = $this->dbTable->fetchAll($select)->toArray();
        
        $listCategorie = [];
        foreach($categories as $categorie) {
            $obj = new Application_Model_Categorie();
            $obj->setId($categorie['id'])
                    ->setLibelle($categorie['libelle']);
            
            $listCategorie[] = $obj;
        }
        
        return $listCategorie;
    }
    
    public function insert(Application_Model_Categorie $categorie)
    {
        $data = [];
        
        $data['libelle'] = $categorie->getLibelle();
        
        $id = $this->dbTable->insert($data);
        $categorie->setId($id);
        
        return $id;
    }
    
    public function update(Application_Model_Categorie $categorie)
    {
        //$table = new Application_Model_DbTable_Categorie();
        
        $data = [];
        $data['libelle'] = $categorie->getLibelle();
        
        $where = $this->dbTable->getAdapter()->quoteInto('id = ?', $categorie->getId());
        
        $this->dbTable->update($data, $where);
    }
    
    public function find($id)
    {
        $categorie = $this->dbTable->fetchRow(['id = ?' => $id]);
        
        if (!$categorie){
            return false;
        }
        
        $obj = new Application_Model_Categorie();
        $obj->setId($categorie['id'])
                ->setLibelle($categorie['libelle']);
        
        return $obj;
    }
    
    public function delete($id)
    {
        $this->dbTable->delete(['id = ?' => $id]);
    }
}