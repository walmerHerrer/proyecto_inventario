<?php

namespace Pidia\Apps\Demo\Form;

use Pidia\Apps\Demo\Entity\Despacho;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Pidia\Apps\Demo\Entity\Producto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class DespachoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trabajador')
            ->add('almacen')
            ->add('fechaSalida', DateTimeType::class,[
                'widget'=>'single_text',
            ])
            ->add('itemsDesapachados')
            ->add('cantidadDespacho')
            ->add('productos', EntityType::class, [
                'class' => Producto::class,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Despacho::class,
        ]);
    }
}
