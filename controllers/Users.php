<?php

    require_once '../models/User.php';
    require_once '../helpers/session_helper.php';

    class Users {

        private $userModel;
        
        public function __construct(){
            $this->userModel = new User;
        }

        public function register(){
            //Process form
            
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'usersName' => trim($_POST['usersName']),
                'usersEmail' => trim($_POST['usersEmail']),
                'usersUid' => trim($_POST['usersUid']),
                'usersPwd' => trim($_POST['usersPwd']),
                'pwdRepeat' => trim($_POST['pwdRepeat'])
            ];

            //Validate inputs
            if(empty($data['usersName']) || empty($data['usersEmail']) || empty($data['usersUid']) || 
            empty($data['usersPwd']) || empty($data['pwdRepeat'])){
                echo '<script>
                alert("Please fill out all inputs");
                window.location.href = "../signup.php";
              </script>';
            }

            if(!preg_match("/^[a-zA-Z0-9]*$/", $data['usersUid'])){
                echo '<script>
                alert("Invalid username");
                window.location.href = "../signup.php";
              </script>';
            }

            if(!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)){
                echo '<script>
                alert("Invalid email");
                window.location.href = "../signup.php";
              </script>';
            }

            if(strlen($data['usersPwd']) < 6){
                echo '<script>
                alert("Invalid password");
                window.location.href = "../signup.php";
              </script>';
            } else if($data['usersPwd'] !== $data['pwdRepeat']){
                echo '<script>
                alert("Passwords don\'t match");
                window.location.href = "../signup.php";
              </script>';
            }

            //User with the same email or password already exists
            if($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersName'])){
                echo '<script>
                alert("Username or email already taken");
                window.location.href = "../signup.php";
              </script>';
            }

            //Passed all validation checks.
            //Now going to hash password
            $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

            //Register User
            if($this->userModel->register($data)){
                redirect("../login.php");
            }else{
                die("Something went wrong");
            }
        }

    public function login(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data=[
            'name/email' => trim($_POST['name/email']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if(empty($data['name/email']) || empty($data['usersPwd'])){
            echo '<script>
            alert("Please fill out all inputs");
            window.location.href = "../login.php";
          </script>';
            exit();
        }

        //Check for user/email
        if($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])){
            //User Found
            $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd']);
            if($loggedInUser){
                //Create session
                $this->createUserSession($loggedInUser);
            }else{
                echo '<script>
                alert("Password Incorrect");
                window.location.href = "../login.php";
              </script>';
            }
        } else {
            echo '<script>
                    alert("No user found");
                    window.location.href = "../login.php";
                  </script>';
        }
    }

    public function createUserSession($user){
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersName'] = $user->usersName;
        $_SESSION['usersEmail'] = $user->usersEmail;
        redirect("../AdminInventory.php");
    }

    public function logout(){
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("../AdminInventory.php");
    }
}

    $init = new Users;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            default:
            redirect("../AdminInventory.php");
        }
        
    }else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../AdminInventory.php");
        }
    }

    