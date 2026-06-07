<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Portal Kesehatan</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="https://media.istockphoto.com/id/1208604845/id/vektor/gaya-hidup-sehat-dan-konsep-perawatan-diri.jpg?s=1024x1024&w=is&k=20&c=uqgM69lCrX5BEWSEDGN7zHEaoJPBOQVZ6NjHhHUKyoM="
                    class="img-fluid mb-3">
                <h3>Aplikasi Portal Kesehatan</h3>
                <div class="mt-4">
                    <a href="{{ route('menu') }}" class="btn btn-primary btn-lg mr-2 shadow-sm">Start Konsultasi</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-success btn-lg shadow-sm">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>