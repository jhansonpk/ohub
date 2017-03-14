<?php
namespace mvc\controllers;

/**
 * Class TestController
 * @package mvc\controllers
 */
class TestController extends Controller
{


    public function actionIndex()
    {
        return $this->render('/test/index', [
            'title' => 'Teste desenvolvedor Full Stack'
        ]);
    }

    public function actionSuccess()
    {
        session_start();

        if(isset($_SESSION) && isset($_COOKIE))
        {
            return $this->render('/test/success', [
                'title' => 'Funcionou :)',
                'score' => $_SESSION['score'],
                'number' => $_SESSION['number'],
                'ip' => $this->getIp()
            ]);
        }
    }

    public function actionSend()
    {
        if(isset($_POST))
        {
            $email = $_POST['email'];
            $address = $_POST['address'];
            $score = $_POST['score'];

            preg_match_all('/([\d]+)/', $address, $match);
            $number = implode(".", $match[0]);

            if($number == '')
            {
                return 0;
            }
            else
            {
                $token = bin2hex(openssl_random_pseudo_bytes(32));

                $this->setCookieSession($email, $address, $number, $token, $score);
                $this->sendEmail($email, $token);

                return 1;
            }
        }
        else
        {
            header('Location: /404' );
        }
    }

    private function setCookieSession($email, $address, $number, $token, $score)
    {
        session_start();

        setcookie('email', $email, time() + (86400 * 30), '/');
        setcookie('address', $address, time() + (86400 * 30), '/');
        setcookie('number', $number, time() + (86400 * 30), '/');
        setcookie('token', $token, time() + (86400 * 30), '/');
        setcookie('score', $score, time() + (86400 * 30), '/');

        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['number'] = $number;
        $_SESSION['token'] = $token;
        $_SESSION['score'] = $score;


    }

    private function sendEmail($to, $token)
    {
        ini_set("SMTP","aspmx.l.google.com");

        $subject = 'Teste desenvolvedor Full Stack';
        $message = $token;

        $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: André Martins <jhansonpk@hotmail.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        mail($to, $subject, $message, $headers);
    }

}
