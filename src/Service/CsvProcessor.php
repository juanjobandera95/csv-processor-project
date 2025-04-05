<?php 

namespace App\Service;

// Importa las clases necesarias para el procesamiento de CSV y la gestión de entidades.
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use App\Entity\Subscriber;

// Define la clase CsvProcessor, que se encarga de procesar archivos CSV.
class CsvProcessor
{
    // Propiedad privada para almacenar una instancia de EntityManagerInterface.
    private $entityManager;

    // El constructor de la clase inyecta una instancia de EntityManagerInterface,
    // que se utiliza para interactuar con la base de datos.
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Método para procesar un archivo CSV dado su ruta de archivo.
    public function processCsv(string $filePath)
    {
        // Crea un lector de CSV a partir de la ruta del archivo proporcionada.
        $csv = Reader::createFromPath($filePath, 'r');
        // Establece la primera fila del CSV como el encabezado, que se usará como claves.
        $csv->setHeaderOffset(0);

        // Itera sobre cada registro del CSV.
        foreach ($csv->getRecords() as $record) {
            // Crea una nueva instancia de la entidad Subscriber.
            $subscriber = new Subscriber();
            // Establece los valores de las propiedades del suscriptor a partir del registro CSV.
            $subscriber->setName($record['name']);
            $subscriber->setEmail($record['email']);
            $subscriber->setAge((int)$record['age']);
            $subscriber->setAddress($record['address']);

            // Persiste el suscriptor en el contexto de la base de datos.
            $this->entityManager->persist($subscriber);
        }

        // Envía todas las operaciones de persistencia a la base de datos.
        $this->entityManager->flush();
    }
}