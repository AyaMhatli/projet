<?php 
namespace App\Entity;
 class SalarySearch {
      /** 
       * @var int|null 
       */ private $minSalary;
        /**
         * @var int|null 
         */ private $maxSalary;
          public function getMinSalary(): ?int { 
              return $this->minSalary;
             } 
             public function setMinSalary(int $minSalary): self { 
                 $this->minSalary = $minSalary;
                  return $this;
                 } 
                 public function getMaxSalary(): ?int { 
                     return $this->maxSalary; 
                    }
                     public function setMaxSalary(int $maxSalary): self
                      {
                           $this->maxSalary= $maxSalary;
    return $this;
                      }
                    }