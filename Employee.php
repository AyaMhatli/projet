<?php

namespace App\Entity;


use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\Length( 
     * min = 5, 
     * max = 50, 
     * minMessage = "Le nom d'un employee doit comporter au moins {{ limit }} caractères", 
     * maxMessage = "Le nom d'un employee doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotEqualTo(
     * value = 0, 
     * message = "Le salaire d’un employee ne doit pas être égal à 0 " 
     * ) 
     */
    
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="employees")
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
