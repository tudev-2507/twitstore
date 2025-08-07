<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Web Bán Hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css?v=<?= time() ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header class="promo-header text-white py-4 shadow" style="background-color: #343a40;">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3 m-0 d-flex align-items-center">
                <a href="index.php" class="d-flex align-items-center text-white text-decoration-none fw-bold" style="font-size: 1.8rem;">
                    <img src="public/images/logo.svg" alt="Logo" style="height: 40px; margin-right: 10px;">
                    Twit Store
                </a>
            </h1>
            <div class="d-none d-md-block">
                <span class="fw-light">Nơi mua sắm thú vị mỗi ngày <i class='bx bx-florist'></i></span>
            </div>
        </div>
    </header>


    <?php include_once 'views/layouts/nav.php'; ?>

    <main class="container my-4">