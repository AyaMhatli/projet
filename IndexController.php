<?php namespace App\Controller;
use App\Entity\Employee;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
 use Symfony\Component\Validator\Constraints as Assert;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response; 
 use Symfony\Component\HttpFoundation\Request;
 Use Symfony\Component\Routing\Annotation\Route;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; 
 use Symfony\Component\Form\Extension\Core\Type\TextType; 
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 use App\Form\EmployeeType;
 use App\Entity\EntrepriseSearch; 
 use App\Form\EntrepriseSearchType;
 use App\Entity\SalarySearch;
 use App\Form\SalarySearchType;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

 class IndexController extends AbstractController {
 

  /** 
   *@Route("/",name="employee_list") 
   */
   public function home(Request $request) 
   {
      $propertySearch = new PropertySearch();
       $form = $this->createForm(PropertySearchType::class,$propertySearch); 
       $form->handleRequest($request);
       $employees= []; 
       if($form->isSubmitted() && $form->isValid()) {
        $nom = $propertySearch->getNom(); 
        if ($nom!="")
        $employees= $this->getDoctrine()->getRepository(Employee::class)->findBy(['nom' => $nom] );
       }
       return $this->render('employees/index.html.twig',[ 'form' =>$form->createView(), 'employees' => $employees]);
      }
       /** 
  * @Route("/employee/save")
  */
   public function save() {
       $entityManager = $this->getDoctrine()->getManager(); 
       $employee = new employee();
        $employee->setNom('employee 1'); 
        $employee->setSalaire(1000);
         $entityManager->persist($employee);
          $entityManager->flush(); 
          return new Response('employee enregisté avec id '.$employee->getId());
      }
       /** 
       * @IsGranted("ROLE_EDITOR") 
       * @Route("/employee/new", name="new_employee")
       * Method({"GET", "POST"})
        */
        public function new(Request $request) { 
          $employee = new Employee(); 
          $form = $this->createForm(EmployeeType::class,$employee); 
          $form->handleRequest($request); 
             if($form->isSubmitted() && $form->isValid()) {
                   $employee= $form->getData();
                    $entityManager = $this->getDoctrine()->getManager(); 
                    $entityManager->persist($employee);
                     $entityManager->flush(); 
                     return $this->redirectToRoute('employee_list');
                 }
                  return $this->render('employees/new.html.twig',['form' => $form->createView()]);
                 }
               
     
  /**
    * @Route("/employee/{id}", name="employee_show") 
    */
   public function show($id) 
   {
        $employee= $this->getDoctrine()->getRepository(Employee::class) 
        ->find($id);
         return $this->render('employees/show.html.twig', array('employee' => $employee));
   }
   /**
    * @IsGranted("ROLE_EDITOR")
     * @Route("/employee/edit/{id}", name="edit_employee") 
     * Method({"GET", "POST"}) 
     */ 
    public function edit(Request $request, $id) 
    { $employee = new Employee(); 
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
         $form = $this->createForm(EmployeeType::class,$employee) ;
         $form->handleRequest($request); 
         if ($form->isSubmitted() && $form->isValid()) 
         {
              $entityManager = $this->getDoctrine()->getManager(); 
              $entityManager->flush();
               return $this->redirectToRoute('employee_list');
             }
              return $this->render('employees/edit.html.twig', ['form' => $form->createView()]);  
            }
            
     /** 
      *@IsGranted("ROLE_EDITOR")
      * @Route("/employee/delete/{id}",name="delete_employee") 
      * @Method({"DELETE"}) 
      */
       public function delete(Request $request, $id) {
            $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id); 
            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($employee); 
             $entityManager->flush(); 
             $response = new Response();
              $response->send(); 

        return $this->redirectToRoute('employee_list');         

       }
       /**
         * @Route("/entreprise/newEnt", name="new_entreprise") 
         * Method({"GET", "POST"}) 
         */
        public function newEntreprise(Request $request) {
              $entreprise = new Entreprise();
               $form = $this->createForm(EntrepriseType::class,$entreprise);
                $form->handleRequest($request);
                 if($form->isSubmitted() && $form->isValid()) {
                       $employee = $form->getData();
                        $entityManager = $this->getDoctrine()->getManager();
                         $entityManager->persist($entreprise);
                          $entityManager->flush();
                          }
                           return $this->render('employees/newEntreprise.html.twig',['form'=> $form->createView()]);
 }
 /**
   * @Route("/emp_ent/", name="employee_par_ent")
    * Method({"GET", "POST"}) 
    */ 
    public function employeesParEntreprise(Request $request) 
    {
       $entrepriseSearch = new EntrepriseSearch(); 
       $form = $this->createForm(EntrepriseSearchType::class,$entrepriseSearch);
        $form->handleRequest($request); 
        $employees= [];
        if($form->isSubmitted() && $form->isValid()) 
        {
           $entreprise= $entrepriseSearch->getEntreprise(); 
           if ($entreprise!="") 
           $employees= $entreprise->getEmployees(); 
           else
            $employees= $this->getDoctrine()->getRepository(Employee::class)->findAll();
           } 
           return $this->render('employees/employeesParEntreprise.html.twig',['form' => $form->createView(),'employees' => $employees]); }
/** 
 * @Route("/emp_salaire/", name="employee_par_salaire") 
 * Method({"GET"}) 
 */
 public function employeesParSalaire(Request $request) {
    $salarySearch = new SalarySearch();
     $form = $this->createForm(SalarySearchType::class,$salarySearch);
      $form->handleRequest($request); 
      $employees= [];
       if($form->isSubmitted() && $form->isValid())
        {
           $minSalary= $salarySearch->getMinSalary();
            $maxSalary= $salarySearch->getMaxSalary();
             $employees= $this->getDoctrine()-> getRepository(Employee::class)->findBySalaryRange($minSalary,$maxSalary); 
            }
 return $this->render('employees/employeesParSalaire.html.twig',[ 'form' =>$form->createView(), 'employees' => $employees]);}





          }