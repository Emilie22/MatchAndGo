<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Question;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        //lors de l'instanciation, on stocke dans l'attribut encoder, l'objet qui va nous permettre d'encoder les mdp
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $gender =['homme', 'femme'];
        $countries =['France', 'Italie', 'TotoLand'];
        for($i=1;$i<=5;$i++){

            $user = new User();
            $user->setFirstname('Toto' . $i);
            $user->setLastName('Tata' . $i);
            $user->setCity('Ville' . $i);
            $user->setBirthday(new \DateTime(date('Y-m-d H:i:s')));
            $user->setGender($gender[array_rand($gender)]);
            $user->setPhone('062324510');
            $user->setPicture('totophoto');
            $user->setDescription('toto est beau sous sont préo a dos de vélo et de chamo oooo');
            $user->setCountries($countries[array_rand($countries)]);
            $user->setEmail('toto' . $i . '@toto.to');
            if($i=== 1){//je veux que toto1 aie le rôle Admin
                $roles = ['ROLE_USER', 'ROLE_ADMIN'];
            }
            else{
                $roles =['ROLE_USER'];
            }
            $user->setRoles($roles);

            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        $manager->flush();
    }
}

