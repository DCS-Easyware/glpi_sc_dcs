<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteContext;

final class Projecttask extends Common
{
  protected $model = '\App\Models\Projecttask';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Projecttask();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Projecttask();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Projecttask();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
