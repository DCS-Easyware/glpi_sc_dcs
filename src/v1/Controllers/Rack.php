<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteContext;

final class Rack extends Common
{
  protected $model = '\App\Models\Rack';
  protected $rootUrl2 = '/racks/';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Rack();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Rack();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Rack();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
