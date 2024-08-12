<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            text-align: center;

            font-size: 25px;
            font-weight: bold;

        }

        .input_color {
            color: black;
        }

        .th_color {
            background: skyblue;
        }

        .center {
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
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
                <h1 class="h2_font">All Orders</h1>

                <div style="padding-left: 400px; padding-top:30px;">
<form action="{{ url('search') }}" method="get">
@csrf
<input style="color: black;" type="text" name="search" placeholder="search">
<input type="submit" value="search" class="btn btn-primary">
</form>
                </div>

                <table class="center">
                    <tr class="th_color">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>phone</th>
                        <th>product title</th>
                        <th>quantity</th>
                        <th>price</th>
                        <th>payment status</th>
                        <th>Delivary status</th>
                        <th>image</th>
                        <th>Deliverd</th>
                        <th>print pdf</th>
                        <th>send email</th>

                    </tr>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivery_status }}</td>
                            <td><img height="100" width="100" src="product/{{ $order->image }}" alt=""></td>
                            <td>
                            @if ($order->delivery_status=='processing')
                                <a href="{{ url('delivered', $order->id) }}"
                                onclick=" return confirm('Are you sure to delivered this product')"
                                        class="btn btn-primary">Delivered</a>
                            @else
                                <p style="color: green;">deliverd</p>
                            @endif
                        </td>

                        <td>
                        <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">print pdf</a>
                        </td>

                        <td>
                        <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">send email</a>
                        </td>


                        </tr>
@empty
                        <tr>
                        <td colspan="16">No data found</td>
                        </tr>

                    @endforelse
                </table>


            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
