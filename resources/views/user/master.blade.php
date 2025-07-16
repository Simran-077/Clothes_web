
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="http://127.0.0.1:8002/assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text fw-bolder mx-3">User Panel<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Items
        </div>

                <!-- Tea Items in Dashboard -->
                <li class="nav-item">
            <a class="nav-link" href="{{ route('user.inquiry') }}">
            <i class="fa-solid fa-list-check me-2"></i> Add Form
            </a>

            <a class="nav-link" href="{{ route('user.inquiry-list') }}">
            <i class="fa-solid fa-list-check me-2"></i> Inquiry List
            </a>

            <a class="nav-link" href="{{ route('user.change-pass') }}">
            <i class="fa-solid fa-list-check me-2"></i> Change Passwords
            </a>

             <a class="nav-link" href="{{ route('user.profile.show') }}">
            <i class="fa-solid fa-list-check me-2"></i> Profile Update
            </a>
        </li>
           <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    </ul>

    

    <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column ">

            <!-- Main Content -->
            <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand  navbar-light bg-white topbar mb-4 static-top shadow">
 
        <!-- sidebar toggle -->
        <button class="btn btn-light border me-3" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>


            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 ">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

   

            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route ('signout') }}">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
        <!-- End of Topbar -->

                <!-- Begin Page Content -->
              @yield('content')


                <!-- JavaScript for Charts -->
       
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; All rights reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route ('signout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

   <script>
    document.addEventListener("DOMContentLoaded", function () {
        let sidebar = document.getElementById('accordionSidebar');
        let toggleButton = document.getElementById('sidebarToggle');

        // Check local storage for sidebar state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('d-none');
        }

        // Toggle sidebar on button click
        toggleButton.addEventListener('click', function () {
            let isCollapsed = sidebar.classList.toggle('d-none');

            // Save state to local storage
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
    });
</script>


<!-- Latest compiled and minified CSS -->


<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>