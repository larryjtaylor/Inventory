<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Inventory.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('tasks.html.twig', array('collectibles' => Collectible::getAll()));
    });

    $app->post("/collectibles", function() use ($app) {
        $collectible = new Collectible($_POST['item']);
        $collectible->save();
        return $app['twig']->render('create_collectible.html.twig', array('newcollectible' => $collectible));
    });

    $app->post("/delete_collectibles", function() use ($app) {
        Collectible::deleteAll();
        return $app['twig']->render('delete_collectibles.html.twig');
    });


    return $app;
?>
