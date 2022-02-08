<?php

namespace Pidia\Apps\Demo\Form;

use Pidia\Apps\Demo\Entity\OrdenPedido;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class OrdenPedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trabajador')
            ->add('almacen')
            ->add('cliente')
            ->add('fechaPedido', DateTimeType::class,[
                'widget'=>'single_text',
            ])
            ->add('detalles',CollectionType::class,[
                'entry_type' =>DetalleOrdenPedidoType::class,
                'entry_options' =>['label'=>false],
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrdenPedido::class,
        ]);
    }
}
