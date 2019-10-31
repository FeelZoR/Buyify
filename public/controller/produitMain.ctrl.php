<?php
require_once('../model/DAO.class.php');
require_once('_base.ctrl.php');

function definitEvironement(View $view, array $info) {

    if (isset($info['filtres'])) {
        $filtres = $info['filtres'];
    } else {
        $filtres = array();
    }

    if (isset($info['categorie'])) {
        $filtres['categorie'] = $info['categorie'];
    } else {
        $filtres['categorie'] = "Produits";
    }

    if (isset($info['prixMin'])) {
        $filtres['prixMin'] = $info['prixMin'];
    } else {
        $filtres['prixMin'] = 0;
    }

    if ($filtres['prixMin'] < 0) {
        ajoutErreur($view, "Le prix ne peut pas être pas négatif");
        $filtres['prixMin'] = 0;
    }

    if (isset($info['prixMax'])) {
        $filtres['prixMax'] = $info['prixMax'];
    } else {
        $filtres['prixMax'] = 999999;
    }

    if ($filtres['prixMax'] < 0) {
        ajoutErreur($view, "Le prix ne peut pas être pas négatif");
        $filtres['prixMax'] = 0;
    }

    if (isset($info['numPage'])) {
        $numPage = $info['numPage'];
    } else {
        $numPage = 1;
    }

    $produits = trouverProduit($filtres);
    $nombreProduit = sizeof($produits);
    $nombrePages = ($nombreProduit / 10);
    if ($numPage-1 > 0){ //si $numpage == 1,3 on veut quand même une page de plus.
        $numPage++;
    }

    if($nombreProduit == 0){
        header('Location: errorPage.ctrl.php?error=804&msg="Il semble qu\'il n\'y ai pas de produit correspondent "');
        exit(0);
    }

    $view->assign('cats', getCategories());
    $view->assign("filtres", $filtres);
    $view->assign('nombrePages',$nombrePages);
    $view->assign('nombreProduits',$nombreProduit);
    $view->assign("numPage", $numPage);
    $view->assign('produits', $produits);

}

function trouverProduit(array $filtres): array {
    $db = new DAO();
    $where = ' ? ';
    $bind[] = $filtres['categorie'];
    foreach (getCategoriesFille(getCategorie($filtres['categorie'])) as $cat) {
        $where = $where . ', ? ';
        $bind[] = $cat['nom'];
    }
    $bind[] = $filtres['prixMin'];
    $bind[] = $filtres['prixMax'];
    $produits = $db->select('Produit', "categorie IN (" . $where . ") AND PRIX >= ? AND PRIX <= ?", $bind);
    // $produits = $db->select('Produit',':whereCat prix >=:prixMin AND prix<=:prixMax', ['whereCat' => $whereCat, 'prixMin' => $filtres['prixMin'],'prixMax' => $filtres['prixMax']]);


    return $produits;
}

function getCategories(): array {
    $db = new DAO();
    $categorie = $db->select('Categorie');
    return $categorie;
}

require_once('_base.ctrl.php');
require_once '../../framework/View.class.php';

$view = new View();


definitEvironement($view, $_POST);
$view->setTitle('BuyIfy');
$view->display('produitListe.view.php');

