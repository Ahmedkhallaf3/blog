<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;

        }

        .input_color {
            color: black;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
            }

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }
        label{
            display: inline-block;
            width: 200px;
        }

        .div_design {
        padding-bottom: 15px;

        }


    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @if (session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session()->get('message') }}

                </div>
            @endif

                <div class="div_design">
                    <h1 class="font_size">Add Product</h1>
                </div>
                <form action="{{ url('add_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_design">
                    <label for="">Product title :</label>
                    <input type="text" class="input_color" name="title" placeholder="Write a title" required="">
                </div>
                <div class="div_design">
                    <label for="">Product Description :</label>
                    <input type="text" class="input_color" name="description" placeholder="Write a description" required="">
                </div>
                <div class="div_design">
                    <label for="">Product price :</label>
                    <input type="number" class="input_color" name="price" placeholder="Write a price" required="">
                </div>
                <div class="div_design">
                    <label for="">Product discount_price :</label>
                    <input type="number" class="input_color" name="discount_price" min="0" placeholder="Write a discount_price">
                </div>
                <div class="div_design">
                    <label for="">Product quantity :</label>
                    <input type="number" class="input_color" name="quantity" placeholder="Write a quantity" required="">
                </div>
                <div class="div_design">
                    <label>Product category :</label>
                    <select class="text_color" name="category" required="">
                    <option value="" selected="">Add category here</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="div_design">
                    <label for="">Product image :</label>
                    <input type="file" name="image" required="">
                </div>
                <div class="div_design">
                    <input type="submit" class="btn btn-primary" value="Add Product">
                </div>
            </form>

            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
