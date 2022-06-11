<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Canossa Enrollment System</title>

<<<<<<< HEAD
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        
    </body>
=======
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Styles -->
</head>
<!-- Button trigger modal -->
<body>
<div class="position-absolute top-50 start-50 translate-middle" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl ">
    <div class="modal-content">
    <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="exampleModalLabel">Register Student</h5>
            </div>
            <form>
           
            <div class="row g-2 m-5" class="modal body ">
                <div class="col-4">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required>
                </div>
                <div class="col-4">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="" required>
                </div>
                <div class="col-4">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" required>
                </div>
                <div class="col-6">
                    <label for="Birthplace">Birthplace</label>
                    <input type="text" class="form-control" id="Birthplace" placeholder="" required>
                </div>
                <div class="col-2">
                    <label for="Age">Age</label>
                    <input type="text" class="form-control" id="Age" placeholder="" required>
                </div>
                <div class="col-2">
                    <label>Birthday</label>
                    <input type="date" class="form-control" required>
                </div>
                <div class="col-2">
                    <label class="" for="gender">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option selected>Choose...</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" placeholder="" required>
                </div>
                <div class="col-6">
                    <label for="Contact Number" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="Contact Number" name="Contact Number" placeholder=""
                        required>
                </div>
                <div class="col-6">
                    <label for="E-mail" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="E-mail" name="E-mail" placeholder="example@gmail.com" required>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Marital Status</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option value="single">single</option>
                        <option value="single">married</option>
                        <option value="single">widowed</option>
                        <option value="single">divorce</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="Citizenship" class="form-label">Citizenship</label>
                    <input type="text" class="form-control"  name="Citizenship" id="Citizenship" required>
                </div>
                <div class="col-5">
                    <label class="" for="course">Course</label>
                    <select class="form-select" id="course" name="course" required>
                        <option selected>Choose...</option>
                        <option value="BSIT"> BSIT</option>
                        <option value="BSENT">BSENT</option>
                        <option value="BBTLED">BBTLED</option>
                    </select>
                </div>
                <div class="col-2">
                    <label class="" for="year">Year</label>
                    <select class="form-select" id="year" name="year" required>
                        <option selected>Choose...</option>
                        <option value="1st_year">1st Year</option>
                        <option value="2nd_year">2nd Year</option>
                        <option value="3rd_year">3rd Year</option>
                        <option value="4th_year">4th Year</option>
                    </select>
                </div>
               
         

                <div class="col-2">
                    <label class="" for="semester">Semester</label>
                    <select class="form-select" id="semester" name="semester" required>
                        <option selected>Choose...</option>
                        <option value="1st_semester">1st Semester</option>
                        <option value="2nd_semester">2nd Semester</option>
                    </select>
                </div>
                </div> 
         
      <div class="modal-footer">
      <div class="container mt-3 px-2">
            <button type="Submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->

<!-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModal" role="button">Open first modal</a> -->


    
            
        
    <!-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">  -->
    <!-- @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->
</body>

>>>>>>> 871c9d6ed05beb989f1b5797a77fdc7e2fcfb72a
</html>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">