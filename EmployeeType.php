<?php

namespace App\Form;
use App\Entity\Entreprise; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('salaire')
            ->add('entreprise',EntityType::class,['class' => Entreprise::class, 'choice_label' => 'nomm', 'label' => 'Entreprise']);}
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
