<?php

namespace App\Tests\Repository;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieRepositoryTest extends KernelTestCase
{
    private function recupRepository(): CategorieRepository {
        self::bootKernel();
        return self::getContainer()->get(CategorieRepository::class);
    }

    private function newCategorie(): Categorie {
        return (new Categorie())
            ->setName("Nom de la catégorie");
    }

    public function testAddCategorie() {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $nbCategories = $repository->count([]);
        $repository->add($categorie, true);
        $this->assertEquals($nbCategories + 1, $repository->count([]), "Erreur lors de l'ajout de la catégorie");
        ;
    }

    public function testeditCategorie() {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);

        $categorie->setName("Nom de la catégorie modifié");
        $repository->add($categorie, true);

        $updatedCategorie = $repository->find($categorie->getId());
        $this->assertEquals("Nom de la catégorie modifié", $updatedCategorie->getName(), "Erreur lors de la modification de la catégorie");
    }

    public function testDeleteCategorie() {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $nbCategories = $repository->count([]);
        $repository->remove($categorie, true);
        $this->assertEquals($nbCategories - 1, $repository->count([]), "Erreur lors de la suppression de la catégorie");
    }

}