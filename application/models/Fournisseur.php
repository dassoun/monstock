<?php

class Application_Model_Fournisseur
{
    protected $id;
    protected $nom;
    protected $ville;
    protected $site_web;


    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getSite_web() {
        return $this->site_web;
    }

        public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setSite_web($site_web) {
        $this->site_web = $site_web;
        return $this;
    }

}

