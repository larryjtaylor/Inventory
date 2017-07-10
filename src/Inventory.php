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
    }
?>
