<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/CDIA/Database.php';

// create the Silex application
$app = new Silex\Application();

// debug mode
$app['debug'] = true;

// inject Database object
$app['db'] = new cdia\Database();

// get all tasks for user id
$app->get('/tasks/user/{id}', function(Request $request, $id) use ($app) {    
    $query = <<<EOD
   
    SELECT * FROM `todos` 
    WHERE `uid` = :id
    ORDER BY `time_added` DESC;
       
EOD;
    
    $params = array(
        'id' => $id
    );

    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse($app['db']->fetchAll($query, $params));
        
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse($app['db']->fetchAll($query, $params));
    }
});

	
// get all tasks for user id and selected filter
$app->get('/tasks/user/{id}/filter/{filter}', function(Request $request, $id,$filter) use ($app) {    
    $query = <<<EOD
   
    SELECT todos.todo, todos.time_added, todos.id, categories.category 
    FROM todos INNER JOIN categories ON todos.id=categories.todo_id 
    WHERE categories.category = :filter AND todos.uid = :id;
       
EOD;
    
    $params = array(
        'id' => $id,
	 'filter' => $filter
    );

    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse($app['db']->fetchAll($query, $params));
        
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse($app['db']->fetchAll($query, $params));
    }
});







// get categories for specific task id
$app->get('/task/cat/{id}', function(Request $request, $id) use ($app) {
    $query = <<<EOD
    
    SELECT * FROM `categories` 
    WHERE `todo_id` = :id
                  
EOD;
    
    $params = array(
        'id' => $id
    );
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse($app['db']->fetchAll($query, $params));
        
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse($app['db']->fetchAll($query, $params));
    }
});

// get single task by id
$app->get('/task/{id}', function(Request $request, $id) use ($app) {
    $query = <<<EOD
    
    SELECT * FROM `todos` 
    WHERE `id` = :id
                  
EOD;
    
    $params = array(
        'id' => $id
    );
    
    if ($request->get('callback') !== NULL) {
        $response = new JsonResponse($app['db']->fetch($query, $params));
        
        return $response->setCallback($request->get('callback'));
    } else {
        return new JsonResponse($app['db']->fetch($query, $params));
    }
});

// run the app
$app->run();

?>