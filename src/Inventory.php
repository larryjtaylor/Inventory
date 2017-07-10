<?php
    class Collectible
    {
        private $item;

        function __construct($item)
        {
            $this->item = $item;
        }

        function setItem($new_item)
        {
            $this->item = (string) $new_item;
        }

        function getItem()
        {
            return $this->item;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO collectibles (item) VALUES ('{$this->getItem()}');");
            if ($executed) {
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
                $new_collectible = new Collectible($item);
                array_push($collectibles, $new_collectible);
            }
            return $collectibles;
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
