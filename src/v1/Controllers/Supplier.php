<?php

namespace App\v1\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

final class Supplier extends Common
{
  protected $model = '\App\Models\Supplier';
  protected $rootUrl2 = '/suppliers/';

  public function getAll(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Supplier();
    return $this->commonGetAll($request, $response, $args, $item);
  }

  public function showItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Supplier();
    return $this->commonShowItem($request, $response, $args, $item);
  }

  public function updateItem(Request $request, Response $response, $args): Response
  {
    $item = new \App\Models\Supplier();
    return $this->commonUpdateItem($request, $response, $args, $item);
  }

  public function showSubContracts(Request $request, Response $response, $args): Response
  {
    global $translator;

    $item = new $this->model();
    $definitions = $item->getDefinitions();
    $view = Twig::fromRequest($request);

    $myItem = $item->find($args['id']);

    $rootUrl = $this->getUrlWithoutQuery($request);
    $rootUrl = rtrim($rootUrl, '/contracts');
    $rootUrl2 = '';
    if ($this->rootUrl2 != '') {
      $rootUrl2 = rtrim($rootUrl, $this->rootUrl2 . $args['id']);
    }

    $item2 = new \App\Models\Contract();
    $myItem2 = $item2::with('suppliers')->orderBy('name', 'asc')->get();

    $myContracts = [];
    foreach ($myItem2 as $contract)
    {
      $is_supplier_contract = false;
      if ($contract->suppliers != null)
      {
        foreach ($contract->suppliers as $supplier) {
          if ($supplier->id == $args['id']) {
            $is_supplier_contract = true;
            break;
          }
        }
      }

      if ($is_supplier_contract == true) {
        $url = '';
        if ($rootUrl2 != '') {
          $url = $rootUrl2 . "/contracts/" . $contract->id;
        }

        $entity = '';
        if ($contract->entity != null)
        {
          $entity = $contract->entity->name;
        }

        $type = '';
        if ($contract->type != null)
        {
          $type = $contract->type->name;
        }


        $duration = $contract->duration;
        if ($duration == 0)
        {
          $initial_contract_period = sprintf($translator->translatePlural('%d month', '%d months', 1), $duration);
        }
        if ($duration != 0)
        {
          $initial_contract_period = sprintf(
            $translator->translatePlural(
              '%d month',
              '%d months',
              $duration
            ),
            $duration
          );
        }

        if ($contract->begin_date != null) {
          $ladate = $contract->begin_date;
          if ($duration != 0)
          {
            $end_date = date('Y-m-d', strtotime('+' . $duration . ' month', strtotime($ladate)));
            if ($end_date < date('Y-m-d')) {
              $end_date = "<span style=\"color: red;\">" . $end_date . "</span>";
            }
            $initial_contract_period = $initial_contract_period . ' => ' . $end_date;
          }
        }

        $myContracts[$contract->id] = [
          'name'                      => $contract->name,
          'url'                       => $url,
          'entity'                    => $entity,
          'number'                    => $contract->num,
          'type'                      => $type,
          'start_date'                => $contract->begin_date,
          'initial_contract_period'   => $initial_contract_period,
        ];
      }
    }


    $viewData = new \App\v1\Controllers\Datastructures\Viewdata($myItem, $request);
    $viewData->addRelatedPages($item->getRelatedPages($rootUrl));

    $viewData->addData('fields', $item->getFormData($myItem));
    $viewData->addData('contracts', $myContracts);
    $viewData->addData('show_suppliers', false);

    $viewData->addTranslation('name', $translator->translate('Name'));
    $viewData->addTranslation('entity', $translator->translatePlural('Entity', 'Entities', 1));
    $viewData->addTranslation('number', $translator->translate('phone' . "\004" . 'Number'));
    $viewData->addTranslation('type', $translator->translatePlural('Contract type', 'Contract types', 1));
    $viewData->addTranslation('supplier', $translator->translatePlural('Supplier', 'Suppliers', 1));
    $viewData->addTranslation('start_date', $translator->translate('Start date'));
    $viewData->addTranslation('initial_contract_period', $translator->translate('Initial contract period'));

    return $view->render($response, 'subitem/suppliercontracts.html.twig', (array)$viewData);
  }

  public function showSubContacts(Request $request, Response $response, $args): Response
  {
    global $translator;

    $item = new $this->model();
    $definitions = $item->getDefinitions();
    $view = Twig::fromRequest($request);

    $myItem = $item->find($args['id']);

    $rootUrl = $this->getUrlWithoutQuery($request);
    $rootUrl = rtrim($rootUrl, '/contacts');
    $rootUrl2 = '';
    if ($this->rootUrl2 != '') {
      $rootUrl2 = rtrim($rootUrl, $this->rootUrl2 . $args['id']);
    }

    $item2 = new \App\Models\Contact();
    $myItem2 = $item2::with('suppliers')->orderBy('name', 'asc')->get();

    $myContacts = [];
    foreach ($myItem2 as $contact)
    {
      $is_supplier_contact = false;
      if ($contact->suppliers != null)
      {
        foreach ($contact->suppliers as $supplier) {
          if ($supplier->id == $args['id']) {
            $is_supplier_contact = true;
            break;
          }
        }
      }

      if ($is_supplier_contact == true) {
        $url = '';
        if ($rootUrl2 != '') {
          $url = $rootUrl2 . "/contacts/" . $contact->id;
        }

        $entity = '';
        if ($contact->entity != null)
        {
          $entity = $contact->entity->name;
        }

        $type = '';
        if ($contact->type != null)
        {
          $type = $contact->type->name;
        }

        $myContacts[$contact->id] = [
          'name'        => $contact->name . ' ' . $contact->firstname,
          'url'         => $url,
          'entity'      => $entity,
          'phone'       => $contact->phone,
          'phone2'      => $contact->phone2,
          'mobile'      => $contact->mobile,
          'fax'         => $contact->fax,
          'email'       => $contact->email,
          'type'        => $type,
        ];
      }
    }


    $viewData = new \App\v1\Controllers\Datastructures\Viewdata($myItem, $request);
    $viewData->addRelatedPages($item->getRelatedPages($rootUrl));

    $viewData->addData('fields', $item->getFormData($myItem));
    $viewData->addData('contacts', $myContacts);

    $viewData->addTranslation('name', $translator->translate('Name'));
    $viewData->addTranslation('entity', $translator->translatePlural('Entity', 'Entities', 1));
    $viewData->addTranslation('phone', $translator->translatePlural('Phone', 'Phones', 1));
    $viewData->addTranslation('phone2', $translator->translate('Phone 2'));
    $viewData->addTranslation('mobile', $translator->translate('Mobile phone'));
    $viewData->addTranslation('fax', $translator->translate('Fax'));
    $viewData->addTranslation('email', $translator->translatePlural('Email', 'Emails', 1));
    $viewData->addTranslation('type', $translator->translatePlural('Type', 'Types', 1));

    return $view->render($response, 'subitem/suppliercontacts.html.twig', (array)$viewData);
  }
}
