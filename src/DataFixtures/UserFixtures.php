<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    } 
    
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5 ; $i++){
            $user = new User();
            $user->setEmail ("user".$i."@gmail.com");
            $user->setPassword($this->passwordEncoder->encodePassword(
                 $user,
                 'lePassword'.$i
             ));
             $user->setNom("Ridani".$i);
             $user->setPrenom("user".$i);
             $user->setPays("Belgique");
             $user->setAdress("Avenue Verdi 25, 1783");
            $manager->persist ($user);
        }

        $manager->flush();
    }
}
