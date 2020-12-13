<?php

namespace App\DataFixtures;
use App\Entity\Articulo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AppFixtures extends Fixture
{
    /**
     * @var EncoderFactoryInterface
     */
    private $securityEncoderFactory;

    public function __construct(EncoderFactoryInterface $securityEncoderFactory)
    {
        $this->securityEncoderFactory = $securityEncoderFactory;
    }

    public function encodePassword(UserInterface $user, $password)
    {
        $encoder = $this->securityEncoderFactory->getEncoder($user);
        return $encoder->encodePassword($password, $user->getSalt());
    }

    public function load(ObjectManager $manager)
    {
        //Carga de 20 articulos
        for ($i = 0; $i < 20; $i++) {
            $articulo = new Articulo();
            $tallas = array("xs"  => "XS", 
                            "s"   => "S", 
                            "m"   => "M", 
                            "l"   => "L", 
                            "xl"  => "XL", 
                            "xxl" => "XXL");
            $articulo->setTalla(array_rand($tallas, 1));
            $color = array("blanco" => "Blanco", 
                           "negro"  => "Negro", 
                           "rojo"   => "Rojo", 
                           "verde"  => "Verde", 
                           "azul"   => "Azul");
            $articulo->setColor(array_rand($color, 1));
            $r=20/rand(1,20);
            $articulo->setPrecioUni(round($r,2));
            $manager->persist($articulo);
        }

        //Creacion Usuario Admin / admin
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $plainPassword = 'admin';
        $encoded = $this->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $manager->persist($user);

        $manager->flush();
    }
}
