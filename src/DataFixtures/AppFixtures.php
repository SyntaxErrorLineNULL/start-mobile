<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $author = new Author($faker->name());
        $manager->persist($author);
        for ($i = 0; $i < 5; $i++) {
            $book = new Book($faker->name, $faker->title, $author);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
