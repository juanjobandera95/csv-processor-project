<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use App\Repository\SubscriberRepository;
// La clase SubscriberController extiende AbstractController, lo que le permite
// utilizar las funcionalidades del controlador base de Symfony.
class SubscriberController extends AbstractController
{
    // Propiedad privada para almacenar una instancia de CacheInterface.
    private $cache;

    // El constructor de la clase inyecta una instancia de CacheInterface,
    // que se utiliza para manejar el almacenamiento en caché.
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Define una ruta para el método index. La ruta es "/api/subscribers",
     * el nombre de la ruta es "api_subscribers", y acepta solicitudes GET.
     *
     * @Route("/api/subscribers", name="api_subscribers", methods={"GET"})
     */
    public function index(Request $request, SubscriberRepository $subscriberRepository): JsonResponse
    {
        // Intenta obtener los suscriptores del caché usando la clave 'subscribers_cache_key'.
        // Si no están en caché, ejecuta la función de callback para obtenerlos y almacenarlos.
        $subscribers = $this->cache->get('subscribers_cache_key', function (ItemInterface $item) use ($request, $subscriberRepository) {
            // Establece el tiempo de expiración del caché a 3600 segundos (1 hora).
            $item->expiresAfter(3600);

            // Filtra los parámetros de consulta de la solicitud para usarlos como criterios de búsqueda.
            $criteria = array_filter($request->query->all());

            // Usa el repositorio de suscriptores para encontrar suscriptores que coincidan con los criterios.
            return $subscriberRepository->findBy($criteria);
        });

        // Devuelve los suscriptores como una respuesta JSON.
        return $this->json($subscribers);
    }
}