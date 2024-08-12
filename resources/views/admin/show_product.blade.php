<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

        .h2_font {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;

        }

        .th_color {
            background: skyblue;
        }

        .th_deg {
            padding: 30px;
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

                <table class="center">

                    @if (session('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('message') }}

                        </div>
                    @endif

                    <h2 class="h2_font">All Products</h2>
                    <tr class="th_color">
                        <td class="th_deg">product title</td>
                        <td class="th_deg">description</td>
                        <td class="th_deg">category</td>
                        <td class="th_deg">quantity</td>
                        <td class="th_deg">price</td>
                        <td class="th_deg">Discount price</td>
                        <td class="th_deg">image</td>
                        <td colspan="2" class="th_deg">Action</td>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>${{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>

                                <img src="product/{{ $product->image }}" width="100" height="100">

                            </td>
                            <td><a href="{{ url('update_product', $product->id) }}"
                                    class="btn btn-success mr-2">Edit</a></td>
                            <td><a href="{{ url('delete_product', $product->id) }}"
                                    onclick="return confirm('Are you sure to delete this product')"
                                    class="btn btn-danger">Delete</a></td>

                        </tr>
                    @endforeach

                </table>


            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
