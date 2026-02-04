<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        //Création de 20 Users
        $users=[];
        for($i = 0; $i<20; $i++){
            $user = new User();
            $user->setNameUser($faker->lastname())
                ->setFirstnameUser($faker->firstname())
                ->setEmailUser($faker->unique()->email())
                ->setPasswordUser($faker->password(6,20))
                ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($user);
            array_push($users,$user);
        }

        $categories = [];
        for ($i = 0; $i < 8; $i++) {
            $category = new Category();
            $category->setNameCat(ucfirst($faker->unique()->word()))
                ->setDescriptionCat($faker->paragraph());

            $manager->persist($category);
            array_push($categories,$category);
        }

        //Création de 100 Articles avec des catégories attribuées de manière random
        for($i=0; $i<100; $i++){

            $article = new Article();

            $nbCat = $faker->numberBetween(1, 3);
            $randomCats = $faker->randomElements($categories, $nbCat);
            $article->addCategories($randomCats);

            $article->setTitleArticle($faker->sentence())
                ->setContentArticle($faker->paragraph())
                ->setImageArticle($faker->imageUrl())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setPublishedAt(new \DateTimeImmutable())
                ->setWriteBy($users[rand(0, sizeof($users) - 1)])
                ->setImageArticle('https://picsum.photos/seed/' . $faker->uuid . '/900/500');

            $manager->persist($article);
        }



        $manager->flush();
    }
}