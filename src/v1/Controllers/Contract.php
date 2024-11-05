<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Contract extends Common
{
  protected $model = '\App\Models\Contract';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Contract();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Contract();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Contract();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
