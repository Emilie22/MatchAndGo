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
        {

            $user = new User();
            $user->setFirstname('Dupond');
            $user->setLastName('Emilie');
            $user->setCity('Montpellier');
            $user->setBirthday('1980-07-24');
            $user->setGender('Femme');
            $user->setPhone('062324510');
            $user->setPicture('totophoto');
            $user->setDescription('Baroudeuse aguerrie, j\'adore particulièrement l\'Amérique du Sud. J\'ai un goût prononcer pour la randonnée et les visites culturelles.');
            $user->setCountries('Pérou, Mexique, Argentine');
            $user->setEmail('Dupond.emilie@gmail.com');
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

        {

            $user = new User();
            $user->setFirstname('Giaconi');
            $user->setLastName('Jean');
            $user->setCity('Paris');
            $user->setBirthday('1990-10-03');
            $user->setGender('Homme');
            $user->setPhone('0745245803');
            $user->setPicture('jeanphoto');
            $user->setDescription('Très sportif, je recherche des voyages à sensation ou le sport est mis en avant.');
            $user->setCountries('USA, Australie, Chine');
            $user->setEmail('Giaconi.jean@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Vaugiraud');
            $user->setLastName('Mélanie');
            $user->setCity('Lyon');
            $user->setBirthday('1995-12-27');
            $user->setGender('Femme');
            $user->setPhone('0630204706');
            $user->setPicture('melaniephoto');
            $user->setDescription('J\'aime voyager confortablement et préfère les activités reposante.');
            $user->setCountries('Angleterre, Finlande, Suède');
            $user->setEmail('Vaugiraud.melanie@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Franchin');
            $user->setLastName('Paul');
            $user->setCity('Nice');
            $user->setBirthday('2000-01-17');
            $user->setGender('Homme');
            $user->setPhone('0645248783');
            $user->setPicture('paulphoto');
            $user->setDescription('Je suis très fêtard et recherche des voyages ou l\'ambiance est mis en avant .');
            $user->setCountries('Italie, Turquie, Grèce');
            $user->setEmail('Franchin.paul@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Ramont');
            $user->setLastName('Audrey');
            $user->setCity('Rennes');
            $user->setBirthday('1988-03-14');
            $user->setGender('Femme');
            $user->setPhone('0630145327');
            $user->setPicture('audreyphoto');
            $user->setDescription('Passionné par la photographie, je recherche avant tout des paysages atypique pour agrandir le contenu de mon blog.');
            $user->setCountries('Grèce, Tunisie, Portugal');
            $user->setEmail('Ramont.audrey@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Beric');
            $user->setLastName('Robert');
            $user->setCity('Nantes');
            $user->setBirthday('1983-12-30');
            $user->setGender('Homme');
            $user->setPhone('0734255730');
            $user->setPicture('robertphoto');
            $user->setDescription('J\'aimerais faire partager toutes mes connaissances sur l\'Asie à toute personne voulant découvrir ce merveilleux continent.');
            $user->setCountries('Japon, Thaïlande, Chine');
            $user->setEmail('Beric.robert@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

         {

            $user = new User();
            $user->setFirstname('Marks');
            $user->setLastName('Laura');
            $user->setCity('Strasbourg');
            $user->setBirthday('1987-06-11');
            $user->setGender('Femme');
            $user->setPhone('0625232754');
            $user->setPicture('lauraphoto');
            $user->setDescription('Je recherche avant tout de belle plage pour se reposer au calme.');
            $user->setCountries('Afrique du Sud, Réunion, Martinique');
            $user->setEmail('Beriol.laura@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Prudhomme');
            $user->setLastName('David');
            $user->setCity('Toulouse');
            $user->setBirthday('1988-07-12');
            $user->setGender('Homme');
            $user->setPhone('0740357862');
            $user->setPicture('davidphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Brésil, Argentine, Colombie');
            $user->setEmail('Prudhomme.david@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Trapp');
            $user->setLastName('Kevin');
            $user->setCity('Bordeaux');
            $user->setBirthday('1986-02-01');
            $user->setGender('Homme');
            $user->setPhone('0678423641');
            $user->setPicture('kevinphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Inde, Australie, Canada');
            $user->setEmail('Trapp.kevin@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Cardoso');
            $user->setLastName('Sophie');
            $user->setCity('Marseille');
            $user->setBirthday('1995-09-17');
            $user->setGender('Femme');
            $user->setPhone('0660452010');
            $user->setPicture('sophiephoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Nouvelle-Zélande, Polynésie Française, Réunion');
            $user->setEmail('Cardoso.sophie@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Austin');
            $user->setLastName('Léa');
            $user->setCity('Nancy');
            $user->setBirthday('1998-06-21');
            $user->setGender('Femme');
            $user->setPhone('0625470105');
            $user->setPicture('leaphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Espagne, Turquie, Italie');
            $user->setEmail('Austin.lea@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Ticot');
            $user->setLastName('Iris');
            $user->setCity('Genève');
            $user->setBirthday('2001-12-01');
            $user->setGender('Femme');
            $user->setPhone('0789251078');
            $user->setPicture('irisphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Equateur, Venezuela, Costa Rica');
            $user->setEmail('ticot.iris@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Vianello');
            $user->setLastName('Thibault');
            $user->setCity('Madrid');
            $user->setBirthday('1999-01-05');
            $user->setGender('Homme');
            $user->setPhone('0620845394');
            $user->setPicture('photo');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Equateur, Venezuela, Costa Rica');
            $user->setEmail('Vianello.thibault@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Da Silva');
            $user->setLastName('Eva');
            $user->setCity('Lisbonne');
            $user->setBirthday('1996-10-10');
            $user->setGender('Femme');
            $user->setPhone('0610781256');
            $user->setPicture('evaphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Portugal, Brésil, Uruguay');
            $user->setEmail('Dasilva.eva@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Guion');
            $user->setLastName('Stéphane');
            $user->setCity('Berlin');
            $user->setBirthday('1991-05-23');
            $user->setGender('Homme');
            $user->setPhone('0624451063');
            $user->setPicture('stephanephoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('France, Irlande, Suède');
            $user->setEmail('Guion.stephane@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Allois');
            $user->setLastName('Manon');
            $user->setCity('Londre');
            $user->setBirthday('1981-11-02');
            $user->setGender('Femme');
            $user->setPhone('0630783531');
            $user->setPicture('manonphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Japon, Russie, Maroc');
            $user->setEmail('Allois.manon@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Piralla');
            $user->setLastName('Lana');
            $user->setCity('Athènes');
            $user->setBirthday('1992-10-23');
            $user->setGender('Femme');
            $user->setPhone('0720451723');
            $user->setPicture('photo');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Algérie, Afrique du Sud, Bahamas');
            $user->setEmail('Piralla.lana@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Rodriguez');
            $user->setLastName('Pedro');
            $user->setCity('Seville');
            $user->setBirthday('1985-02-03');
            $user->setGender('Homme');
            $user->setPhone('0623010523');
            $user->setPicture('pedrophoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Namibie, Tanzanie, Swaziland');
            $user->setEmail('Rodriguez.predo@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Tevenot');
            $user->setLastName('Michael');
            $user->setCity('Bordeaux');
            $user->setBirthday('1980-11-14');
            $user->setGender('Homme');
            $user->setPhone('0603255367');
            $user->setPicture('michaelphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('USA, Canada, Chine');
            $user->setEmail('Tevenot.michael@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            //je rempli mon tableau users
            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Vuckovic');
            $user->setLastName('Andrea');
            $user->setCity('Moscou');
            $user->setBirthday('1981-04-13');
            $user->setGender('Femme');
            $user->setPhone('0610892536');
            $user->setPicture('andreaphoto');
            $user->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam facilisis odio at nibh eleifend finibus. Vivamus vel erat vitae sem ultricies volutpat sed at nibh. Aliquam congue pellentesque sem non iaculis. Mauris egestas ultrices erat faucibus eleifend. Vestibulum placerat egestas ante. Phasellus eget mauris odio. Integer tempus vulputate ipsum, at laoreet nibh sagittis a. Nullam semper id elit ut elementum. Nunc in velit venenatis, rutrum odio eu, euismod ipsum. Proin rutrum diam vel magna venenatis rhoncus. Etiam eget lectus non felis eleifend pellentesque et sit amet leo. Morbi ac turpis id sapien dictum mollis vitae non metus. Nam fermentum sapien est, eget egestas ligula venenatis vitae. Maecenas enim massa, finibus at neque porta, pulvinar posuere lacus. Suspendisse eu sapien interdum, accumsan sem et, tincidunt felis.');
            $user->setCountries('Australie, Thaïlande, Hawaï');
            $user->setEmail('Vuckovic.andrea@gmail.com');
            $roles =['ROLE_USER'];
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

