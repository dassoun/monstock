<?php

class Application_Model_Categorie
{
    protected $id;
    protected $libelle;
    
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
        return $this;
    }
}

