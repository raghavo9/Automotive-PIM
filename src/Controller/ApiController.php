<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


    /**
     * @Route("/myapi")
     */

class ApiController extends AbstractController
{   



    private $productRepository;

    public function __construct(ProductRepository $productRepository , UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }



     /**
     * @Route("/show", name="json_api")
     */
    public function json_api(ProductRepository $productRepository): Response
    {   
        $product  = $productRepository->findBy(array('status' => "publish" ));
        
        $data = array();

        foreach($product as $key=>$prod)
        {
            $data[$key]['category']=$prod->getCategory()->getCategoryName();
            $data[$key]['Name']=$prod->getProductName();
            $data[$key]['Brand']=$prod->getBrand();
            $data[$key]['Colour']=$prod->getColour();
            $data[$key]['Engine']=$prod->getEngine();
            $data[$key]['FuelType']=$prod->getFuelType();
            $data[$key]['Milage']=$prod->getMilage();
            $data[$key]['ProductImage']=$prod->getProductImage();
            $data[$key]['CreatedAt']=$prod->getCreatedAt()->format('d/m/Y H:i');
            $data[$key]['UpdatedAt']=$prod->getUpdatedAt()->format('d/m/Y H:i');
            $data[$key]['StearingSide']=$prod->getStearingSide();
            $data[$key]['Capacity']=$prod->getCapacity();
            $data[$key]['TankSize']=$prod->getTankSize();
            $data[$key]['Stepeny']=$prod->getStepney();
            $data[$key]['WheelType']=$prod->getWheelType();
            $data[$key]['Trunk']=$prod->getTrunk();
            $data[$key]['EnginePower']=$prod->getEnginePower();
            $data[$key]['EngineOilCapacity']=$prod->getEngineOilCapacity();
            $data[$key]['CoolingSystemType']=$prod->getCoolingSystemType();
            $data[$key]['CoolantType']=$prod->getCoolantType();
            $data[$key]['AirbagCount']=$prod->getAirbagCount();
            $data[$key]['PowerWindow']=$prod->getPowerWindows();
            $data[$key]['Sunroof']=$prod->getSunroof();
            $data[$key]['AddedBy']=$prod->getAddedBy()->getUsername();

            
        }
        
        //$response = new JsonResponse($product);
        //$response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return new JsonResponse($data);
    }


    /**
     * @Route("/add/", name="add_product", methods={"POST"})
     */

    public function add(Request $request, UserRepository $userRepository, CategoryRepository $categoryRepository , Security $security): JsonResponse
    {
        $user = $userRepository->findOneBy(['id'=>'1']);
        $data = json_decode($request->getContent(), true);
       
        //$addedBy = $this->getUser();

        $error_string =" ";
        $error_count =0;

        if(empty($data["product_category_id"])){
            $error_string.=" category id missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_name"])){
            $error_string.=" product_name is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_brand"])){
            $error_string.=" product_brand is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_colour"])){
            $error_string.=" product_colour missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_engine"])){
            $error_string.=" product_engine is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_fuel_type"])){
            $error_string.=" product_fuel_type is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_milage"])){
            $error_string.=" product_milage is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_image"])){
            $error_string.=" product_image is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_stearing_side"])){
            $error_string.=" product_stearing_side is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_capacity"])){
            $error_string.=" product_capacity is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_tank_size"])){
            $error_string.=" product_tank_size is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_stepney"])){
            $error_string.=" product_stepney is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_wheel_type"])){
            $error_string.=" product_wheel_type is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_trunk"])){
            $error_string.=" product_trunk is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_engine_power"])){
            $error_string.=" product_engine_power is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_engine_oil_capacity"])){
            $error_string.=" product_engine_oil_capacity is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_cooling_system_type"])){
            $error_string.=" product_cooling_system_type is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_coolant_type"])){
            $error_string.=" product_coolant_type is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_airbag_count"])){
            $error_string.=" product_airbag_count is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_power_windows"])){
            $error_string.=" product_power_windows is missing ,  ";
            $error_count+=1;
        }
        if(empty($data["product_sunroof"])){
            $error_string.=" product_sunroof is missing ,  ";
            $error_count+=1;
        }
       
        if($error_count==0)
        {
            $category = $categoryRepository->find($data["product_category_id"]);
            //$category = $data["product_category_id"];
            $product_name = $data["product_name"];
            $product_brand=$data["product_brand"];
            $product_colour =$data["product_colour"];
            $product_engine = $data ["product_engine"];
            $product_fuel_type = $data["product_fuel_type"];
            $product_milage = $data["product_milage"];
            $product_image = $data["product_image"];
            $product_stearing_side = $data["product_stearing_side"];
            $product_capacity = $data["product_capacity"];
            $product_tank_size = $data["product_tank_size"];
            $product_stepney = $data["product_stepney"];
            $product_wheel_type = $data["product_wheel_type"];
            $product_trunk = $data["product_trunk"];
            $product_engine_power= $data["product_engine_power"];
            $product_engine_oil_capacity =$data["product_engine_oil_capacity"];
            $product_cooling_system_type = $data["product_cooling_system_type"];
            $product_coolant_type = $data["product_coolant_type"];
            $product_airbag_count = $data["product_airbag_count"];
            $product_power_windows = $data["product_power_windows"];
            $product_sunroof = $data["product_sunroof"];
            $status= "draft"; 


            $this->productRepository->saveProduct(
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
                $user,
            );
            return new JsonResponse(['status' => 'product created!'], Response::HTTP_CREATED);



        }
        


        else
        {
            return new JsonResponse(['status' => 'error reported :'.$error_string], Response::HTTP_CREATED);
        }



        //if(empty($category)||
        //empty($product_name )||
        //empty($product_brand)||
        //empty($product_colour)||
        //empty($product_engine)||
        //empty($product_fuel_type)||
        //empty($product_milage)||
        //empty($product_image)||
        //empty($product_stearing_side)||
        //empty($product_capacity)||
        //empty($product_tank_size)||
        //empty($product_stepney)||
        //empty($product_wheel_type)||
        //empty($product_trunk)||
        //empty($product_engine_power)||
        //empty($product_engine_oil_capacity)||
        //empty($product_cooling_system_type)||
        //empty($product_coolant_type)||
        //empty($product_airbag_count)||
        //empty($product_power_windows)||
        //empty($product_sunroof) ){
        //    throw new NotFoundHttpException('Expecting mandatory parameters!');
        //}
        

    }


    
    /**
     * @Route("/get/{id}", name="get_one_product", methods={"GET"})
    */
    public function getOneProduct($id): JsonResponse
    {
        $product = $this->productRepository->findOneBy(['id' => $id]);
        $data=[ 
            'product_id'=>$product->getId(),
            'product_name' =>$product->getProductName(),
            'product_brand'=>$product->getBrand(),
            'product_colour'=>$product->getColour(),
            'product_engine'=>$product->getEngine(),
            'product_fuel_type'=>$product->getFuelType(),
            'product_milage'=>$product->getMilage(),
            'product_image'=>$product->getProductImage(),
            'product_stearing_side'=>$product->getStearingSide(),
            'product_capacity'=>$product->getCapacity(),
            'product_tank_size'=>$product->getTankSize(),
            'product_stepney'=>$product->getStepney(),
            'product_wheel_type'=>$product->getWheelType(),
            'product_trunk'=>$product->getTrunk(),
            'product_engine_power'=>$product->getEnginePower(),
            'product_engine_oil_capacity'=>$product->getEngineOilCapacity(),
            'product_cooling_system_type'=>$product->getCoolingSystemType(),
            'product_coolanay_type'=>$product->getCoolantType(),
            'product_airbag_count'=>$product->getAirbagCount(),
            'product_power_windows'=>$product->getPowerWindows(),
            'product_sunroof'=>$product->getSunroof(),
            'product_addedBy'=>$product->getAddedBy()
        ];

        return new JsonResponse(['product' => $data], Response::HTTP_OK);
    }
    
    /**
     * @Route("/get-all", name="get_all_product", methods={"GET"})
     */
    public function getAllProduct(): JsonResponse
    {
        $products= $this->productRepository->findAll();
        $data = [];

        foreach ($products as $product) {
            $data[] = [
            'product_id'=>$product->getId(),
            'product_name' =>$product->getProductName(),
            'product_brand'=>$product->getBrand(),
            'product_colour'=>$product->getColour(),
            'product_engine'=>$product->getEngine(),
            'product_fuel_type'=>$product->getFuelType(),
            'product_milage'=>$product->getMilage(),
            'product_image'=>$product->getProductImage(),
            'product_stearing_side'=>$product->getStearingSide(),
            'product_capacity'=>$product->getCapacity(),
            'product_tank_size'=>$product->getTankSize(),
            'product_stepney'=>$product->getStepney(),
            'product_wheel_type'=>$product->getWheelType(),
            'product_trunk'=>$product->getTrunk(),
            'product_engine_power'=>$product->getEnginePower(),
            'product_engine_oil_capacity'=>$product->getEngineOilCapacity(),
            'product_cooling_system_type'=>$product->getCoolingSystemType(),
            'product_coolanay_type'=>$product->getCoolantType(),
            'product_airbag_count'=>$product->getAirbagCount(),
            'product_power_windows'=>$product->getPowerWindows(),
            'product_sunroof'=>$product->getSunroof(),
            'product_addedBy'=>$product->getAddedBy()
            ];
            
        }
        return new JsonResponse(['products' => $data], Response::HTTP_OK);
    }


    /**
     * @Route("/update/{id}", name="update_product", methods={"PUT"})
     */
    public function updateProduct($id, Request $request , UserRepository $userRepository): JsonResponse
    {
        $product = $this->productRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy(['id'=>'1']);
        $this->productRepository->updateProduct($product, $data,$user);
        return new JsonResponse(['status' => 'product updated!']);
    }

     /**
     * @Route("/delete/{id}", name="delete_category", methods={"DELETE"})
     */
    public function deleteProduct($id): JsonResponse
    {
        $product= $this->productRepository->findOneBy(['id' => $id]);

        $this->productRepository->removeProduct($product);

        return new JsonResponse(['status' => 'product deleted']);
    }


}
