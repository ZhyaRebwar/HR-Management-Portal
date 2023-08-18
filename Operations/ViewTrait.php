<?php

namespace Operations;

trait ViewTrait
{

    public function get(?array $params): void
    {
        //to get the user portion of the array.
        $params = $params['users'];

        $class = __CLASS__;
        echo "\n$class is invoked \n";
        // var_dump( $params );

        if (!$params['id_user']) {
            // echo "true";
            $this->view(
                $params['id_self'],
                $params['title_self']
            );
        } else {
            // echo "false";
            $this->viewUser(...$params);
        }
    }

    public function viewUser(int $id_self, int $id_user, string $title_self, string $title_user): void
    {
        echo "\nviewuser is activated";
        //1. now we create a class to identify the job of the self and user title
        //to be able to check whether the information is allowed to share or not.

        
        //1.5 aya employee'aka sar ba supervisor'akaya...    awa bo supervisor.

        //2. get the user from the database and do it by calling the view method.    
        
    }

    //done.
    public function view(int $id, string $title): void
    {
        echo "\nView is activated";
        $result = $this->getUser($id, $title);

        echo json_encode( $result );
    }

    public function getUser(int $id, string $title): array
    {

        $this->userObj->selectUser();

        $statement = $this->userObj->db->prepare( $this->userObj->query() );

        $statement -> execute(
            [
                'id' => $id
            ]);

        $result = $statement -> fetch();

        return $result;
    }
}
