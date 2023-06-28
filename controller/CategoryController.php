<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;

    
    class CategoryController extends AbstractController implements ControllerInterface{

        public function index(){
        
            $categoryManager = new CategoryManager();
            $userManager = new UserManager();

            if(!empty($_SESSION["user"])) {
                $userConnectedRoleFromBdd = $userManager->findOneById($_SESSION["user"]->getId())->getRole();
            }
            else {
                $userConnectedRoleFromBdd = "notConnected";
            }

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAllAndCount(),
                    "userConnectedRoleFromBdd" => $userConnectedRoleFromBdd

                ]
            ];
        
        }
    }
