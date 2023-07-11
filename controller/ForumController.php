<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    class ForumController extends AbstractController implements ControllerInterface{
        public function listTopics(){
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["name_category", "DESC"]),
                    "topics" => $topicManager->findAllAndCount(),
                    "totalCountTopics" => $topicManager->getTotalCountTopics(),
                    "title" => "List of Topics"
                ]
            ];
        }

        public function listCategories(){
        
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
        
        public function showAllTopicsByCategory($id){

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categoryName" => $_GET['category_name'],
                    "category" => $categoryManager->findOneById($id),
                    "categories" => $categoryManager->findAll(["title_topic", "DESC"]),
                    "topics" => $topicManager->listTopicsByCategory(["date_topic", "DESC"], $id),
                    "nbTopicsEachCat" => $topicManager->findAllAndCount(),
                    "totalCountTopics" => $topicManager->getTotalCountTopics(),
                    "title" => "List of Topics by Category"
                ]
            ];
        }

        public function topicDetail($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            //$likeManager = new LikeManager();
            $userManager = new UserManager();
            $categoryManager = new CategoryManager();

                return [
                    "view" => VIEW_DIR."forum/topicDetail.php",
                    "data" => [
                        "topic" => $topicManager->findOneById($id),
                        "post" => $postManager->findAllByTopic($id),
                        "user" => $userManager->findAllUsersByTopic($id),
                        "NbPosts" => $postManager->countAllPostsByTopic($id),
                        "lastPost" => $topicManager->getLastPostByTopic($id),
                        "userConnectedRoleFromBdd" => $userManager->findOneById($_SESSION["user"]->getId())->getPassword(),
                        "categories" => $categoryManager->findAll()              
                    ]
                ];
            
        }

        public function search() {

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            $inputSearch = filter_input(INPUT_POST, "searchInput", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($inputSearch) {
                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "categories" => $categoryManager->findAll(["name", "DESC"]),
                        //"topics" => $topicManager->listTopicBySearch($inputSearch),
                        //"totalCountTopics" => $topicManager->getSearchCountTopics($inputSearch),
                        "title" => "Search",
                        "searchText" => $inputSearch
                    ]
                ];
            }
            else {
                $_SESSION["error"] = "Invalid research";
                $this->redirectTo("forum", "index");
            }
        }
        
        public function users(){
            $userManager = new UserManager();

            if($userManager->findOneById($_SESSION["user"]->getId())->getRole() == "ROLE_ADMIN") {
                $users = $userManager->findAll();

                return [
                    "view" => VIEW_DIR."security/users.php",
                    "data" => [
                        "users" => $users
                    ]
                ];
            }
            else {
                $_SESSION["error"] = "You are no more Administrator";
                $this->redirectTo("security", "viewProfile");
            } 
        }

        public function createTopic() {

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $userManager = new UserManager();

            if (!empty($_SESSION['user'])) {

                $user = $_SESSION['user']->getId();

                    if(!empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["firstMsg"])){ 
                        
                        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);
                        $firstMsg = filter_input(INPUT_POST, "firstMsg", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                        $newTopicId = $topicManager->add(["user_id" => $user, "title" => $title, "category_id" => $category]);
                        $newPostId = $postManager->add(["user_id" => $user, "topic_id" => $newTopicId, "text" => $firstMsg]);
                        
                        // (lastPostId pas utilisé pour l'instant) update du lastPostId du topic apres insertion (ID vérifiés):
                        // $topicManager->updateLastPostId($newTopicId, $newPostId);
                        //$topicManager->updateLastPostIdMsg($newTopicId, $newPostId, $firstMsg);
    
                        $_SESSION["success"] = "Topic created successfully.";
                        $this->redirectTo("forum", "topicDetail", $newTopicId);
                    }
                    else {
                        $_SESSION["error"] = "You must fullfill all inputs.";
                        $this->redirectTo("forum", "listTopics");
                    }
                
            }
            else {
                $_SESSION["error"] = "You must be logged in to create topics";
                $this->redirectTo("security", "loginForm");
            } 
        }

        public function addPost() {

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $userManager = new UserManager();

            if (!empty($_SESSION['user'])) {
                $user = $_SESSION['user']->getId();
                $topicId = $_GET['topicId'];

                // Pour checker le status de l'utilisateur connecté, on prend pas le status du SESSION["user"] car ne se met pas à jour si changement Status BDD en cours de session
                if($userManager->findOneById($_SESSION["user"]->getId())->getStatus() == 0) {


                    if (!empty($_POST["postText"])) {

                        $msg = filter_input(INPUT_POST, "postText", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $newPostId = $postManager->add(["user_id" => $user, "text" => $msg, "topic_id" => $topicId]);

                        // (lastPostId pas utilisé pour l'instant) update du lastPostId du topic apres insertion (ID vérifiés):
                        // $topicManager->updateLastPostId($topicId, $newPostId);
                        //$topicManager->updateLastPostIdMsg($topicId, $newPostId, $msg);


                        $_SESSION["success"] = "Message added successfully.";
                        $this->redirectTo("forum", "topicDetail", $topicId);
                    }
                    else {
                        $_SESSION["error"] = "You must enter a message.";
                        $this->redirectTo("forum", "topicDetail", $topicId);
                    }
                }
                else {
                    $_SESSION["error"] = "You are currently muted or banned by an administrator";
                    $this->redirectTo("forum", "topicDetail", $topicId);
                }

            }
            else {
                $_SESSION["error"] = "You must be logged in to post something";
                $this->redirectTo("security", "connexionForm");
            }

        }

    }
