<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Event extends Common
{
  protected $model = '\App\Models\Event';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Event();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Event();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Event();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
