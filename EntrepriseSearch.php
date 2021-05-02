<?php 
namespace App\Entity;
 use Doctrine\ORM\Mapping as ORM;
  class EntrepriseSearch { 
      /**
        * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise") 
        */
         private $entreprise;
          public function getEntreprise(): ?entreprise { 
              return $this->entreprise;
             }
              public function setEntreprise(?Entreprise $entreprise): self
               {
                    $this->entreprise = $entreprise;
                     return $this;
               }
            }