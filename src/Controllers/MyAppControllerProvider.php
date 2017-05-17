<?php
namespace Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class MyAppControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return 'MyApp';
        });

        $controllers->get('/xxx', function (Application $app) {
            return 'MyAppxxx';
        });

        $controllers->get('/xxx/{id}', function (Application $app, $id) {

            return 'MyAppxxx : j\'ai tapé id : ' . $id;
        });

        $controllers->get('/bof', function (Application $app) {
            $bof = $app['bof'];
            return 'MyApp-bof : ' . $bof->query();
        });


        $controllers->get('/form', function(Application $app) {
            return $app['twig']->render('form.html.twig', array('form' => 'forms/test.html.twig'));
        });

        $controllers->post('/form', function (Request $request) {
                dump($request); die;


        });

        return $controllers;
    }
}
