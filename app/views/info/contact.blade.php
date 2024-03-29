@extends('layouts.master')

@section('content')
<div class="container">
  <h1>Contact Us</h1>

  <h4>Get in touch with us on our {{ link_to('https://www.facebook.com/groups/117590764955050/', 'Facebook', array('target'=>'_blank')) }} page</h4>

  <div class="panel panel-default panel-settings">
    <div class="panel-heading"><h4>Club Committee Members</h4></div>
      <div class="list-group">

        <div class="list-group-item">
          <h4 class="list-group-item-heading">Chairman / Webmaster</h4>
          <p class="list-group-item-text">Andrew Bird</p>
        </div>

        <div class="list-group-item">
          <h4 class="list-group-item-heading">Vice Chairman</h4>
          <p class="list-group-item-text">Trevor Stanley</p>
        </div>

        <div class="list-group-item">
          <h4 class="list-group-item-heading">Treasurer / Club BRCA Rep</h4>
          <p class="list-group-item-text">Alan Meredith</p>
        </div>

        <div class="list-group-item">
          <h4 class="list-group-item-heading">Secretary</h4>
          <p class="list-group-item-text">Sarah Meredith</p>
        </div>

        <div class="list-group-item">
          <h4 class="list-group-item-heading">Committee Members</h4>
          <p class="list-group-item-text">Ade Malkin</p>
        </div>

    </div>

  </div>

</div>

@stop
