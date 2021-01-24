<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
             ->setPermission(Action::DELETE, 'ROLE_ADMIN')
             ->setPermission(Action::NEW, 'ROLE_ADMIN')
             ->setPermission(Action::EDIT, 'ROLE_ADMIN');
            // ->setPermission(Action::EDIT, 'ROLE_MANAGER','ROLE_ADMIN')
             //->setPermission(Action::DELETE, 'ROLE_MANAGER','ROLE_ADMIN');


             #->disable(Action::DELETE) ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('category'),
            TextField::new('product_name'),
            AssociationField::new('addedBy'),
            TextField::new('brand'),
            TextField::new('colour'),
            TextField::new('engine'),
            TextField::new('fuel_type'),
            TextField::new('milage'),
            ImageField::new('product_image')->setUploadDir("public/uploads/images"),
            //ChoiceField::new('status')->setChoices(["draft"=>"draft","review"=>"review","publish"=>"publish"]),
            TextField::new('stearing_side'),
            IntegerField::new('capacity'),
            IntegerField::new('tankSize'),
            BooleanField::new('stepney'),
            TextField::new('wheelType'),
            BooleanField::new('trunk'),
            IntegerField::new(('enginePower')),
            IntegerField::new('engineOilCapacity'),
            TextField::new('coolingSystemType'),
            TextField::new('coolantType'),
            IntegerField::new('airbagCount'),
            BooleanField::new('powerWindows'),
            BooleanField::new('sunroof')
            
        ];
    }
    
}
