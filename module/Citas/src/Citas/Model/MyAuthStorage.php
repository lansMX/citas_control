<?php
/**
 * RecursosHumanos
 * MyAuthStorage.php
 * @author Juan Carlos Garcia Bonilla
 */

namespace Citas\Model;
use Zend\Authentication\Storage;

/**
 * Class MyAuthStorage
 * @package Rh\Model
 * @author Juan Carlos Garcia Bonilla
 */
class MyAuthStorage extends Storage\Session
{
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
        if ($rememberMe == 1){
            $this->session->getManager()->rememberMe($time);
        }
    }

    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
}