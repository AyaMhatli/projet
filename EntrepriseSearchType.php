<?php

namespace App\Form;

use App\Entity\EntrepriseSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use App\Entity\Entreprise;
class EntrepriseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('entreprise',EntityType::class,['class' => Entreprise::class, 'choice_label' => 'nomm' , 'label' => 'Entreprise' ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EntrepriseSearch::class,
        ]);
    }
}
