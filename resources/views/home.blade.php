@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <router-link to="/cars" class="nav-link active">Cars</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manufacturers" class="nav-link">Manufacturers</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/types" class="nav-link">Types</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/colors" class="nav-link">Colors</router-link>
              </li>
            </ul>
        </div>

        <div class="col-md-8">
            <router-view></router-view>
            <!-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
