
@extends('layout.home')
@section('title','Dashboard')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@section('content')

<main id="main" class="main">

<div class="pagetitle">
<h1>Dashboard</h1>
<nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
    <div class="card"> 
        <div class="card-body "> 
            <div class="row">
               
            </div>
        </div>
    </div>
    
</section>

</main><!-- End #main -->

<script type="text/javascript">

    $(document).ready(function () {
      
      
    });
      
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
@endsection

@section('pagespecificscripts')
   
@stop