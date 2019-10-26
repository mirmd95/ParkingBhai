@extends('layouts.driverApp')
@section('title','About')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header"><h2><p style="text-align: center;">{{ __('ABOUT') }}</p></h2></div>
                <div class="table-responsive">
                    <div class="card-group">
                      <div class="card">
                        <img src="image/imran.jpg" class="card-img-top" alt="..." height="300px" >
                        <div class="card-body">
                          <h5 class="card-title">Mir Md Imran Hasan</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. </p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Lead Developer</small>
                        </div>
                      </div>

                      <div class="card">
                        <img src="image/xahin.png" class="card-img-top" alt="..." height="300px" >
                        <div class="card-body">
                          <h5 class="card-title">Jannatun Nayeem</h5>
                          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Analist && Designer</small>
                        </div>
                      </div>
                      <div class="card">
                        <img src="image/sajjad" class="card-img-top" alt="..." height="300px" >
                        <div class="card-body">
                          <h5 class="card-title">Md Sajjad Hossin</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Designer</small>
                        </div>
                      </div>
                      
                    </div>

                </div>
                    
            </div>
          </div>
       </div>
      
</div>
@endsection

