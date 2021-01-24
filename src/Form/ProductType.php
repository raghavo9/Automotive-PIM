<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product_name')
            ->add('brand')
            ->add('colour')
            ->add('engine')
            ->add('fuel_type')
            ->add('milage')
            ->add('product_image_file',FileType::class,[
                'mapped'=>false,
                'required' => false,
            ])
            //->add('createdAt')
            //->add('updatedAt')
            ->add('status',ChoiceType::class,[
                'choices'=>[
                    'draft'=>'draft',
                    'review'=>'review',
                    'publish'=>'publish'
                ]
            ])
            ->add('stearing_side')
            ->add('capacity')
            ->add('tankSize')
            ->add('stepney')
            ->add('wheelType')
            ->add('trunk')
            ->add('enginePower')
            ->add('engineOilCapacity')
            ->add('coolingSystemType')
            ->add('coolantType')
            ->add('airbagCount')
            ->add('powerWindows')
            ->add('sunroof')
            ->add('category')
            //->add('addedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
