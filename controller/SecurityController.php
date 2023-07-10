<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\LikeManager;
    use Model\Managers\CategoryManager;


    class SecurityController extends AbstractController implements ControllerInterface{

        public function index() {}

        public function loginForm() {
            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => []
            ];
        }

        public function registerForm() {
            return [
                "view" => VIEW_DIR."security/register.php",
                "data" => []
            ];
        }

        public function login() {

            $userManager = new UserManager();

            $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(isset($_POST["submit"])) {

                if($mail && $password){

                    $dbPassword = $userManager->getPasswordByMail($mail);

                    if($dbPassword !== false) {

                        $hash = $dbPassword->getPassword();

                        $user = $userManager->findOneByMail($mail);

                        if($user->getNickname() && password_verify($password, $hash)){
                            $_SESSION["success"] = "Login successfully complete! Welcome back ".$user->getNickname()."!";
                            
                            Session::setUser($user);
                            $this->redirectTo("home", "index");
                        }
                        else {
                            $_SESSION["error"] = "Incorrect password. Please try again...";
                            $this->redirectTo("security", "loginForm");
                            }
                    }
                    else {
                        $_SESSION["error"] = "There is no account associated with this mail...";
                        $this->redirectTo("security", "loginForm");
                        }
                }
                else {
                    $_SESSION["error"] = "Enter a valid email...";
                    $this->redirectTo("security", "loginForm");
                    }
            }
        }

        public function register() {

            $userManager = new UserManager();  

            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordCheck = filter_input(INPUT_POST, "passwordCheck", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            

            // check si les filtres passent 
            if($nickname && $mail && $password && $passwordCheck){
                if ($password != $passwordCheck) {
                    $_SESSION["error"] = "Passwords doesn't match";
                    return [
                        "view" => VIEW_DIR."home.php",
                    ];
                }
                else {
                    // Check if user exists (mail), false or objet NULL if still exist:
                    $userMail = $userManager->findOneByMail($mail);

                    if(!$userMail) {
                        //check if user exists (username):
                        $userPseudo = $userManager->findOneByNickname($nickname);
                        if(!$userPseudo) {
                        
                            // Hash Password:
                            $finalPassword = password_hash($password, PASSWORD_DEFAULT);

                            // add user:
                            $newUserId = $userManager->add(
                                                        [
                                                            "nickname" => $nickname, 
                                                            "mail" => $mail, 
                                                            "password" => $finalPassword
                                                        ]);

                            $_SESSION["success"] = "Registration complete! Welcome to the FORUM ".$nickname."!";
                            $this->redirectTo("security", "loginForm");
                        }
                        else {
                            $_SESSION["error"] = "This nickname already exist!";
                            $this->redirectTo("security", "registerForm");
                        }
                    }
                    else {
                        $_SESSION["error"] = "This email is already taken!";
                        $this->redirectTo("security", "registerForm");
                    }

                }
            }
            else {
                $_SESSION["error"] = "Please enter a valide email...";
                $this->redirectTo("security", "registerForm");
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            $this->redirectTo("security", "loginForm");
        }

        public function viewProfile($userId) {}
        public function viewUserProfile($userId) {}
    }