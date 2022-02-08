<?php

namespace Pidia\Apps\Demo\Form;
use Pidia\Apps\Demo\Entity\DetalleOrdenPedido;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetalleOrdenPedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producto')
            ->add('precioVenta')
            ->add('cantidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetalleOrdenPedido::class,
        ]);
    }
}
