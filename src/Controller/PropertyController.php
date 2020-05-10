<?php
namespace App\Controller ;
use App\Entity\Property;
use App\Repository\PropertyRepository;

use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ManagerRegistry
     */

    private $em;

    public function __construct(PropertyRepository $repository , ManagerRegistry $em)
  {
      $this->repository = $repository;

      $this->em = $em;
  }

    /**
     * @Route("/blog", name="blog_list")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index (PaginatorInterface $paginator , Request $request):Response
    {
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request ->query ->getInt('page',1),6

        );
        return  $this->render('property/index.html.twig', [
             'current_menu' => 'properties' ,
              'properties' => $properties
            ]);
    }

    /**
     * @Route("/blog/{slug}.{id}", name="property.show" , requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property , string $slug):Response
    {
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show' , [
                'id' => $property->getId(), 'slug'=>$property->getSlug()
            ] , 301);
        }
        return  $this->render('property/show.html.twig' , [
            'property' => $property ,
            'current_menu' =>'properties'
        ]);
    }
}