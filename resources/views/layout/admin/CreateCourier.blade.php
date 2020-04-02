@extends('components.admin.app_dash')
@section('title')
   Tambah Courier
@endsection
@section('nav-courier')
    active
@endsection
@section('content'))
<form action="/tambahcourier"method="POST">
	{{ csrf_field() }}
	<p>
		<label for="Courier">Courier</label>
		<input type="text" name="courier" >
	</p>
	<p>
		<input type="submit" value="Simpan">
		<input type="button" value="Kembali" onclick="location.href="/courier"">
	</p>
</form>
@endsection
