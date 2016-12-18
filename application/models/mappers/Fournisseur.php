<?php

class Application_Model_Mapper_Fournisseur
{
    /** @var Application_Model_DbTable_Article */
    protected $dbTable;
    
    public function __construct(Application_Model_DbTable_Fournisseur $dbTable) 
    {
        $this->dbTable = $dbTable;
    }
    
    /** 
     * @return Application_Model_Fournisseur[] Tous les fournisseurs
     */
    public function findAll($where=null)
    {
        $select = $this->dbTable->select();
        $select->order('nom ASC');
        
        if (!is_null($where)) {
            foreach($where as $cond) {
                $select->where($cond[0], $cond[1]);
            }
        }
        
        $fournisseurs = $this->dbTable->fetchAll($select)->toArray();
        
        $listfournisseur = [];
        foreach($fournisseurs as $fournisseur) {
            $obj = new Application_Model_Fournisseur();
            $obj->setId($fournisseur['id'])
                    ->setNom($fournisseur['nom'])
                    ->setVille($fournisseur['ville'])
                    ->setSite_web($fournisseur['site_web']);
            
            $listfournisseur[] = $obj;
        }
        
        return $listfournisseur;
    }
    
    public function insert(Application_Model_Fournisseur $fournisseur)
    {
        $data = [];
        
        $data['nom'] = $fournisseur->getNom();
        $data['ville'] = $fournisseur->getVille();
        $data['site_web'] = $fournisseur->getSite_web();
        
        $id = $this->dbTable->insert($data);
        $fournisseur->setId($id);
        
        return $id;
    }
    
    public function update(Application_Model_Fournisseur $fournisseur)
    {
        $data = [];
        $data['nom'] = $fournisseur->getNom();
        $data['ville'] = $fournisseur->getVille();
        $data['site_web'] = $fournisseur->getSite_web();
        
        $where = $this->dbTable->getAdapter()->quoteInto('id = ?', $fournisseur->getId());
        
        $this->dbTable->update($data, $where);
    }
    
    public function find($id)
    {
        $fournisseur = $this->dbTable->fetchRow(['id = ?' => $id]);
        
        if (!$fournisseur){
            return false;
        }
        
        $obj = new Application_Model_Fournisseur();
        $obj->setId($fournisseur['id'])
            ->setNom($fournisseur['nom'])
            ->setVille($fournisseur['ville'])
            ->setSite_web($fournisseur['site_web']);
        
        return $obj;
    }
    
    public function delete($id)
    {
        $this->dbTable->delete(['id = ?' => $id]);
    }
}