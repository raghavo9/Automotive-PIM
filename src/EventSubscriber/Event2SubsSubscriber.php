<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class Event2SubsSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private $security;

    private $mailer;
    private $adminEmail;
    private $UserRepository;

    public function __construct(Security $security,MailerInterface $mailer, string $adminEmail,UserRepository $UserRepository)
    {
        $this->security = $security;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
        $this->UserRepository= $UserRepository;
    }
    

    public static function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            AfterEntityPersistedEvent::class=>['sendEmail'],
            AfterEntityPersistedEvent::class=>['NoticeIt'],
            AfterEntityUpdatedEvent::class => ['updateProduct'],


        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $email = new TemplatedEmail();
        $email->from('wanderlust.we.009@gmail.com');
        $email->to('raghavrastogi09@gmail.com');
        $email->htmlTemplate('emails/category_notice.html.twig');

        
        $this->mailer->send($email);
    }
    
    public function sendEmail(AfterEntityPersistedEvent $event , MailerInterface $mailer)
    {
        $entity = $event->getEntityInstance();

        //send mail after user created
        if ($entity instanceof User){
            $this->mailer->send((new NotificationEmail())
                ->subject('New user created')
                ->htmlTemplate('emails/user_notification.html.twig')
                ->from($this->adminEmail)
                ->to($this->adminEmail)
                ->context(['comment' => "user created"])
            );

        }
    }
    
    public function updateProduct(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if($entity instanceof Product)
        {
            $entity->setUpdatedAt(new DateTime());
        }
        return ;
    }

    //    //send mail to all authors when new category created
    //    if ($entity instanceof Category){
    //        $cat_name=$entity->getCategoryName();
    //        // $all_authors=$this->UserRepository->findBy(['roles' => 'ROLE_USER']);
//
    //        //$this->mailer->send((new NotificationEmail())
    //        //    ->subject('New Category created')
    //        //    ->htmlTemplate('emails/user_notification.html.twig')
    //        //    ->from($this->adminEmail)
    //        //    //->to($entity->getCategoryManagedBy())
    //        //    ->to($entity->getMuser()->getEmail())
    //        //// ->to($this->adminEmail)
    //        //    ->context(['comment' => $cat_name])
    //        //);
//
    //        //////////////////////////// ---------------------///////////////////////
//
    //        $email = (new Email())
    //        ->from('wanderlust.we.009@gmail.com')
    //        ->to('raghavrastogi09@gmail.com')
    //        //->cc('cc@example.com')
    //        //->bcc('bcc@example.com')
    //        //->replyTo('fabien@example.com')
    //        //->priority(Email::PRIORITY_HIGH)
    //        ->subject('Time for Symfony Mailer!')
    //        ->text('Sending emails is fun again!')
    //        ->html('<p>See Twig integration for better HTML integration!</p>')
    //        $mailer->send($email)
//
//
    //    }
//
    //}

    /*public function sendPNotification(AfterEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        //send mail after post status changed
        if ($entity instanceof Blog){
            $this->mailer->send((new NotificationEmail())
                ->subject('Post status changed')
                ->htmlTemplate('emails/user_notification.html.twig')
                ->from($this->adminEmail)
                ->to($this->adminEmail)
                ->context(['comment' => "post status changed"])
            );

        }

        //send mail after  comment status changed
        if ($entity instanceof Comment){
            $this->mailer->send((new NotificationEmail())
                ->subject('Comment status changed')
                ->htmlTemplate('emails/user_notification.html.twig')
                ->from($this->adminEmail)
                ->to($this->adminEmail)
                ->context(['comment' =>"comment status changed"])
            );

        }
    }*/


    public function NoticeIt(AfterEntityPersistedEvent $event ,MailerInterface $mailer )
    {
        $entity =  $event->getEntityInstance();
        if($entity instanceof Category)
        {
            dump("category is created");
            //  $email = (new Email())
            //  ->from('wanderlust.we.009@gmail.com')
            //  ->to('raghavrastogi09@gmail.com')
            //  //->cc('cc@example.com')
            //  //->bcc('bcc@example.com')
            //  //->replyTo('fabien@example.com')
            //  //->priority(Email::PRIORITY_HIGH)
            //  ->subject('Time for Symfony Mailer!')
            //  ->text('Sending emails is fun again!')
            //  ->html('<p>See Twig integration for better HTML integration!</p>');

            $email = new TemplatedEmail();
            $email->from('wanderlust.we.009@gmail.com');
            $email->to('raghavrastogi09@gmail.com');
            $email->htmlTemplate('emails/category_notice.html.twig');

            
            $this->mailer->send($email);
        }
    }



}
