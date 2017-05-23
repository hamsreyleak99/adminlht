<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

       @if (Auth::guest())
          <li><a href="{{ url('').'/login' }}">Login</a></li>
          @if (config('backpack.base.registration_open'))
          <li><a href="{{ url('').'/register' }}">Register</a></li>
          @endif
        @else
          <li style="width:54px;padding-top: 15px;">
            <form action="" method="get">
              <input type="submit" name="lang"​​ style="background: green ;border:0px;" value="EN"​​​​​​​>
            </form>
          </li>
          <li style="width:54px;padding-top: 15px;">
            <form action="" method="get">
              <input type="submit" name="lang" value="KH" style="background: red ;border:0px;">
            </form>
          </li>

          <li><a href="{{ redirect('/admin/login') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>    
        @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
