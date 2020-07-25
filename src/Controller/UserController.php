<?php
    namespace App\Controller;

    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
    use Symfony\Component\Form\Forms;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use App\Entity\User;
    use App\Form\UserType;


    
    class UserController extends AbstractController{
        
        /**
        * @Route("/user")
        */
        function createUserForm(Request $request){
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            // $form = $this->createFormBuilder($user)
            //     ->add('name', TextType::class)
            //     ->add('email', EmailType::class)
            //     ->add('date', DateType::class)
            //     ->add('save', SubmitType::class)
            //     ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $userInfos = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userInfos);
                $entityManager->flush();

                return new Response('Formulaire validé');
            }

            return $this->render('form.html.twig', ['userform' => $form->createView()]);
        }
    }

?>