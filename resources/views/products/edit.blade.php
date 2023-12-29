<!DOCTYPE html>
<html>
<head>
    <title>Laravel project</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
</head>
<body>
    <div class="container">
    
        <h1>Edit product page</h1>
       
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif
    
        <!-- Way 1: Display All Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       
        <form method="POST" action="{{ route('updateProduct',$product->id) }}">   
            @csrf      
            <div class="mb-3">
                <label class="form-label" for="inputName">Product:</label>
                <input 
                    type="text" 
                    name="product" 
                    id="inputName"
                    class="form-control @error('product') is-invalid @enderror" 
                    placeholder="Name" value="{{$product->product??old('product')}}">
  
                <!-- Way 2: Display Error Message -->
                @error('product')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
     
            <div class="mb-3">
                <label class="form-label" for="inputPassword">price:</label>
                <input 
                    type="number" 
                    name="price" 
                    id="inputPassword"
                    class="form-control @error('price') is-invalid @enderror" 
                    placeholder="price" value="{{$product->price??old('price')}}">
  
                <!-- Way 3: Display Error Message -->
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>
       
            <div class="mb-3">
                <label class="form-label" for="datepicker">Date:</label>
                <input 
                    type="text" 
                    name="date" 
                    id="datepicker"
                    class="form-control @error('date') is-invalid @enderror" 
                    placeholder="Date" value="{{date('d-m-Y',strtotime($product->date))}}">
  
                @error('date')
                    <span class="text-danger">{{ $message }}</span>
                @endif
            </div>
     
            <div class="mb-3">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">  
    $('#datepicker').datepicker({    
        format: "dd-mm-yyyy" 
     });    
</script>  

</html>