<?php

namespace Pidia\Apps\Demo\Form;

use Pidia\Apps\Demo\Entity\Almacen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlmacenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('telefono')
            ->add('direccion')
            ->add('ruc')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Almacen::class,
        ]);
    }
}
