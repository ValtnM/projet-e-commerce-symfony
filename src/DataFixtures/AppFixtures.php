<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\ProductImage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $categories = [];

        for ($j = 0; $j < 150; $j++) {
            $category = new Category();

            $category->setName($faker->realTextBetween(10, 20));

            $categories[] = $category;

            $manager->persist($category);
        }

        for ($i = 0; $i < 150; $i++) {
            $product = new Product();

            $product->setName($faker->realTextBetween(10, 30))
                ->setDescription($faker->realTextBetween(150, 300))
                ->setPrice($faker->randomFloat(2, 10, 300))
                ->setStock($faker->randomDigit());



            $nbCategory = random_int(1, 10);
            for ($k = 0; $k < $nbCategory; $k++) {
                shuffle($categories);
                $product->addCategory($categories[0]);
            }


            for ($l = 0; $l < 10; $l++) {
                $image = new ProductImage();
                $image->setName($faker->realTextBetween(10, 30))
                ->setFile("https://picsum.photos/id/". $faker->numberBetween(1, 900)."/1024")
                ->setProduct($product);

                $manager->persist($image);
            }

            $manager->persist($product);
        }

        $manager->flush();

    }
}
