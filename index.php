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
                    <img src="assets/images/edevlet.png" class="me-2" width="42" height="32" alt="E Devlet Logo">
                    <h1 class="mb-0 fs-4 fw-semibold">Turkish Identity Number Validator</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <label for="tc" class="input-group-text">Identity Number</label>
                            <input type="text" name="tc" id="tc" class="form-control" maxlength="11" required>
                        </div>
                        <div class="input-group mb-3 justify-content-center">
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                    <div class="alert-message">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-check-circle-fill" viewBox="0 0 16 16" aria-label="Success:">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16" aria-label="Danger:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            <div class="text"></div>
                        </div>
                    </div>
                    <div class="description">
                        <ul class="ps-3 mb-0">
                            <li>TR Identity Number consists of numbers only. It does not contain any letters or
                                special characters.
                            </li>
                            <li>TR ID Number consists of 11 digits.</li>
                            <li>The first digit of the TR Identity Number cannot be 0.</li>
                            <li>The first relationship between the steps is;
                                <ul>
                                    <li>The numbers in the 1st, 3rd, 5th and 7th digits of this number are added and
                                        multiplied by 7.
                                    </li>
                                    <li>The sum of the values in steps 2, 4, 6 and 8 is subtracted from the value we
                                        obtained.
                                    </li>
                                    <li>The number obtained in the last operation is divided by 10.</li>
                                    <li>The remainder we obtain in the division process gives the 11th digit of the
                                        TR Identity Number.
                                    </li>
                                </ul>
                            </li>
                            <li>The second relationship between the steps is;
                                <ul>
                                    <li>The first ten digits of this number, i.e. 1-10. All digits in the digits are
                                        added together.
                                    </li>
                                    <li>The resulting number is divided by 10.</li>
                                    <li>The remainder obtained from the division process will give the 11th digit of
                                        the TR Identity Number.
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
    });
</script>
</body>
</html>