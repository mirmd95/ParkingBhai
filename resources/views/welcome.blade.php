@extends('layouts.app')
@section('title','Home')
@section('content')
  <div class="container ">
    <div class="row">
      <div class="col-md-8">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 h-70" src="image/slide1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="image/slide2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="image/slide3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <div class="welcometext">
            <h1>WELCOME</h1>
                  to
            <h2>Parking-By</h2>
            <p>The purpose of this System is to help the vehicle owner & the space owner by sharing their helping etchics.If your space is free then you can share it by giving it in rent & earn money.If you are in emergency and in a unknown place,don't know where to park your vehicle.Then this modern solution is for you. </p>  
          </div>
          <div>
            <h4><b>Services</b></h4>
          </div>

          <div class="card-group">
            <div class="card">
              <img src="image/service.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Available Spaces</h5>
                <p class="card-text">There are numbers of available spaces for you.So,if are in a hurry then,you don't have to worry for searching free spaces. </p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ranked 1</small>
              </div>
            </div>
            <div class="card">
              <img src="image/secuirity.jpg"  class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Security</h5>
                <p class="card-text">The process is fully dealed with space owner.So there is no compromise with the security of your vehicle.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ranked 2</small>
              </div>
            </div>
            <div class="card">
              <img src="image/automated.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Easy online solution</h5>
                <p class="card-text">Here,you will get a automated cost calculation,searching suggestions,various types of availability for you vehicle etc. in one place.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ranked 3rd</small>
              </div>
            </div>
          </div>
      </div>

        <div class="col-md-3">
        <div class="foods">
          <h1>Spaces In..</h1>
          <img src="image/mirpur.png" height="150px" width="200px">
          <h5>Area: Mirpur(43)</h5>
          

          <img src="image/uttara.jpg" height="150px" width="200px">
          <h5>Area: Uttara(27) </h5>
          

          <img src="image/dhanmondi.jpg" height="150px" width="200px">
          <h5>Area : Dhanmondi(34)</h5>

          <img src="image/motijhil.png" height="150px" width="200px">
          <h5>Area : Motizhil(23)</h5>
          <button type="button" class="btn btn-warning"><a href="#"><h4>More Review</h4></a></button>

        </div>
      </div>
    </div>
  </div>
     

@endsection

