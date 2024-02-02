<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Local Bootstrap CSS (Replace with your path) -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Datatables css -->
    <link href="assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />

</head>


<body>
    <div class="col-md-2" style="float: left;">
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand my-4 ms-4">

                        <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/logobyed.svg" alt="" /></a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" id="dashboardTab">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.users') }}" id="usersTab">
                            <i class="fas fa-user me-2"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.trips') }}" id="tripsTab">
                            <i class="fas fa-suitcase me-2"></i> Trips
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('dashboard.reservations') }}">
                            <i class="fas fa-clock me-2"></i> Reservations
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cogs me-1"></i> Settings
                        </a>
                    </li>
                    <br>
                    <!-- Logout button -->
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                        
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
        </div>

    </div>
    <!-- content part -->

    <div class="container col-md-10" style="float: right;padding:2rem;">
        <h1 class="text-center">Reservations View</h1>
        <BR></BR>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Name
                </th>
                <th class="th-sm">Position
                </th>
                <th class="th-sm">Office
                </th>
                <th class="th-sm">Age
                </th>
                <th class="th-sm">Start date
                </th>
                <th class="th-sm">Salary
                </th>
                <th class="th-sm">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>
                    <!-- Edit and delete icons with data-toggle attributes for modals -->
                    <a href="#" data-toggle="modal" data-target="#editModal">
                        <i class="fas fa-edit me-2"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
              </tr>
              <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>
                    <!-- Edit and delete icons with data-toggle attributes for modals -->
                    <a href="#" data-toggle="modal" data-target="#editModal">
                        <i class="fas fa-edit me-2"></i>
                    </a>

                    <a href="#" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
              </tr>
            </tbody>
          </table> 
    </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</html>