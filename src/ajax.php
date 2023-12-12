<?php
require 'TCKimlik.php';

if (!empty($_POST['verifyTC'])) {
    $response = ['status' => false];
    try {
        $tc = new TCKimlik();
        $tc->setNumber(isset($_POST['tc']) ? $_POST['tc'] : '');
        if ($tc->verify()) {
            $response['status'] = true;
            $response['message'] = 'T.C. Identity Number is valid.';
        } else {
            $response['message'] = 'T.C. Identity Number is not valid.';
        }
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    return true;
}