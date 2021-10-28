<?php

namespace App\DataFixtures;

use App\Entity\UserMobile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new UserMobile();
        $user->setUsername('mobile')->setRoles(['ROLE_USER_MOBILE'])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$qY3IZRf5NBLHlusHn5sTqQ$jv9XaE2iugTtPyS3NX4Nm9OsU1wnUtodjhWPPOQRDbk');
        $manager->persist($user);

        $manager->flush();
    }
}
