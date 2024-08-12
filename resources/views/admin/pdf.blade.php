<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>order details</title>
</head>

<body>
    Name : <h3>{{ $order->name }}</h3>
    Email : <h3>{{ $order->email }}</h3>
    Address : <h3>{{ $order->address }}</h3>
    phone : <h3>{{ $order->phone }}</h3>
    id : <h3>{{ $order->user_id }}</h3>
    product title :<h3>{{ $order->product_title }}</h3>
    quantity : <h3>{{ $order->quantity }}</h3>
    price : <h3>{{ $order->price }}</h3>
    payment_status : <h3>{{ $order->payment_status }}</h3>
    delivery_status <h3>{{ $order->delivery_status }}</h3>
    product_id : <h3>{{ $order->product_id }}</h3>
    <br><br>
    <img src="product/{{ $order->image }}" height="250" width="450">

</body>

</html>
