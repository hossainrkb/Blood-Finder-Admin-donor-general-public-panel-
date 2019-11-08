<nav class="navbar-default navbar-side" style="background: chocolate" role="navigation">
    <div class="sidebar-collapse" >
        <ul class="nav" id="main-menu" >
            <li  style="background: chocolate" ><a href="{{ route("admin") }}"><i class="fa fa-home fa-2x"></i> <b>Dashboard</b></a></li>
            <li>
                <a href="#"><i class="fa fa-user fa-2x"></i> <b>My Profile</b><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="http://localhost/Blood_management/public/admin_details"><b><i class="fa fa-sign-out"></i> View My Profile</b></a></li>
                    
                </ul>
            </li> 
            
            
            <li>
                <a href="#"><i class="fa fa-user fa-2x"></i> <b>Donors</b><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('admin.donor.create')}}"><b><i class="fa fa-plus"></i> Add donor</b></a></li>
                <li><a href="{{route('admin.donor')}}"><b><i class="fa fa-history"></i> Doner list</b></a></li>
                  
                </ul>
            </li>
            <li>
                    <a href="#"><i class="fab fa-stack-exchange fa-2x"></i> <b>Blood stock</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('admin.stock.create')}}"><b><i class="fa fa-plus"></i> Add blood stock</b></a></li>
                    <li><a href="{{route('admin.stock')}}"><b><i class="fa fa-history"></i> Blood stock list</b></a></li>
                      
                    </ul>
                </li> 
                          <li>
                    <a href="#"><i class="fa fa-certificate fa-2x"></i> <b>Manage Donate</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route("admin.donate.create") }}"><b><i class="fa fa-plus"></i> Donate blood</b></a></li>
                    <li><a href="{{route('admin.donate.log')}}"><b><i class="fa fa-history"></i> Donate history</b></a></li>
                      
                    </ul>
                </li> 
                          <li>
                    <a href="#"><i class="fa fa-certificate fa-2x"></i> <b>Slider</b><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route("admin.slider") }}"><b><i class="fa fa-plus"></i> Slide list</b></a></li>
                    <li><a href="{{route('admin.slider.create')}}"><b><i class="fa fa-history"></i> Add Slide</b></a></li>
                      
                    </ul>
                </li> 
  
          
        </ul>
    </div>
</nav>