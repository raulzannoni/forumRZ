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
                    "nbTopicsEachCat" => $topicManager->findAllAndCount(),
                    "posts" => $postManager->findAll(["date_post", "DESC"]),
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
        /*
        public function showAllTopicsByCategory($id){

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categoryName" => $_GET['category_name'],
                    "category" => $categoryManager->findOneById($id),
                    "categories" => $categoryManager->findAll(["title_topic", "DESC"]),
                    "topics" => $topicManager->listTopicsByCategory($id),
                    "nbTopicsEachCat" => $topicManager->findAllAndCount(),
                    "totalCountTopics" => $topicManager->getTotalCountTopics(),
                    "title" => "List of Topics by Category"
                ]
            ];
        }

        public function topicDetail($id){
            $topicManager = new TopicManager();
            //$postManager = new PostManager();
            //$likeManager = new LikeManager();
            //$userManager = new UserManager();
            $categoryManager = new CategoryManager();


            // No list of likes if not connected
            if(!empty($_SESSION["user"])) {
                return [
                    "view" => VIEW_DIR."forum/topicDetail.php",
                    "data" => [
                    //    "posts" => $postManager->findByTopicId($id),
                        "topicDetail" => $topicManager->findOneById($id),
                    //    "topicPostsCount" => $postManager->countByTopic($id),
                    //    "likeList" => $likeManager->topicUserLikeList($_SESSION["user"]->getId(), $id),
                    //    "listLikesTopic" => $likeManager->listLikesTopic($id),
                    //    "userConnectedRoleFromBdd" => $userManager->findOneById($_SESSION["user"]->getId())->getRole(),
                        "categories" => $categoryManager->findAll()              
                    ]
                ];
            }
            else {
                return [
                    "view" => VIEW_DIR."forum/topicDetail.php",
                    "data" => [
                    //    "posts" => $postManager->findByTopicId($id),
                        "topicDetail" => $topicManager->findOneById($id),
                    //    "topicPostsCount" => $postManager->countByTopic($id),
                    //   "listLikesTopic" => $likeManager->listLikesTopic($id),
                    ]
                ];
            }
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
        } */  

    }
