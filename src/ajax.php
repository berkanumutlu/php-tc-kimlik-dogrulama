<?php
require 'TCKimlik.php';

if (!empty($_POST['verifyTC'])) {
    $response = ['status' => false];
    try {
        $tc = new TCKimlik();
        if (isset($_POST['verifyType'])) {
            $tc->setVerifyType(mb_strtolower($_POST['verifyType']));
        }
        if (isset($_POST['tc'])) {
            $tc->setNumber($_POST['tc']);
        }
        if (isset($_POST['name'])) {
            $tc->setName(htmlspecialchars(trim($_POST['name'])));
        }
        if (isset($_POST['surname'])) {
            $tc->setSurname(htmlspecialchars(trim($_POST['surname'])));
        }
        if (isset($_POST['birthYear'])) {
            $tc->setBirthYear(filter_var($_POST['birthYear'], FILTER_VALIDATE_INT));
        }
        $verify = $tc->verify();
        if (is_bool($verify)) {
            if ($verify) {
                $response['status'] = true;
                $response['message'] = 'Turkish Identity Number is valid.';
            } else {
                $response['message'] = 'Turkish Identity Number is not valid.';
            }
        } else {
            $response = $verify;
        }
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    return true;
}