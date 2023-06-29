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
        public function index(){

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["name_category", "DESC"]),
                    "topics" => $topicManager->findAll(["title_topic", "ASC"]),
                    //"posts" => $postManager->findAll(),
                    "totalCountTopics" => $topicManager->getTotalCountTopics(),
                    "title" => "List of Topics"
                ]
            ];
        }



        

    }
