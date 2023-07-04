<?php
namespace App\Service;

use App\Entity\Log;
use App\Entity\User;
use App\Repository\LogRepository;
use DateTimeImmutable;
use Symfony\Bundle\SecurityBundle\Security;

class LogService{

    public function __construct(
        private Security $security,
        private LogRepository $logRepo
    )
    {
        
    }

    /**
     * add log information to the database
     * 
     * @param $category :string ; $message : string
     * 
     */
    public function newLog(string $category, string $message, User $user = null )
    {   
        if(!$user){
            $user = $this->security->getUser() ;
        }
        $log = new Log;
        // si non suffisant penser à changer le paramètre dans le fich ier php.ini
        date_default_timezone_set("America/Guadeloupe");
        $log->setLogAt(new DateTimeImmutable('now'));
        $log->setUser($user);
        $log->setCategory($category);
        $log->setMessage($message);

        $this->logRepo->save($log,true);

    }
}
