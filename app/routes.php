<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use GuzzleHttp\Client;
use GuzzleHttp\EntityBody;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->get('/', function (Request $request, Response $response) {
        $client = new Client();
        $res = $client->get(
            'https://api.themoviedb.org/3/movie/550?api_key=ddec886742429cd922ebad0010e96c2d'
        );

        if ($res->getStatusCode() == 200) {
            $reqData = $res->getBody();
            $movie = [];

            $movie[] = $reqData->getContents();
            foreach ($movie as $data) {
                $response->getBody()->write($data);
            }
            return $response;
        }
    });
};
