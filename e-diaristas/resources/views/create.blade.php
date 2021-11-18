@extends('app')
@section('titulo', 'Criar diarista')
@section('conteudo')
<h1>Criar diasrista</h1>
<form action="{{ route('diaristas.store') }}" method="POST" enctype="multipart/form-data" >
  
  @include('_form')      

</form>
@endsection
    


