<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $categories = [];

        // Category fixtures
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('Category' . $i );
            $manager->persist($category);
            $categories[] = $category;

        }

        // Product fixtures
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setName('Name' . $i );
            $product->setPrice(rand(0, 50) );
            $product->setDescription('Lorem ipsum');
            $product->setCategory($categories[rand(0, 9)]);
            $manager->persist($product);

        }

        $user = new User();
        $user->setEmail('fillard.nico@hotmail.fr');
        $user->setRoles([
            'ROLE_ADMIN'
        ]);
        $user->setPassword($this->encoder->encodePassword($user, 'diskoTest'));
        $manager->persist($user);

        $manager->flush();
    }
}
