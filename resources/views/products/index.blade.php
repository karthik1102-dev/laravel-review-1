@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <div class="card"> -->
                <div class="card-header">{{ __('Products') }}</div>

                    
                    <div class="float-end"><a href="{{route('createProduct')}}">Add product</a></div>
                    <button id="listButton">ajax table render</button>

                    <!-- Add product Modal popup -->

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add product modal </button>


                    <div class="modal fade" id="exampleModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="productForm" name="productForm" class="form-horizontal">
                                    <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Product</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="product" name="product" placeholder="Enter Product" value="" required>
                                            </div>
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Price</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Date</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="datepicker" name="date" placeholder="Enter date" value="" required>
                                            </div>
                                        </div>
                        
                                        <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="savedata" value="create">Save Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="productsData">
                            @foreach($products as $key => $product)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$product->product}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->date}}</td>
                                <td><div><a href="{{route('editProduct',$product->id)}}">Edit</a></div></td>
                                <!-- <td><div><a href="{{ url('edit-product/' . $product->id) }}">Edit url</a></div></td> -->
                                <td><div>
                                        <form method="post" action="{{route('deleteProduct',$product->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#listButton").click(function(e){
        $.ajax({

        url: '/product2',
        type: "GET",
        dataType: "json",

        success:function(data) {
            var markup = '';
            $.each(data.success, function(key, value) {
                markup += '<tr> <td>' + value.id + '</td> <td>' + value.product + '</td> <td>' + value.price+ ' '  + value.date + '</td> <tr>';
            });
            $('tbody[id="productsData"]').html(markup);

        }

        });
    });

    // display a modal (medium modal)
    $(document).on('click', '#savedata', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log("document.location.origin : "+document.location.origin);

            $.ajax({
                data: $('#productForm').serialize(),
                url: document.location.origin+"/store-product",
                type: "POST",
                dataType: 'json',
                // return the result
                success: function(result) {
                    alert('added product')
                    $('#exampleModal').modal('hide');
                    location.reload();

                },
              
            })
        });

        $(document).on('click', '.editProduct', function(event) {
            event.preventDefault();

            $.ajax({
                data: ,
                url: document.location.origin+"/editProductajax/",
                type: "POST",
                dataType: 'json',
                // return the result
                success: function(result) {

                },
              
            })
        });

        $('#datepicker').datepicker({    
        format: "dd-mm-yyyy" 
     }); 
    </script>
    @endsection
