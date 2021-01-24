<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Form\ProductType;
use App\Form\Product_Add_Type;
use App\Repository\ProductRepository;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Gedmo\Sluggable\Util\Urlizer;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{

    public function __construct(
        AdminUrlGenerator $adminUrlGenerator, 
        ProductRepository $productRepository, 
        CategoryRepository $categoryRepository,
        LoggerInterface $logger
    ) {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->logger = $logger;
    }

    /**
     * @Route("/import", name="import")
     */

    public function importPost(Request $request,Security $security)
    {
        $product = new Product();
        $form = $this->createForm(Product_Add_Type::class, $product);        
        $form->handleRequest($request);

        $importedFile = $form->get('import_file')->getData();
        if ($form->isSubmitted() && $importedFile) {
            $jsonData = file_get_contents($importedFile);
            dump($jsonData);
            $entityManager = $this->getDoctrine()->getManager();

            try{
                $productData = json_decode($jsonData);
                dump($productData);
                foreach ($productData as $productItem) {
                    dump($productItem);
                    $newProduct = new Product();
                    $category = $this->categoryRepository->find($productItem->product_category_id);
                    if(!empty($category)){
                        $newProduct->setCategory($category);
                    }
                    $this->logger->error('just after initializing category variable.');
                    

                    //$this->logger->error('after long desc.');
                    //$newprod->setHeight($prodItem->height);
                    //$this->logger->error('after height.');
                    //$newprod->setWidth($prodItem->width);
                    //$this->logger->error('after width.');
                    //$newprod->setColor($prodItem->color);

                    //$newProduct->setCategory($productItem->product_category);
                    $newProduct->setAddedBy($this->getUser());
                    $this->logger->error('after AddedBy.');
                    $newProduct->setProductName($productItem->product_name);
                    $this->logger->error('after product name.');
                    $newProduct->setBrand($productItem->product_brand);
                    $this->logger->error('after brand.');
                    $newProduct->setColour($productItem->product_colour);
                    $this->logger->error('after colour.');
                    $newProduct->setEngine($productItem->product_engine);
                    $this->logger->error('after engine.');
                    $newProduct->setFuelType($productItem->product_fuel_type);
                    $this->logger->error('after fuelType.');
                    $newProduct->setMilage($productItem->product_milage);
                    $this->logger->error('after milage.');
                    $newProduct->setProductImage($productItem->product_image);
                    $this->logger->error('after image.');
                    $newProduct->setCreatedAt(new \DateTime());
                    $this->logger->error('after createdAt');
                    $newProduct->setUpdatedAt(new \DateTime());
                    $this->logger->error('after updatedAt.');
                    $newProduct->setStearingSide($productItem->product_stearing_side);
                    $this->logger->error('after stearingSide.');
                    $newProduct->setCapacity($productItem->product_capacity);
                    $this->logger->error('after capacity.');
                    $newProduct->setTankSize($productItem->product_tank_size);
                    $this->logger->error('after tankSize.');
                    $newProduct->setStepney($productItem->product_stepney);
                    $this->logger->error('after stepney.');
                    $newProduct->setWheelType($productItem->product_wheel_type);
                    $this->logger->error('after wheelType.');
                    $newProduct->setTrunk($productItem->product_trunk);
                    $this->logger->error('after trunk.');
                    $newProduct->setEnginePower($productItem->product_engine_power);
                    $this->logger->error('after engine power.');
                    $newProduct->setEngineOilCapacity($productItem->product_engine_oil_capacity);
                    $this->logger->error('after engine oil capacity.');
                    $newProduct->setCoolingSystemType($productItem->product_cooling_system_type);
                    $this->logger->error('after cooling system type.');
                    $newProduct->setCoolantType($productItem->product_coolant_type);
                    $this->logger->error('after coolant type.');
                    $newProduct->setAirbagCount($productItem->product_airbag_count);
                    $this->logger->error('after airbagCount.');
                    $newProduct->setPowerWindows($productItem->product_power_windows);
                    $this->logger->error('after power windows.');
                    $newProduct->setSunroof($productItem->product_sunroof);
                    $this->logger->error('after sunroof');
                    $newProduct->setStatus('draft');
                    $this->logger->error('after status.');

                    $entityManager->persist($newProduct);
                    $this->logger->error('after declaring entityManager.');
                    $entityManager->flush();
                    $this->logger->error('after flush .');
                }
                $this->addFlash('success', 'Product(s) data has been imported successfully');
                $this->logger->info('Data imported', $productData);
                
            }
            catch (\Exception $e){
                $this->addFlash('error', 'Unable to import data correctly.');
                $this->logger->error('Unable to import data correctly.');
            }
        }
        else{
            $this->logger->error('File was not uploaded');
        }

        return $this->render('product/import_product.html.twig', [
            'form' => $form->createView(),
            'curr_user'=> $security->getUser()
        ]);
    }

    /**
     * @Route("/export", name="export")
     */

    public function exportPost()
    {
        try {
            $product = $this->productRepository->findDownloadableData();
            $filename = sprintf("%s_%s.json", 'EXPORT_FILE_POST',microtime(true));
            if(empty($product)){
                $this->addFlash('error', "There are no post(s) available in the list.");
            }else{
                $response = new Response(json_encode($product)); 
                $disposition = HeaderUtils::makeDisposition(
                    HeaderUtils::DISPOSITION_ATTACHMENT,
                    $filename
                );
                $response->headers->set('Content-Disposition', $disposition);

                return $response;
            }
        } catch (\Exception $e) {
            $this->addFlash('error', "Something wrong!! Try to find the perfect exception.");
        }
        
        return $this->redirectToRoute('product_index');
    }




    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository,Security $security): Response
    {
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN")
        {
            return $this->render('product/index.html.twig', [
                'products' => $productRepository->findAll(),
                'curr_user'=> $security->getUser()
            ]);
        }


        //$prods=$this->getUser()->getCategories();
        $prods=$this->getUser()->getMcat();
        
        $uid = $this->getUser()->getId();
        //dump($uid);
        $em =  $this->getDoctrine()->getManager();
        $prods = $em->getRepository(Category::class)->findBy(array('muser'=>$uid));
        //dump($prods);
        //foreach($prods as $pd)
        //{
        //    echo $pd->getId() . "<br>";   //this is category id 
        //}

        $prods_req = $em->getRepository(Product::class)->findBy(array('category'=>2));
        //dump($prods_req);

        $mreq = array();
        foreach($prods as $pd)
        {
            $val=$pd->getId();
            //var_dump($val);
            array_push($mreq,$em->getRepository(Product::class)->findBy(array('category'=>$val)));
        }

        //dump($mreq);


        return $this->render('product/index.html.twig', [
            //'products' => $productRepository->findAll(),
            'products' => $this->getUser()->getProducts(),
            'curr_user'=> $security->getUser(),
            'mdata'=>$mreq,
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request,Security $security): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             //dd($form['product_image_file']->getData());
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['product_image_file']->getData();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/images';
            //dd($destination);
            //$destination = "/uploads/images";
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $product->setProductImage($newFilename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'curr_user'=> $security->getUser()
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product,Security $security): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'curr_user'=> $security->getUser()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product,Security $security): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'curr_user'=> $security->getUser()
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }


   
    
}
