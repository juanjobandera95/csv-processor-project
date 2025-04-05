<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use App\Repository\SubscriberRepository;

class SubscriberController extends AbstractController

{

    private $cache;


    public function __construct(CacheInterface $cache)

    {

        $this->cache = $cache;

    }


    /**

     * @Route("/api/subscribers", name="api_subscribers", methods={"GET"})

     */

    public function index(Request $request, SubscriberRepository $subscriberRepository): JsonResponse

    {

        $subscribers = $this->cache->get('subscribers_cache_key', function (ItemInterface $item) use ($request, $subscriberRepository) {

            $item->expiresAfter(3600);

            $criteria = array_filter($request->query->all());

            return $subscriberRepository->findBy($criteria);

        });


        return $this->json($subscribers);

    }

}