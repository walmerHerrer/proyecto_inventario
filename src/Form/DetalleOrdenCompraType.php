<?php

namespace Pidia\Apps\Demo\Form;
use Pidia\Apps\Demo\Entity\DetalleOrdenCompra;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetalleOrdenCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producto')
            ->add('precioProveedor')
            ->add('cantRecibida')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetalleOrdenCompra::class,
        ]);
    }
}
