<?php
    class Collectible 
    {

        private $item;
        private $id;

        function __construct($item, $id = null)
        {
            $this->item = $item;
            $this->id = $id;
        }

        function setItem($new_item)
        {
            $this->item = (string) $new_item;
        }

        function getItem()
        {
            return $this->item;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO collectibles (item) VALUES ('{$this->getItem()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_collectibles = $GLOBALS['DB']->query("SELECT * FROM collectibles;");
            $collectibles = array();
            foreach($returned_collectibles as $collectible) {
                $item = $collectible['item'];
                $id = $collectible['id'];
                $new_collectible = new Collectible($item, $id);
                array_push($collectibles, $new_collectible);
            }
            return $collectibles;
        }

        static function find($search_id)
        {
            $found_collectible = null;
            $returned_collectibles = $GLOBALS['DB']->prepare("SELECT * FROM collectibles WHERE id = :id");
            $returned_collectibles->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_collectibles->execute();
            foreach ($returned_collectibles as $collectible) {
               $collectible_item = $collectible['item'];
               $collectible_id = $collectible['id'];
               if ($collectible_id == $search_id) {
                  $found_collectible = new Collectible($collectible_item, $collectible_id);
               }
            }

            return $found_collectible;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM collectibles;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }
    }
?>
