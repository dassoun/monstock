<?php

class Application_Model_Article
{
    protected $id;
    protected $designation;
    protected $image;
    protected $quantite_stock;
    protected $categorie;
    
    public function getId() {
        return $this->id;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function getImage() {
        return $this->image;
    }

    public function getQuantite_stock() {
        return $this->quantite_stock;
    }
    
    public function getCategorie() {
        return $this->categorie;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setQuantite_stock($quantite_stock) {
        $this->quantite_stock = $quantite_stock;
        return $this;
    }
    
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
        return $this;
    }
    
}
