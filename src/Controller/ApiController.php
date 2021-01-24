<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ApiController extends AbstractController
{

     /**
     * @Route("/jsonapi", name="json_api")
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
}
