<?php

namespace App\Repository;

use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Product::class);
        $this->manager = $manager;

    }


    /**
     * @return array Returns an array
     */

    public function findDownloadableData()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.status = :product_status')
            ->setParameter('product_status', 'publish')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function saveProduct(
            $category ,
            $product_name,
            $product_brand,
            $product_colour,
            $product_engine,
            $product_fuel_type,
            $product_milage,
            $product_image ,
            $product_stearing_side,
            $product_capacity,
            $product_tank_size,
            $product_stepney,
            $product_wheel_type,
            $product_trunk ,
            $product_engine_power,
            $product_engine_oil_capacity,
            $product_cooling_system_type,
            $product_coolant_type,
            $product_airbag_count,
            $product_power_windows,
            $product_sunroof,
            $status,
            $user
    ){
        $newproduct= new Product();
        $newproduct->setProductName($product_name)
        ->setBrand($product_brand)
        ->setColour($product_colour)
        ->setEngine($product_engine)
        ->setFuelType($product_fuel_type)
        ->setMilage($product_milage)
        ->setProductImage($product_image)
        ->setStearingSide($product_stearing_side)
        ->setCapacity($product_capacity)
        ->setTankSize($product_tank_size)
        ->setStepney($product_stepney)
        ->setWheelType($product_wheel_type)
        ->setTrunk($product_trunk)
        ->setEnginePower($product_engine_power)
        ->setEngineOilCapacity($product_engine_oil_capacity)
        ->setCoolingSystemType($product_cooling_system_type)
        ->setCoolantType($product_coolant_type)
        ->setAirbagCount($product_airbag_count)
        ->setPowerWindows($product_power_windows)
        ->setSunroof($product_sunroof)
        ->setStatus($status)
        ->setAddedBy($user)
        ->setCreatedAt(new \DateTime())
        ->setUpdatedAt(new \DateTime())
        ->setCategory($category);

        $this->manager->persist($newproduct);
        $this->manager->flush();
    }


    public function updateProduct(Product $product, $data,$user)
    {
        //$product->setProductName($data["product_name"]);
        //$product->setBrand($data["product_brand"]);
        //$product->setColour($data["product_colour"]);
        //$product->setEngine( $data ["product_engine"]);
        //$product->setFuelType($data["product_fuel_type"]);
        //$product->setMilage($data["product_milage"]);
        //$product->setProductImage($data["product_image"]);
        //$product->setStearingSide($data["product_stearing_side"]);
        //$product->setCapacity($data["product_capacity"]);
        //$product->setTankSize($data["product_tank_size"]);
        //$product->setStepney($data["product_stepney"]);
        //$product->setWheelType( $data["product_wheel_type"]);
        //$product->setTrunk($data["product_trunk"]);
        //$product->setEnginePower($data["product_engine_power"]);
        //$product->setEngineOilCapacity($data["product_engine_oil_capacity"]);
        //$product->setCoolingSystemType($data["product_cooling_system_type"]);
        //$product->setCoolantType($data["product_coolant_type"]);
        //$product->setAirbagCount($data["product_airbag_count"]);
        //$product->setPowerWindows($data["product_power_windows"]);
        //$product->setSunroof($data["product_sunroof"]);
        //$product->setAddedBy($user);
        //$product->setStatus("draft");
        //$product->setCreatedAt(new \DateTime());
        //$product->setUpdatedAt(new DateTime());

        if(!empty($data["product_name"])){
            $product->setProductName($data["product_name"]);
        }
        if(!empty($data["product_brand"])){
            $product->setBrand($data["product_brand"]);
        }
        if(!empty($data["product_colour"])){
            $product->setColour($data["product_colour"]);
        }
        if(!empty($data["product_engine"])){
            $product->setEngine( $data ["product_engine"]);
        }
        if(!empty($data["product_fuel_type"])){
            $product->setFuelType($data["product_fuel_type"]);
        }
        if(!empty($data["product_milage"])){
            $product->setMilage($data["product_milage"]);
        }
        if(!empty($data["product_image"])){
            $product->setProductImage($data["product_image"]);
        }
        if(!empty($data["product_stearing_side"])){
            $product->setStearingSide($data["product_stearing_side"]);;
        }
        if(!empty($data["product_capacity"])){
            $product->setCapacity($data["product_capacity"]);
        }
        if(!empty($data["product_tank_size"])){
            $product->setTankSize($data["product_tank_size"]);
        }
        if(!empty($data["product_stepney"])){
            $product->setStepney($data["product_stepney"]);
        }
        if(!empty($data["product_wheel_type"])){
            $product->setWheelType( $data["product_wheel_type"]);
        }
        if(!empty($data["product_trunk"])){
            $product->setTrunk($data["product_trunk"]);
        }
        if(!empty($data["product_engine_power"])){
            $product->setEnginePower($data["product_engine_power"]);
        }
        if(!empty($data["product_engine_oil_capacity"])){
            $product->setEngineOilCapacity($data["product_engine_oil_capacity"]);
        }
        if(!empty($data["product_cooling_system_type"])){
            $product->setCoolingSystemType($data["product_cooling_system_type"]);
        }
        if(!empty($data["product_coolant_type"])){
            $product->setCoolantType($data["product_coolant_type"]);
        }
        if(!empty($data["product_airbag_count"])){
            $product->setAirbagCount($data["product_airbag_count"]);
        }
        if(!empty($data["product_power_windows"])){
            $product->setPowerWindows($data["product_power_windows"]);
        }
        if(!empty($data["product_sunroof"])){
            $product->setSunroof($data["product_sunroof"]);
        }
        if(!empty($data["status"])){
            $product->setStatus($data["status"]);
        }
        $product->setUpdatedAt(new DateTime());
       
         $this->manager->flush();
    }

    public function removeProduct(Product $product)
    {
        $this->manager->remove($product);
        $this->manager->flush();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
