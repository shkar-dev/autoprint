<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('index.css') }}">
</head>
<body>
    <div class="main-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <h2>زیادکردنی وینە </h2>
        <form action="{{ route('uploadImage') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="image" class="form-control" id="upload_input" >
            <button class="btn btn-primary upload_btn" type="submit"> زیادکردن <i class="fa fa-cloud-arrow-up" ></i></button>
        </form>
         <div class="processed-image">
        @foreach($data as $image)
            <div class="img-box">
                <div class="image" style="background-image: url({{ asset( $image->name) }})" >
                </div>
                <div class="progress-container">
                    <div class="progress">
{{--                        <h1 id="countdown">10</h1>--}}
                        <i class="fa fa-circle-check"></i>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>

{{--    <script>--}}
{{--        let timeLeft = 10; // Start countdown from 10 seconds--}}
{{--        let countdownElement = document.getElementById("countdown");--}}
{{--        let timer = setInterval(function() {--}}
{{--            timeLeft--; // Decrease time--}}
{{--            countdownElement.textContent = timeLeft;--}}
{{--            if (timeLeft <= 0) {--}}
{{--                clearInterval(timer); // Stop timer when it reaches 0--}}
{{--                countdownElement.textContent = "Time's up!";--}}
{{--            }--}}
{{--        }, 1000); // Run every 1 second--}}
{{--    </script>--}}
</body>
</html>
