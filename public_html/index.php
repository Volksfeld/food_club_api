<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';

use App\Controllers\LoginController;
use App\Controllers\ProductController;
use App\Controllers\ResponsibleController;
use App\Controllers\StaffController;
use App\Controllers\StudentController;
use Pecee\SimpleRouter\SimpleRouter;

function get($controller, $param)
{
  try {

    $response = $controller->get($param);


    http_response_code(200);
    return json_encode(array('status' => 'success', 'data' => $response));
  } catch (\Exception $e) {

    http_response_code(404);
    return json_encode(array('status' => 'error', 'data' => 'null', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
  }
}

function delete($controller, $param)
{
  try {

    $response = $controller->delete($param);


    http_response_code(200);
    return json_encode(array('status' => 'success', 'data' => $response));
  } catch (\Exception $e) {

    http_response_code(404);
    return json_encode(array('status' => 'error', 'data' => 'null', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
  }
}

function post($controller, $param)
{
  try {

    $response = $controller->post($param);

    http_response_code(200);
    return json_encode(array('status' => 'success', 'data' => $response));
  } catch (\Exception $e) {

    http_response_code(404);
    return json_encode(array('status' => 'error', 'data' => 'null', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
  }
}

SimpleRouter::post('/food_club_api/public_html/api/login', function () {
  $data = $_POST;

  if (!$_POST) {
    $data = file_get_contents('php://input');
  }

  $loginController = new LoginController();

  echo $loginController->login($data);
});

// ---------------------------------------------
// Product Routes
// ---------------------------------------------

SimpleRouter::post('/food_club_api/public_html/api/product{code?}', function ($code = null) {
  echo post(new ProductController(), $code);
});

SimpleRouter::get('/food_club_api/public_html/api/product/{code?}', function ($code = null) {
  echo get(new ProductController(), $code);
});

SimpleRouter::delete('/food_club_api/public_html/api/product/{code}', function ($code) {
  echo delete(new ProductController(), $code);
});

// ---------------------------------------------
// Responsible Routes
// ---------------------------------------------

SimpleRouter::post('/food_club_api/public_html/api/responsible{cpf?}', function ($cpf = null) {
  echo post(new ResponsibleController(), $cpf);
});

SimpleRouter::get('/food_club_api/public_html/api/responsible/{cpf?}', function ($cpf = null) {
  echo get(new ResponsibleController(), $cpf);
});

SimpleRouter::delete('/food_club_api/public_html/api/responsible/{cpf}', function ($cpf) {
  echo delete(new ResponsibleController(), $cpf);
});

SimpleRouter::post('/food_club_api/public_html/api/responsible/deposit/{studentEnrollment}/{value}', function ($studentEnrollment, $value) {
  try {
    $controller = new ResponsibleController();

    $response = $controller->deposit($studentEnrollment, $value);

    http_response_code(200);
    echo json_encode(array('status' => 'success', 'data' => $response));
  } catch (\Exception $e) {

    http_response_code(404);
    echo json_encode(array('status' => 'error', 'data' => 'null', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
  }
});

// ---------------------------------------------
// Staff Routes
// ---------------------------------------------

SimpleRouter::post('/food_club_api/public_html/api/staff/{id?}', function ($id = null) {
  echo post(new StaffController(), $id);
});

SimpleRouter::get('/food_club_api/public_html/api/staff/{id?}', function ($id = null) {
  echo get(new StaffController(), $id);
});

SimpleRouter::delete('/food_club_api/public_html/api/staff/{id}', function ($id) {
  echo delete(new StaffController(), $id);
});

// ---------------------------------------------
// Student Routes
// ---------------------------------------------

SimpleRouter::post('/food_club_api/public_html/api/student{enrollment?}', function ($enrollment = null) {
  echo post(new StudentController(), $enrollment);
});

SimpleRouter::get('/food_club_api/public_html/api/student/{enrollment?}', function ($enrollment = null) {
  echo get(new StudentController(), $enrollment);
});

SimpleRouter::delete('/food_club_api/public_html/api/student/{enrollment}', function ($enrollment) {
  echo delete(new StudentController(), $enrollment);
});

SimpleRouter::post('/food_club_api/public_html/api/student/buy/{productCode}/{studentEnrollment}', function ($productCode, $studentEnrollment) {
  try {
    $controller = new StudentController();

    $response = $controller->buyProduct($productCode, $studentEnrollment);

    http_response_code(200);
    echo json_encode(array('status' => 'success', 'data' => $response));
  } catch (\Exception $e) {

    http_response_code(404);
    echo json_encode(array('status' => 'error', 'data' => 'null', 'error' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
  }
});

SimpleRouter::start();
