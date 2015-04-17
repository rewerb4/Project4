<?php


$app = new \Slim\Slim();

$app->get('/', function()
{
    require_once '../src/views/login.html';

});

$app->get('/register', function()
{
    require_once'../src/views/Register.html';
});

$app->get('/profile', function()
{
    require_once'../src/views/profile.html';
});

$app->post('/twitter', function()
{
    require_once '../src/Common/Authentication/TwitterAuth.php';
});

$app->post('/newUser', function () use ($app)
{

    $try = new \Common\Authentication\SqLite();
    $x = $try->create($_POST['username'],$_POST['password'],$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['$twitter'] );

    if ($x === 1)
    {
        echo $app->response()->setStatus(404);
        echo $app->response()->getStatus();
        //return json_encode($app->response->header("Profile:Http:localhost:8080/profile/".$_POST[username],200));

    }


    else
    {

        echo $app->response()->setStatus(200);
        echo $app->response()->getStatus();
    }
});

$app->post('/auth', function() use ($app)
{
    //$username = ' ';
   // $password = ' ';
    //if(json_decode($body = $app->request->getBody()) != Null) {
       // $username = $body['username'];
       // $username = $body['username'];
    //}
        $try = new \Common\Authentication\SqLite();
        $x = $try->authenticate($_POST['username'], $_POST['password']);

        if ($x === 1) {
            echo $app->response()->setStatus(200);
            echo $app->response()->getStatus();
            //return json_encode($app->response->header("Profile:Http:localhost:8080/profile/".$_POST[username],200));

        } else {

            echo $app->response()->setStatus(404);
            echo $app->response()->getStatus();
        }


});

$app->run();