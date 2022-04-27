<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link type="text/css" rel="stylesheet" href="{{ asset('assets/adminCss/adminCss.css') }}"/>

<link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
          <a href="{{ route('adminHome')}}" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Product</span>
          </a>

          <a href="{{ route('products')}}" class="list-group-item list-group-item-action py-2 ripple active">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Product List</span>
          </a>
          <a href="{{ route('logout')}}" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>logout</span></a
          >
         
        </div>
      </div>
    </nav>
   
  </header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main style="margin-top: 58px;">
    <div class="container pt-4">
        <h4> Product List</h4>
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
                   
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr class="table-tr">
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th style="width: 10% !important;">Image</th>
                                    <th>Created AT</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $product->prod_name }} </td>
                                        <td>{{ $product->price }} </td>
                                        <td>{{ $product->discription }}</td>
                                        <td> <img src="{{asset('/Images').'/'.$product->image}}" alt="" width="80%" height="80%"></td>
                                        <td>{{ $product->created_at }}</td>
                                        
                                        <td>
                                            <a href="#editProduct{{ $product->id }}" data-bs-toggle="modal"
                                                data-bs-target="#editProduct{{ $product->id }}"><button class="btn btn-xs btn-success">Edit</button></a>
                                        <a href="#deleteProduct{{ $product->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteProduct{{ $product->id }}"> <button class="btn btn-xs btn-danger">Delete</button></a>
                                            
                                        </td>
                                    </tr>
        
                                    <!-- The Modal -->
                                    <div class="modal" id="editProduct{{ $product->id }}">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit User</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" action="{{route('editProduct')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="prodId" value="{{ $product->id }}" hidden>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Product Name</label>
                                                        </div>
                                                        <div class="col-md-9 form-group">
                                                            <input type="text" id="first-name" class="form-control" name="prodName"
                                                               value="{{ $product->prod_name }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Price</label>
                                                        </div>
                                                        <div class="col-md-9 form-group">
                                                            <input type="text" id="email-id" class="form-control" name="price"
                                                            value="{{ $product->price }}">
                                                        </div>
        
                                                        <div class="col-md-3">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col-md-9 form-group">
                                                            <input type="text" id="email-id" class="form-control" name="discription"
                                                            value="{{ $product->discription }}">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label>Upload File</label>
                                                        </div>
                                                        <div class="col-md-9 form-group">
                                                        <input type="file" class="form-control" id="image" name="image"  value="{{ $product->image }}">
                                                        </div>
                                                        </div>
        
                                                    </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
        
        
                                    <div class="modal" id="deleteProduct{{ $product->id }}">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete User</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" action="{{route('deleteProduct')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="prodId" value="{{ $product->id }}" hidden>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete {{ $product->prod_name }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Delete</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
        
                            </tbody>
                        </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
  </main>
  <!--Main layout-->
</body>

<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script>
        // Jquery Datatable
        let jquery_datatable = $("#table1").DataTable()
        
    </script>

</html>