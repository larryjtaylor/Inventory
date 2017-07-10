<?php
    class Description
    {
        private $detail;
        private $id;

        function __construct($detail, $id = null)
        {
            $this->detail = $detail;
            $this->id = $id;
        }

        function setDetail($new_detail)
        {
            $this->detail = (string) $new_detail;
        }

        function getDetail()
        {
            return $this->detail;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {

            $executed = $GLOBALS['DB']->exec("INSERT INTO descriptions (description) VALUES ('{$this->getDetail()}')");
            if ($executed) {
                 $this->id= $GLOBALS['DB']->lastInsertId();
                 return true;
            } else {
                 return false;
            }
        }

        static function getAll()
        {
            $returned_descriptions = $GLOBALS['DB']->query("SELECT * FROM descriptions;");
            $descriptions = array();
            foreach($returned_descriptions as $description) {
                $detail = $description['description'];
                $id = $description['id'];
                $new_description = new Description($detail, $id);
                array_push($descriptions, $new_description);
            }
            return $descriptions;
        }


        static function find($search_id)
        {
            $found_description = null;
            $returned_descriptions = $GLOBALS['DB']->prepare("SELECT * FROM descriptions WHERE id = :id");
            $returned_descriptions->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_descriptions->execute();
            foreach($returned_descriptions as $description) {
                $description_detail = $description['description'];
                $description_id = $description['id'];
                if ($description_id == $search_id) {
                  $found_description = new Description($description_detail, $description_id);
                }
            }
            return $found_description;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM descriptions;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }
    }
?>
