<?php 

    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    use Psr\Log\LoggerInterface;
    use App\Service\Greeter;
    

    class HelloController extends AbstractController{


        /**
        * @Route("/helloService")
        */ 
        function helloService(Greeter $greeter){
            $message = $greeter->greet();
            
            return new Response($message);
        }

        /**
        * @Route("/helloLogger")
        */ 
        function helloLogger(LoggerInterface $logger){
            $logger->alert('logger !');
            
            return $this->render('hello.html.twig');
        }

        /**
        * @Route({
        *    "fr" : "/bonjour",
        *    "en" : "/hello"})
        */       
        function helloLocale(Request $request){
            $locale = $request->getLocale();
            return new Response('Hello, locale: '. $locale);
        }

        /**
        * @Route("hello")
        */       
        function hello(Request $request){
            return $this->render('hello.html.twig'); //Part One
        }

        /**
        * @Route("hello/{param}", requirements={"param"="\d+"}, methods={"GET"})
        */       
        function helloNumber(Request $request, $param){
            return new Response('Hello number: '. $param); //Part One
        }

        /**
        * @Route("hello/{name}", name="helloWithName")
        */       
        function helloWithName(Request $request, $name){
            return new Response('Hello !  '. $name); //Part One 
            
            //return $this->render('base.html.twig'); //Part Two
            
            //$title = "utilisateurs";
            //$users = ["Bayon", "Viviane", "Mara", "Shannaz", "Muni", "Amia"]; //Part three
            //return $this->render('hello.html.twig', ['title'=> $title, 'array'=> $users]);

            //var_dump($request->query);die;
            //$params = $request->query->all();
            //$string = "Les paramètres sont : </br>"; //Part four
            //foreach($params as $key => $value){
            //    $string = $string . '-' . $key . ':' . $value . '</br>';
            //}
            //return new Response($string);
        }

        
    }
?>