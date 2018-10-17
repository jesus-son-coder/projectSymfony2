<?php
namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use TechCorp\FrontBundle\Entity\User;
// use TechCorp\FrontBundle\Entity\Status;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    const MAX_NB_USERS = 10;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $userManager = $this->container->get('fos_user.user_manager');

        for($i=0; $i<self::MAX_NB_USERS; ++$i) {
            // On crée un nouvel utilisateur aléatoire
            $user = $userManager->createUser();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setPlainPassword($faker->password);
            $user->setEnabled(true);

            $manager->persist($user);
        }

        // On crée un utilisateur dont on contrôle le nom et le mot de passe :
        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setEmail($faker->email);
        $user->setPlainPassword('password');
        $user->setEnabled(true);

        $manager->persist($user);

        $manager->flush();
    }

}
