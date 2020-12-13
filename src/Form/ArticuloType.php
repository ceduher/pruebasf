<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('talla', ChoiceType::class,[
                'choices' => [
                    'xs' => 'XS',
                    's' => 'S',
                    'm' => 'M',
                    'l' => 'L',
                    'xl' => 'XL',
                    'xxl' => 'XXL',
                ]])
            ->add('color', ChoiceType::class,[
                'choices' => [
                    'blanco' => 'Blanco',
                    'negro' => 'Negro',
                    'rojo' => 'Rojo',
                    'verde' => 'Verde',
                    'azul' => 'Azul',
                ]])
            ->add('precio_uni')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
