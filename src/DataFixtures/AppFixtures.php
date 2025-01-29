<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $amsterdam = new Conference();
        $amsterdam->setCity('Amsterdam');
        $amsterdam->setYear(2025);
        $amsterdam->setIsInternational(true);
        $manager->persist($amsterdam);

        $paris = new Conference();
        $paris->setCity('Paris');
        $paris->setYear(2009);
        $paris->setIsInternational(true);
        $manager->persist($paris);

        $comment1 = new Comment();
        $comment1->setConference($amsterdam);
        $comment1->setAuthor('Patrick');
        $comment1->setText('TextConferenceText');
        $comment1->setEmail('test@test.com');
        $manager->persist($comment1);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(Admin::class)->hash('admin'));
        $manager->persist($admin);

        $manager->flush();
    }
}
