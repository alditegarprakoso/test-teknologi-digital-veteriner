<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Vanding Machine !</title>
</head>

<body>
    <div class="container my-3">
        <h3 class="text-center my-4">Vending Machine</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">
                <small>{{ $message }}</small>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger mt-3">
                <small>{{ $message }}</small>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('vendingMachine.store') }}" method="POST">
                    @csrf
                    <select class="form-select mb-3" name="item">
                        @foreach($items as $item => $price)
                            <option value="{{ $item }}">{{ $item }} - Rp. {{ $price }}</option>
                        @endforeach
                    </select>
                    <input class="form-control mb-3" type="number" placeholder="Masukkan jumlah yang mau dibeli (qty)" name="qty">
                    <input class="form-control mb-3" type="number" placeholder="Masukkan jumlah coin" name="coin">
                    <p>Hanya menerima pecahan :</p>
                    @foreach($initialCoin as $coin)
                        <p>Rp. {{ $coin }} </p>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>