<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use App\Entity\Subscriber;

class CsvProcessor
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function processCsv(string $filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $record) {
            $subscriber = new Subscriber();
            $subscriber->setName($record['name']);
            $subscriber->setEmail($record['email']);
            $subscriber->setAge((int)$record['age']);
            $subscriber->setAddress($record['address']);

            $this->entityManager->persist($subscriber);
        }

        $this->entityManager->flush();
    }
}