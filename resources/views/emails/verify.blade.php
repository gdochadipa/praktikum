<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Verifikasi Pendaftaran Anda</title>
</head>
<body>
    <h2>Hai, {{ $user->name }}</h2>
    <p>Terima kasih telah melakukan transaksi pada aplikasi kami</p>
<p>Jangan lupa untuk melakukan verifikasi pendaftaran  <a href="{{route('user.verify',['token'=>$password])}}">Disini</a></p>
{{-- <form action="{{route('user.verify')}}" method="post">
        <input type="text" name="email" value="{{$user->email}}" hidden>
        <input type="password" name="password" value="{{$user->password}}" value="" hidden>
        <input type="submit" name="submit" value="Verifikasi pendaftaran">
    </form> --}}
</body>
</html>