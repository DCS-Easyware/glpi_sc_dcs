<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteContext;

final class Problem extends Common
{
  protected $model = '\App\Models\Problem';
  protected $rootUrl2 = '/problems/';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Problem();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Problem();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Problem();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
