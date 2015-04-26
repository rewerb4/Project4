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


$app->post('/twitter', function()
{
    require_once '../src/Common/Authentication/TwitterAuth.php';
});


$app->post('/auth', function() use ($app)
{

        $username = $app->request->params('username');
        $password = $app->request->params('password');
        $x = new \Common\Authentication\SqLite($username,$password);


        if ($x->authenticate() === 1)
        {
            echo $app->response()->setStatus(200);
            $user = new \Functions\ValuesSet($username, $password);
            $profile = new \Common\Authentication\SQLite2($user);

            $X = $profile->getProfileData();
            $X = json_encode($X);
            echo $X;

        }
        else
        {

            $app->response()->setStatus(404);

        }


});

    $app->post('/newUser', function() use ($app)
        {

            $user = new \Functions\ValuesSet($app->request->params('username'), $app->request->params('password'));
            $user->setFirstName($app->request->params('fname'));
            $user->setLastName($app->request->params('lname'));
            $user->setEmail($app->request->params('email'));
            $user->setTwitterName($app->request->params('twitter'));



            $reg = new \Common\Authentication\SQLite2($user);
            $y = $reg->registerNewUser();
            if($y!=1)
                    {

                    $app->response()->setStatus(404);
                    echo $app->response()->getStatus();return json_encode($app->response()->header('failed.',404));
                }
            if ($y==1)
               {

                    $app->response()->setStatus(200);
                    echo $app->response()->getStatus();
                return json_encode($app->response()->header('success',200));
               }
        }
    );

$app->run();