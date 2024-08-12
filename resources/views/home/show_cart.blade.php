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
        .total_deg{
            text-align: center;

        font-size: 20px;
        padding: 40px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        {{-- @include('admin.sidebar') --}}
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        @if (session('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->get('message') }}

        </div>
    @endif
        <div class="content-wrapper">

            <table class="center">

                <h2 class="h2_font">Cart</h2>
                <tr class="th_color">
                    <td class="th_deg">product title</td>
                    <td class="th_deg">quantity</td>
                    <td class="th_deg">price</td>
                    <td class="th_deg">image</td>
                    <td colspan="1" class="th_deg">Action</td>
                </tr>
                <?php $totalprice = 0; ?>
                @foreach ($carts as $cart)
                    <tr>
                        <td>${{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->price }}</td>
                        <td>

                            <img src="product/{{ $cart->image }}" width="100" height="100">

                        </td>
                        <td><a href="{{ url('remove_cart', $cart->id) }}"
                                onclick="return confirm('Are you sure to delete this product')"
                                class="btn btn-danger">REmove</a></td>

                    </tr>
                    <?php $totalprice = $totalprice + $cart->price; ?>
                @endforeach
            </table>

            <div>
            <h1 class="total_deg">Total price : ${{ $totalprice }}</h1>
            </div>
            <div style="text-align: center">
                <h1 style="font-size: 30px; padding-bottom: 15px">proceed to order</h1>

                <a href="{{ url('cash_order') }}" class="btn btn-danger">cash on delivery</a>
                <a href="{{ url('stripe', $totalprice) }}" class="btn btn-danger">pay using card</a>
            </div>


        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
