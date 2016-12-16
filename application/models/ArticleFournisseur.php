<?php

class Application_Model_ArticleFournisseur
{
    protected $id;
    protected $article;
    protected $fournisseur;
    protected $ref_fournisseur;
    protected $prix;
    protected $page_web;

    public function getId() {
        return $this->id;
    }

    public function getArticle() {
        return $this->article;
    }

    public function getFournisseur() {
        return $this->fournisseur;
    }

    public function getRef_fournisseur() {
        return $this->ref_fournisseur;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getPage_web() {
        return $this->page_web;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setArticle($article) {
        $this->article = $article;
        return $this;
    }

    public function setFournisseur($fournisseur) {
        $this->fournisseur = $fournisseur;
        return $this;
    }

    public function setRef_fournisseur($ref_fournisseur) {
        $this->ref_fournisseur = $ref_fournisseur;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setPage_web($page_web) {
        $this->page_web = $page_web;
        return $this;
    }


}
