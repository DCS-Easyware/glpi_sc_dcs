<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Fieldunicity extends Common
{
  protected $model = '\App\Models\Fieldunicity';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Fieldunicity();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Fieldunicity();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Fieldunicity();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }
}
