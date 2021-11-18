<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Security\UserAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {

     
       
         if ($this->getUser()) {

  
       
           
    
        return $this->redirectToRoute('dev-quiz_main');
     } //methode to delete account when the user is not connected since 3 years

     /**
      * else if ($this->getUser() && self::LOGIN_ROUTE === $request->attributes->get('_route')
             && $request->isMethod('POST') && $currentYear > $end) {

             ex : 2021
             $currentYear = date("d-m-Y"); 
             
             ex : 2024
             $end = date('d-m-Y', strtotime('+3 years'));
 
             $em = $this->getDoctrine()->getManager();
             $em->remove($user);
             $em->flush();
 
             $this->addFlash('success', 'Votre compte a été supprimé après avoir été inactivé pendant plus de 3 ans.');
 
             return $this->redirectToRoute('app_login');
 
             };
      */

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
