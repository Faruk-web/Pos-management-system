<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $seo = App\Models\Seo::first();
    @endphp
    <meta charset="utf-8" />
    <!--<title>{{ optional($seo)->meta_title }}</title>-->
    <title>BPP Shops | Best Product Best Price</title>
    <meta name="title" content={{  optional($seo)->meta_title }}>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content={{ optional($seo)->meta_description }} name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content={{ optional($seo)->meta_author }}>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../admin/images/favicon.ico">
    <!-- Plugins css -->
    <link href="{{ asset('backend/assets') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets') }}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet"type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets') }}/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('backend/assets') }}/css/config/default/app.min.css" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />
    <link href="{{ asset('backend/assets') }}/css/config/default/bootstrap-dark.min.css" rel="stylesheet"
        type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('backend/assets') }}/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />
    <link href="{{ asset('backend/assets') }}/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets') }}/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets') }}/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"> 
    <!-- icons -->
    <link href="{{ asset('backend/assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets') }}/css/dashboard.css" rel="stylesheet">
    {{--  <link href="{{ asset('backend/assets') }}/css/select2.min.css" rel="stylesheet" type="text/css" />  --}}
    {{-- for toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-chart/2.0.28/LineChart.css"
     integrity="sha512-KTcZ1aiiCoscXQSTvRF5uR9jwSrrg9L6tBVc9zY/wKN1tJK1WopBBeur/OxX0P6Q8DJ4dGyJfMXgg0YqNO6JLw=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-chart/2.0.28/LineChart.min.css"
     integrity="sha512-FJXBXgnzZanDfKn4LojPpiiuOlpyTNDrM7Q9p0OUPY+SN9Ro3kICrpsktOpfhbh2nbGSyLNbyRLtele+TprlrQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .avatar-title {
            align-items: center;
            color: #fff;
            display: flex;
            height: 100%;
            justify-content: center;
            width: 100%;
        }
         .errorColor {
            color: red;
        }

         .product-select .pro-sel-mb {
            margin-right: 10px;
        }

        .jfss-btn,
        .jfss-btn:hover {
            background: #1ABC9C;
            border-radius: 3px;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            color: #FFFFFF;
        }

        .qty-inr {
            width: 100%;
            text-align: center;
            position: relative;
            margin-top: 10px;
        }

        .qty-inr .lines {
            background-color: #fff;
            width: auto;
            display: inline-block;
            z-index: 3;
            padding: 0 20px 0 20px;
            color: #464646;
            position: relative;
            font-weight: bold;
            margin: 0;
        }

        .qty-inr::after {
            content: '';
            width: 100%;
            border-bottom: 1px solid #6C757D;
            position: absolute;
            left: 0;
            top: 50%;
        }

        .right-arrows {
            position: absolute;
            right: 0;
            top: 3.8px;
            color: #6C757D;
        }

        .left-arrows {
            position: absolute;
            left: 0;
            top: 3.8px;
            color: #6C757D;
        }

        .jfss-btn1 {
            background: #EAF1F4;
            border-radius: 5px;
            font-weight: 600;
            font-size: 18px;
            line-height: 25px;
            text-align: center;
            color: #6C757D;
        }

        .jfss-btn2,
        .jfss-btn2:hover {
            background: #1ABC9C;
            border-radius: 5px;
            font-weight: 600;
            font-size: 18px;
            line-height: 25px;
            text-align: center;
            color: #fff;
        }

        .modal-return-product h6 {
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
            line-height: 12px;
            color: #6C757D;
        }

        .modal-return-product h6 span {
            margin-bottom: 5px;
            font-weight: 400;
            font-size: 14px;
            line-height: 12px;
            color: #6C757D;
        }

        .modal-tble .table {
            width: 100%;
            border: 1px solid #DEE2E6;
            text-align: center;
        }

        .modal-tble td span {
            border: 1px solid #DEE2E6;
            padding: 8px 40px;
        }
        /* ------supplier list------ */
        .avatar-title {
            align-items: center;
            color: #fff;
            display: flex;
            height: 100%;
            justify-content: center;
            width: 100%;
          }
          .left-side-menu{
            width: 255px;
          }
          .footer{
            left: 255px;
          }
           .qty {
            width: 100%;
            text-align: center;
            position: relative;
            margin-top: 0px;
          }
          .qty .line {
            background-color: #fff;
            width: auto;
            display: inline-block;
            z-index: 3;
            padding: 0 20px 0 20px;
            color: #464646;
            position: relative;
            font-weight: bold;
            margin: 0;
          }
          .qty::after {
            content: '';
            width: 100%;
            border-bottom: 1px solid #000;
            position: absolute;
            left: 0;
            top: 50%;
          }
          .right-arrow{
            position: absolute;
            right: 0;
            top: 3.8px;
            color: #000;
          }
          .left-arrow{
            position: absolute;
            left: 0;
            top: 3.8px;
            color: #000;
          }
          .prdQty {
                border: 1px solid #ced4da;
                margin-bottom: 0;
                padding: 5px 0;
                text-align: center;
                width: 120px;
            }
            .prdQty:focus {
                outline: none;
            }
          #datatable-buttons_wrapper .row:nth-child(1) > .col-sm-12:nth-child(1) {
            width: 100%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top:5px;
           }
          #datatable-buttons_wrapper .row:nth-child(1) > .col-sm-12:nth-child(2) .dataTables_filter {
            position: absolute;
            right: 20px;
            top: 10px;
            padding:50px;
          }
          #return-product-submit-modal .table-striped>tbody>tr:nth-of-type(odd){
            --bs-table-accent-bg: #fff;
          }

          .addReturnAblePrdBtn {
              display: flex;
              justify-content: end;
          }
         @media (max-width: 1795px){
            .addReturnAblePrdBtn {
              justify-content: center;
            }
          }
          @media (max-width: 1190px){
            .addReturnAblePrdBtn {
              justify-content: start;
            }
          }
          @media (max-width: 991px){
                #datatable-buttons_wrapper .row:nth-child(1) > .col-sm-12:nth-child(2) .dataTables_filter {
                    top: 115px;
                    right: auto;
            }
            #datatable-buttons_wrapper .row:nth-child(1) > .col-sm-12:nth-child(1) {
                margin-top: 35px;
            }
          }
          @media (max-width: 767px){
            #datatable-buttons_wrapper .row:nth-child(1) > .col-sm-12:nth-child(1) {
                justify-content: center;
            }
          }
/* -------------new manager--------------------- */
.dropify-wrapper {
                height: 200px !important;
                width: 200px !important;
            }
            .submitBtn {
                width: 129.2px;
                height: 45.4px;
                background: #1ABC9C;
                border-radius: 5.25025px;
                font-family: 'Nunito';
                font-weight: 600;
                font-size: 18.9009px;
                text-align: center;
                color: #FFFFFF;
                border: transparent;
            }
            .header-title {
                font-family: 'Inter';
                font-style: normal;
                font-weight: 400;
                font-size: 28px;
                color: #343A40;
            }


    </style>
    @yield('css')
</head>
<!-- body start -->
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        @include('admin.body.admin_header')
        <!-- end Topbar -->
        @include('admin.body.admin_sidebar')
        <!-- Left Sidebar End -->
        <div class="content-page">
            @yield('main-content')
            <!-- Footer Start -->
            @include('admin.body.admin_footer')
            <!-- end Footer -->
        </div>
    </div>
    <!-- END wrapper -->
    
     <audio type="hidden" id="myAudio">
     <source src="/backend/audio/tone.m4r" type="audio/ogg">
     <source src="/backend/audio/tone.m4r" type="audio/mp3">
     <source src="/backend/audio/tone.m4r" type="audio/ogg">

</audio>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> New Order</h5>
            <button type="button" class="close" id="modalClose" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="message"></p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-info" href="{{ route('role.pending.orders',config('fortify.guard')) }}">Order Processing</a>
            <button type="button" id="modalClose" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>




<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    // Enable pusher logging - don't include this in production
    var x = document.getElementById("myAudio");

    Pusher.logToConsole = true;
    var pusher = new Pusher('944714cb2e052ae0d6fb', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe('my-channel');
    console.log(channel,'running from custom')
    channel.bind('my-event', function(data) {

        console.log(data.message);
        $('#message').append(data.message);



        //   $('#exampleModal').modal('show');
          playAudio();
    });

    function playAudio() {
      x.play();
    }

  </script>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets') }}/js/vendor.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Plugins js-->
    <script src="{{ asset('backend/assets') }}/libs/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/apexcharts/apexcharts.min.js"></script>
    <!-- <script src="{{ asset('backend/assets') }}/libs/selectize/js/standalone/selectize.min.js"></script> -->
    <!-- Dashboar 1 init js-->
    <script src="{{ asset('backend/assets') }}/js/pages/dashboard-1.init.js"></script>
    <!-- App js-->
    <script src="{{ asset('backend/assets') }}/js/app.min.js"></script>
    <!-- Chart JS -->
    {{-- <script src="{{ asset('backe0nd/assets') }}/libs/chart.js/Chart.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Init js -->
    <script src="{{ asset('backend/assets') }}/js/pages/chartjs.init.js"></script>
    <!-- init js -->
    <script src="{{ asset('backend/assets') }}/js/pages/apexcharts.init.js"></script>
    <!--Morris Chart-->
    <script src="{{ asset('backend/assets') }}/libs/morris.js06/morris.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/raphael/raphael.min.js"></script>
    <!-- Init js -->
    <script src="{{ asset('backend/assets') }}/js/pages/morris.init.js"></script>
    <!-- Toastr cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    // <script>
    //     @if (Session::has('message'))
    //         var type = "{{ Session::get('alert-type') }}"
    //         switch (type) {

    //         case 'info':
    //             toastr.options = {
    //                 "showDuration": "300000",
    //                 "hideDuration": "100000",
    //                 "timeOut": "500000",
    //                 "extendedTimeOut": "100000",
    //                 }
    //         toastr.info(" {{ Session::get('message') }} ");
    //         break;

    //         case 'success':
    //         toastr.success("{{ Session::get('message') }} ");

    //         break;

    //         case 'warning':
    //         toastr.warning(" {{ Session::get('message') }} ");
    //         break;

    //         case 'error':
    //         toastr.error(" {{ Session::get('message') }} ");
    //         break;
    //         default:
    //         break;
    //         }
    //     @endif
    // </script>
    <!-- general toastr message showing section start-->
    <script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
    <!-- general toastr message showing section end-->
    {{-- sweet alert note.... --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085D6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        }); // main funcations end

        $('#modalClose').on('click',function()
        {
            console.log('herer');
            $('#exampleModal').modal('toggle');
        });
    </script>
    {{-- for sweet alert --}}
    {{-- script for dataTable --}}
    <!-- third party js -->
    <script src="{{ asset('backend/assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">      b bb b b </script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script> 
    <script src="{{ asset('backend/assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('backend/assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{ asset('backend/assets') }}/js/pages/datatables.init.js"></script>

    <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2005', '2007', '2009', '2011', '2013', '2015',],
            datasets: [{
                label: '# Analytics',
                data: [65, 56, 80, 82, 55, 53, 30],
                backgroundColor: [
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)'
                ],
                borderColor: [
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)',
                    'rgba(20,155,198,0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [10, 10],
                        display: true
                    }
                },
                x: {
                    grid: {
                        lineWidth: 5,
                        display: false
                    }
                }
            }
        }
    });
    
    // Start Delete Section
        $('.delete-confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("id");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete ${id}?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
        });
      // End Delete Section
</script>
<script>
    const ctx2 = document.getElementById('myChart2');
    const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
                function myFunction() {  
                  // Declare variables
                  var input, filter, table, tr, td, i, txtValue,status = 0;
                  input = document.getElementById("myinput");
                  filter = input.value.toUpperCase();
                  table = document.getElementById("mytable");
                  tr = table.querySelectorAll(".searchData");
                
                  // Loop through all table rows, and hide those who don't match the search query
                  for (i = 0; i < tr.length; i++) {
                    tempTd = tr[i].getElementsByTagName("td");
                    status = 0;
                    
                    for(j=0; j<tempTd.length;j++)
                    {
                        td = tempTd[j];
                        if (td) {
                          txtValue = td.textContent || td.innerText;
                          if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            status=1;
                          }
                          if(!status) 
                            {
                            status=0;
                          }
                        }

                    }

                    if(status)
                    {
                        tr[i].style.display = "";
                    }
                    else
                    {
                        tr[i].style.display = "none";
                    }
                  }
                }
                </script>










    @yield('script')

</body>



</html>
