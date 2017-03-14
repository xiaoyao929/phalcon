<?php
use \Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function indexAction()
    {

    }

    public function registerAction(){
    	$user = new Admin();
    	$post = $this->request->getPost();
    	$post['password'] = md5($post['password']);

        //Store and check for errors
        $success = $user->save($post);

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";
            var_dump($user->getMessages());die;
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();

    }
}
