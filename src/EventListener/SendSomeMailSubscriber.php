<?php

namespace App\EventListener;

use App\Entity\Category;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class SendSomeMailSubscriber implements EventSubscriber
{
    private $mailer;
    

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
        ];
    }


    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if ($entity instanceof Category) {

            $category_name = $entity->getCategoryName();
            $email_to = $entity->getMuser()->getEmail();
            $email_content = "hello ".$email_to."<br>  you have been assigned the following category :  ".$category_name. " <br> please login the system to start operating";
            
            $email = new TemplatedEmail();
            $email->from('wanderlust.we.009@gmail.com');
            //$email->to('raghavrastogi09@gmail.com');
            $email->to($email_to);
            $email->subject("Categroy Assignment");
            $email->html($email_content);
            //$email->htmlTemplate('emails/category_notice.html.twig');

            
            $this->mailer->send($email);
        }

    }
}