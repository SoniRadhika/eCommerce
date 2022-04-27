@extends('Layout.head')


@section('content')
    <div class="section">
        <div class="container">
            <!-- row -->

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
          @endif

          @if(session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
          @endif


            <div class="row">
                <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('dologin') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Login</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="input" type="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="primary-btn order-submit">Log in</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('doregister') }}" enctype="multipart/form-data">
                                @csrf  
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Register</h3>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="userName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="number" placeholder="phone Number">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="password" name="confirmPassword" placeholder="Confirm Password">
                                </div>
                                <button type="submit" class="primary-btn order-submit">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
