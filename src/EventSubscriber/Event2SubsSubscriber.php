<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Mime\Email;

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
            AfterEntityPersistedEvent::class=>['sendEmail'],
            AfterEntityPersistedEvent::class=>['NoticeIt'],


        ];
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
            $email = (new Email())
            ->from('wanderlust.we.009@gmail.com')
            ->to('raghavrastogi09@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
            
            $this->mailer->send($email);
        }
    }



}
