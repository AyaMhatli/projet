<?php
 namespace App\Entity; 
 use Doctrine\ORM\Mapping as ORM;
 
 class PropertySearch { 
     private $nom;

      public function getNom(): ?string 
      {
           return $this->nom;
         }
          public function setNom(string $nom): self 
          {
               $this->nom = $nom;
               
                return $this; 
}
 }