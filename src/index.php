<?php
require 'config/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turkish Identity Number Validator</title>
    <meta name="description" content="PHP Turkish Identity Number Validator">
    <meta name="keywords" content="turkish identity number validator">
    <meta name="author" content="Berkan Ümütlü">
    <meta name="copyright" content="Berkan Ümütlü">
    <meta name="owner" content="Berkan Ümütlü">
    <meta name="url" content="http://github.com/berkanumutlu">
    <link rel="stylesheet" href="assets/plugins/bootstrap-5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card my-5">
                <div class="card-header d-flex align-items-center">
                    <img src="assets/images/edevlet.png" class="me-2" width="42" height="32" alt="E-Devlet Logo">
                    <h1 class="mb-0 fs-4 fw-semibold">Turkish Identity Number Validator</h1>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs justify-content-center mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-algorithm-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-algorithm" type="button" role="tab"
                                    aria-controls="pills-algorithm"
                                    aria-selected="true">Algorithm
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-curl-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-curl" type="button" role="tab"
                                    aria-controls="pills-curl" aria-selected="false">cURL
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-algorithm" role="tabpanel"
                             aria-labelledby="pills-algorithm-tab" tabindex="0">
                            <form action="ajax.php" method="POST" class="algorithmForm input-group-form">
                                <input type="hidden" name="verifyType" value="algorithm">
                                <?php include 'components/_input_identity_number.html'; ?>
                                <?php include 'components/_button_form_submit.html'; ?>
                            </form>
                            <?php include 'components/_alert.html'; ?>
                            <div class="description">
                                <ol class="list-group list-group-numbered list-group-flush">
                                    <li class="list-group-item">Turkish Identity Number consists of numbers only. It
                                        does not contain any letters or special characters.
                                    </li>
                                    <li class="list-group-item">Turkish Identity Number consists of 11 digits.</li>
                                    <li class="list-group-item">The first digit of the Turkish Identity Number cannot be
                                        0 (zero).
                                    </li>
                                    <li class="list-group-item">The first relationship between the steps is;
                                        <ul>
                                            <li>The numbers in the 1st, 3rd, 5th, 7th and 9th digits of this number are
                                                added and multiplied by 7.
                                            </li>
                                            <li>The sum of the values in the 2nd, 4th, 6th and 8th digits of this number
                                                are subtracted from the value obtain.
                                            </li>
                                            <li>The number obtained in the last operation is divided by 10.</li>
                                            <li>The remainder obtained in the division process gives the 10th digit of
                                                the Turkish Identity Number.
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">The second relationship between the steps is;
                                        <ul>
                                            <li>The digits in the first ten digits of this number are added.</li>
                                            <li>The obtained number is divided by 10.</li>
                                            <li>The remainder obtained from the division process will give the 11th
                                                digit of the Turkish Identity Number.
                                            </li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-curl" role="tabpanel"
                             aria-labelledby="pills-curl-tab" tabindex="0">
                            <form action="ajax.php" method="POST" class="cURLForm input-group-form">
                                <input type="hidden" name="verifyType" value="curl">
                                <?php include 'components/_input_identity_number.html'; ?>
                                <div class="input-group mb-3">
                                    <label for="name" class="input-group-text">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="surname" class="input-group-text">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="birthYear" class="input-group-text">Year of Birth</label>
                                    <input type="number" name="birthYear" id="birthYear" class="form-control" min="1"
                                           max="9999" value="2023" required>
                                </div>
                                <?php include 'components/_button_form_submit.html'; ?>
                            </form>
                            <?php include 'components/_alert.html'; ?>
                            <div class="description">
                                <pre>
                                    <code>
                                        CONFIG<br>
                                        URL: <?= VERIFY_TYPE_CURL['URL'] ?><br>
                                        TYPE: <?= VERIFY_TYPE_CURL['REQUEST']['TYPE'] ?><br>
                                        HEADER:
                                        <?php
                                        foreach (VERIFY_TYPE_CURL['REQUEST']['HEADER'][VERIFY_TYPE_CURL['REQUEST']['TYPE']] as $item) {
                                            echo $item.'<br>';
                                        }
                                        ?>
                                    </code>
                                </pre>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    <p class="mb-0">Copyright © 2023 <a href="https://github.com/berkanumutlu" target="_blank">Berkan
                            Ümütlü</a>. All Right Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/plugins/jQuery/jquery-3.7.1.min.js"></script>
<script src="assets/plugins/bootstrap-5.3.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Input TC Identity Number
        $('input[name="tc"]').on("input", function (e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
            e.preventDefault();
        });
        // Form Submit AJAX
        $("form").submit(function (event) {
            let $form = $(this);
            let url = $form.attr('action');
            let formData = $form.serializeArray();
            formData.push({name: 'verifyTC', value: 1});
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "JSON"
            }).done(function (response) {
                let alert = $form.next('.alert-message');
                let alertStatus = alert.find('.alert');
                let alertText = alertStatus.find('.text');
                let alertIconSuccess = alertStatus.find('svg[aria-label="Success:"]');
                let alertIconDanger = alertStatus.find('svg[aria-label="Danger:"]');
                alert.hide();
                alertIconSuccess.hide();
                alertIconDanger.hide();
                alertText.text();
                if (response.hasOwnProperty('message')) {
                    alertText.text(response.message);
                }
                if (response.hasOwnProperty('status')) {
                    if (response.status) {
                        alertStatus.removeClass('alert-danger').addClass('alert-success');
                        alertIconDanger.hide();
                        alertIconSuccess.show();
                    } else {
                        alertStatus.removeClass('alert-success').addClass('alert-danger');
                        alertIconSuccess.hide();
                        alertIconDanger.show();
                    }
                    alert.show();
                }
            });
            event.preventDefault();
        });
    });
</script>
</body>
</html>