<?php

namespace App\Entity;
namespace App\Entity;

// Importa el repositorio de suscriptores y las anotaciones de Doctrine para el mapeo de la base de datos.
use App\Repository\SubscriberRepository;
use Doctrine\ORM\Mapping as ORM;

// Define la clase como una entidad de Doctrine y especifica el repositorio asociado.
#[ORM\Entity(repositoryClass: SubscriberRepository::class)]
class Subscriber
{
    // Define la propiedad $id como la clave primaria de la entidad.
    // Se genera automáticamente y se mapea a una columna en la base de datos.
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Define la propiedad $name como una columna de cadena de texto con una longitud máxima de 255 caracteres.
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Define la propiedad $email como una columna de cadena de texto con una longitud máxima de 255 caracteres.
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // Define la propiedad $age como una columna de tipo entero.
    #[ORM\Column]
    private ?int $age = null;

    // Define la propiedad $address como una columna de cadena de texto con una longitud máxima de 255 caracteres.
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    // Método para obtener el valor de $id.
    public function getId(): ?int
    {
        return $this->id;
    }

    // Método para obtener el valor de $name.
    public function getName(): ?string
    {
        return $this->name;
    }

    // Método para establecer el valor de $name.
    // Devuelve la instancia actual para permitir el encadenamiento de métodos.
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Método para obtener el valor de $email.
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Método para establecer el valor de $email.
    // Devuelve la instancia actual para permitir el encadenamiento de métodos.
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    // Método para obtener el valor de $age.
    public function getAge(): ?int
    {
        return $this->age;
    }

    // Método para establecer el valor de $age.
    // Devuelve la instancia actual para permitir el encadenamiento de métodos.
    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    // Método para obtener el valor de $address.
    public function getAddress(): ?string
    {
        return $this->address;
    }

    // Método para establecer el valor de $address.
    // Devuelve la instancia actual para permitir el encadenamiento de métodos.
    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }
}