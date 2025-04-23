<?php
require_once 'EventManager.php';

$eventManager = new EventManager();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode($eventManager->getAllEvents());
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['success' => $eventManager->addEvent($data)]);
}

if ($method === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars['id'];
    unset($put_vars['id']);
    echo json_encode(['success' => $eventManager->updateEvent($id, $put_vars)]);
}

if ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"), $del_vars);
    echo json_encode(['success' => $eventManager->deleteEvent($del_vars['id'])]);
}
