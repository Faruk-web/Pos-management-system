

@php
$pro_link = Auth::guard(config('fortify.guard'))->user();
@endphp
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="d-none d-lg-block">
                <form class="app-search">
                    <div class="app-search-box dropdown">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." id="top-search">
                            <button class="btn input-group-text" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">


                        </div>
                    </div>
                </form>
            </li>
            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-search noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            
            
 <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                       @php
                    $orders_count= App\Models\Order::where('status', 'Pending')->select('id')->count();
                    
                    @endphp
                    <span class="badge bg-danger rounded-circle noti-icon-badge">{{$orders_count}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">
    
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a href="" class="text-dark">
                                    <!--<small>Clear All</small>-->
                                </a>
                            </span>Notification
                        </h5>
                    </div>
    
                    <div class="noti-scroll" data-simplebar>
    
    
    
    
    
    
                        @php
                        $orders = App\Models\Order::where('status', 'Pending')->latest()->limit(6)->get();
                        
                        
                        @endphp
                            
                        @foreach ($orders as $order) 
                      
                      
                        
                        
                         <a href="{{route('role.order.pendingOrdersDetails',['admin',$order->id])}}" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Customer Name: {{optional($order->user)->name }}
                                <small class="text-muted"><b>Invoice no/Order no:     {{$order->invoice_no}}</b></small>
                             <small class="text-muted">Time:     {{$order->order_date}}</small>

                            </p>
                        </a>
                          @endforeach
                    </div>
    
                    <!-- All-->
                    <a href="{{route('role.order.pendingOrdersList','admin')}}" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fe-arrow-right"></i>
                    </a>
    
                </div>
            </li>
            
            
            
            
            
            
            
            
            
            
            
            <li class="dropdown notification-list topbar-dropdown">

                <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a href="" class="text-dark">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>
                    <div class="noti-scroll" data-simplebar>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            
                            
                            <div class="notify-icon">
                                <img src="{{ asset('backend') }}/assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" />
                            </div>
                            
                            
                            
                            
                            <p class="notify-details">Cristina Pride</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Hi, How are you? What about our next meeting</small>
                            </p>
                        </a>
                        <!-- All-->
                        <a href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fe-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                
                
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    
                    @auth('admin')
                        @if(auth()->guard('admin')->user()->supplier_id)
                            @php
                                $supplier = App\Models\Supplier::where('id',auth()->guard('admin')->user()->supplier_id)->first();
                            @endphp
                            
                             <img src="{{ asset('upload/avatar-4.png')}}" alt="Supplier Image">
                        @elseif (auth()->guard('admin')->user()->employee_id)
                            @php
                                $employee = App\Models\Employee::where('id',auth()->guard('admin')->user()->employee_id)->first();
                            @endphp
                        
                            <img src="{{ $employee->employee_img ? asset($employee->employee_img) : asset('upload/avatar-4.png')}}" alt="Supplier Image">
                        @elseif (auth()->guard('admin')->user()->agent_id)
                            @php
                                $agent = App\Models\AgentPanel::where('id',auth()->guard('admin')->user()->agent_id)->first();
                            @endphp
                        
                            <img src="{{ asset('public/upload/admin_images/').'/'.$pro_link->profile_photo_path}}" alt="Agent  Image">
                        @else
                        
                            <img src="{{ asset('public/upload/admin_images/').'/'.$pro_link->profile_photo_path}}" alt="Admin Image">
                        @endif
                       
                    @endauth
                    <span class="pro-user-name ms-1">
                       <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                
                
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        @if(Auth::guard('admin')->user()->supplier_id !== null )
                            <a class="dropdown-item" href="{{ route('admin.admin_profile_view') }}"><i
                                class="ti-user text-muted mr-2"></i> Supplier Profile</a>
                        @elseif(Auth::guard('admin')->user()->employee_id !== null)
                        <a class="dropdown-item" href="{{ route('admin.admin_profile_view') }}" style="font-weight:bold; font-size: 16px"><i
                                class="ti-user text-muted mr-2"></i> employee Profile</a>
                        @elseif(Auth::guard('admin')->user()->agent_id !== null)
                            <a class="dropdown-item" href="{{ route('admin.agent_profile_view') }}" style="font-weight:bold; font-size: 16px"><i
                                class="ti-user text-muted mr-2"></i> agent Profile</a>
                                
                                <br>
                              
                        @else
                        <a class="dropdown-item btn btn-success" href="{{ route('admin.admin_profile_view') }}" ><i
                                class="ti-user text-muted mr-2"></i> My Profile</a>
                                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                      <br>
                        <a class="dropdown-item" href="{{ route('admin.admin_change_password') }}"><i
                                class="ti-wallet text-muted mr-2"></i> Change Password</a>
                    </a>
                        @endif
                    </a>
                    <!-- item-->
                  
                   

                    <form method="POST" action="{{route(config('fortify.guard') . '.' . 'logout') }}">
                        @csrf
                        <x-jet-dropdown-link href="{{ route(config('fortify.guard') . '.' . 'logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"><b style="font-weight:bold; font-size: 16px;padding-top: 10px">   {{ __('Log Out') }} </b>
                        </x-jet-dropdown-link>
                    </form>


                </div>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{ route('admin.dashboard') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    @php
                    $setting = App\Models\SiteSetting::select('logo')->first();
                    @endphp
                    <img src={{ asset(optional($setting)->logo) }} width="90" height="40" alt="">
                </span>
                <span class="logo-lg">
                    @php
                    $setting = App\Models\SiteSetting::select('logo')->first();
                    @endphp
                    <img src={{ asset(optional($setting)->logo) }} width="150" height="60" alt="">
                </span>
            </a>
        </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    const loginSubmint = document.getElementById("loginBtn");
      loginSubmint.addEventListener("click", function () {
        
        const transactionArea = document.getElementById("showData");
        transactionArea.style.display = "block";
      });
</script>
