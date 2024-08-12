<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style type="text/css">
        .center {
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        .th_deg {
            padding: 10px;
            background-color: skyblue;
            font-size: 20px;
        }
        .h2_font {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;

        }

    </style>
</head>

<body>

    <!-- header section strats -->
    @include('home.header')


    <div class="center">
        <h2 class="h2_font">Order Details</h2>

        <table>

            <tr>
                <th class="th_deg">product title</th>
                <th class="th_deg">quantity</th>
                <th class="th_deg">price</th>
                <th class="th_deg">payment status</th>
                <th class="th_deg">dilevry status</th>
                <th class="th_deg">image</th>
                <th class="th_deg">Action</th>
            </tr>
            @foreach ($orders as $order)
                <tr>

                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <img src="product/{{ $order->image }}" width="100" height="100">

                    </td>
                        <td>
                    @if ($order->delivery_status == 'processing')

                        <a href="{{ url('cancel_order', $order->id) }}"
                                onclick="return confirm('Are you sure to cancel this order')"
                                class="btn btn-danger">cancel order</a>

                                @else
                                <p style="color: green;">Delivered</p>
                    @endif
                </td>
                </tr>
            @endforeach

        </table>

    </div>



    <!-- why section -->

    <!-- footer end -->

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
