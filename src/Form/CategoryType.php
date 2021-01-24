<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category_name')
            ->add('category_description')
            //->add('createdAt')
            //->add('updatedAt')
            ->add('category_managedBy')
            ->add('muser');
            //->add('category_managedBy',EntityType::class,[
            //    'class' => User::class,
            //    'query_builder'=> function(UserRepository $userRepository){
            //        return $userRepository->createQueryBuilder('u')
            //        ->select('u')
            //        ->from('User','u')
            //        ->where('u.roles=?ROLE_MANAGER');
            //    }
            //]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
