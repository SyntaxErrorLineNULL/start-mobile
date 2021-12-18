<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        /** @var Author $authorOne */
        $authorOne = $this->getReference(AuthorsFixtures::REF);

        /** @var Author $authorTwo */
        $authorTwo = $this->getReference(AuthorRefFixture::REF);

        for ($i = 0; $i < 100000; $i++) {
            $bookOne = new Book();
            $bookOne->setTitle($faker->realText(10));
            $bookOne->setDescription($faker->realText(20));
            $bookOne->setAuthorId($authorOne->getId());
            $manager->persist($bookOne);

            $bookTwo = new Book();
            $bookTwo->setTitle($faker->realText(10));
            $bookTwo->setDescription($faker->realText(20));
            $bookTwo->setAuthorId($authorTwo->getId());
            $manager->persist($bookTwo);
        }
        $manager->flush();
        $manager->clear();
    }

    public function getDependencies(): array
    {
        return [
            AuthorsFixtures::class,
            AuthorRefFixture::class
        ];
    }
}
