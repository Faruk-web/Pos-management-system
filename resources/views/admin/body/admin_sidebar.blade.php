@php
     $prefix = Request::route()->getPrefix();
     $route = Route::current()->getName();
 @endphp

 {{-- @php
     $currentUser = auth()
         ->guard(config('fortify.guard'))
         ->user();
     $setting = isset($currentUser->setting) && $currentUser->setting == 1 ? true : false;
     $adminuserrole = isset($currentUser->adminuserrole) && $currentUser->adminuserrole == 1 ? true : false;
     $pos = isset($currentUser->pos) && $currentUser->pos == 1 ? true : false;
     $employee = isset($currentUser->employee) && $currentUser->employee == 1 ? true : false;
     $websetting = isset($currentUser->websetting) && $currentUser->websetting == 1 ? true : false;
 @endphp --}}
 <div class="left-side-menu" >
     <div class="h-100" data-simplebar>
         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <ul id="side-menu">
             
                     <li>
                         <a href="{{ route('role.pos', config('fortify.guard')) }}">
                             <i class="fas fa-calculator"></i>
                             <span style="font-size:18px; font-family:Ubuntu">Manage POS </span>
                         </a>
                     </li>
                 

                
                     <li style="font-size:17px; font-family:Ubuntu">
                         <a href="#add-employee" data-bs-toggle="collapse">
                             <i class="fa fa-building"></i>
                             <span style="font-size:18px; font-family:Ubuntu"> Employee Manage </span>
                             <span class="menu-arrow"></span>
                         </a>

                         <div class="collapse" id="add-employee">
                             <ul class="nav-second-level">


                            <li style="font-size:17px; font-family:Ubuntu">
                                <a href="{{ route('role.department.view', config('fortify.guard')) }}">Add Department</a>
                            </li>


                                 <li style="font-size:17px; font-family:Ubuntu">
                                     <a href="{{ route('role.employee.addform', config('fortify.guard')) }}">Add
                                         Employee</a>
                                 </li>
                                 <li style="font-size:17px; font-family:Ubuntu">
                                     <a href="{{ route('role.employee.view', config('fortify.guard')) }}">Manage
                                         Employee</a>
                                 </li>


                                 <li style="font-size:17px; font-family:Ubuntu">
                                    <a href="{{ route('role.salary-add', config('fortify.guard')) }}">Pay Salary</a>
                                </li>

                                <li style="font-size:17px; font-family:Ubuntu">
                                    <a href="{{ route('role.paid_salary', config('fortify.guard')) }}">Paid Salary List</a>
                                </li>

                                   <li>
                                    <a href="{{ route('role.trackingHistory', config('fortify.guard')) }}">Employee Tracking History</a>
                                </li>

                             </ul>
                         </div>
                     </li>
                

            

                 {{-- <li style="font-size:17px; font-family:Ubuntu">
                    <a href="{{ route('role.all.admin.user', config('fortify.guard')) }}"> <i class="fas fa-lock"></i>Manage Role & Permission
                    </a>
                 </li> --}}

             


               
                     <li style="font-size:17px; font-family:Ubuntu">
                         <a href="#web_site_setting" data-bs-toggle="collapse">
                             <i class="fe-settings"></i>
                             <span> Web Settings </span>
                             <span class="menu-arrow"></span>
                         </a>
                         <div class="collapse" id="web_site_setting">
                             <ul class="nav-second-level">

                                 <li style="font-size:17px; font-family:Ubuntu">
                                     <a
                                     href="{{ route('role.manage.slider', config('fortify.guard')) }}">Add
                                     Slider</a>
                                 </li>
                                 <li style="font-size:17px; font-family:Ubuntu">
                                   <a href="{{ route('role.bennar.manage', config('fortify.guard')) }}">Top Banner</a>

                                 </li>

                                     <li style="font-size:17px; font-family:Ubuntu">
                                            <a href="{{ route('role.banner.view.manage', config('fortify.guard')) }}">Manage
                                                Sub Category And Shop Now Banner</a>

                                        </li>

                                 <li>

                              </li>

                                 <li style="font-size:17px; font-family:Ubuntu">
                                 <a href="{{ route('role.bannerCategory.manage', config('fortify.guard')) }}">Ads Banner</a>

                                 </li>


                             </ul>
                         </div>
                     </li>
              





                
                     <li style="font-size:17px; font-family:Ubuntu">
                         <a href="#software_setting_main" data-bs-toggle="collapse">
                             <i class="fe-settings"></i>
                             <span> Software Settings </span>
                             <span class="menu-arrow"></span>
                         </a>
                         <div class="collapse" id="software_setting_main">
                             <ul class="nav-second-level">

                                     <li style="font-size:17px; font-family:Ubuntu">
                                         <a href="{{ route('role.site.setting', config('fortify.guard')) }}">
                                             General Setting</a>
                                     </li>
                                     <li style="font-size:17px; font-family:Ubuntu">
                                         <a href="{{ route('role.seo.setting', config('fortify.guard')) }}">
                                             SEO Setting</a>
                                     </li>
                                     <li style="font-size:17px; font-family:Ubuntu">
                                        <a href="{{ route('role.subscribe.view',config('fortify.guard')) }}">
                                           Subscribers Email
                                        </a>
                                     </li>


                                 </ul>
                             </div>
                             </li>
                       

        </ul>
    </div>
    </li>

    </ul>

 </div>
 <!-- End Sidebar -->
 </div>
 <!-- Sidebar -left -->
 </div>
