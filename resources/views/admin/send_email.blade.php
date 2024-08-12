<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">

    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        label {
            display: inline-block;
            width: 300px;
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

                <h1 class="h2_font">send email to {{ $order->email }}</h1>

                <form action="{{ route('send_user_email',$order->id) }}" method="POST">
                @csrf

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email Greeting :</label>
                        <input type="text" name="greeting">
                    </div>

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email FirstLine :</label>
                        <input type="text" name="firstline">
                    </div>

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email body :</label>
                        <input type="text" name="body">
                    </div>

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email button name :</label>
                        <input type="text" name="button">
                    </div>

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email Url :</label>
                        <input type="text" name="url">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label for="">Email LastLine :</label>
                        <input type="text" name="lastline">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <input type="submit" value="send email" class="btn btn-primary">
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
