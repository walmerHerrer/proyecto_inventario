<?php

namespace Pidia\Apps\Demo\Form;

use Pidia\Apps\Demo\Entity\Trabajador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrabajadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ->add('direccion')
            ->add('dni')
            ->add('cargo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trabajador::class,
        ]);
    }
}
