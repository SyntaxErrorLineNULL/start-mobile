<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuthorsFixtures extends Fixture
{
    const REF = "author";
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $author = new Author();
        $author->setName($faker->userName());
        $this->addReference(self::REF, $author);
        $manager->persist($author);
        $manager->flush();
    }
}