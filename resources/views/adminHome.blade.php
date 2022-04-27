<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link type="text/css" rel="stylesheet" href="{{ asset('assets/adminCss/adminCss.css') }}"/>
</head>

<body>
<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
          >
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
          </a>
          <a href="{{ route('adminHome')}}" class="list-group-item list-group-item-action py-2 ripple active">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Product</span>
          </a>
          <a href="{{ route('products')}}" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Product List</span>
          </a>

          <a href="{{ route('logout')}}" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>logout</span></a
          >
         
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
  </header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main style="margin-top: 58px;">
    <div class="container pt-4">
        <h4>Add Product</h4>
        <div class="row">
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

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('addProduct')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="email">Name</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                          <label for="pwd">Price</label>
                          <input type="number" class="form-control" id="price" name="price">
                        </div>
                       
                        <div class="form-group">
                            <label for="pwd">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                           
                          </div>

                          <div class="form-group">
                            <label for="pwd">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                           
                          </div>
                          <br>
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
  </main>
  <!--Main layout-->
</body>
</html>