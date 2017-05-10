@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->username, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->username }}</p>
            <a href="#">{{ Auth::user()->role }}</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          < <li><a href="{{ url('').'/dashboard' }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

          <li><a href="{{ url('').'/article' }}"><i class="fa fa-newspaper-o"></i><span>Articles</span></a></li>

          <li><a href="{{ url('').'/slide' }}"><i class="fa fa-list"></i> <span>Setup Slider</span></a></li>

          <li><a href="{{ url('').'/company' }}"><i class="fa fa-list"></i> <span>Group Company</span></a></li>

          <li><a href="{{ url('').'/employee' }}"><i class="fa fa-list"></i> <span>Employee</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix').'/menu-item') }}"><i class="fa fa-list"></i> <span>Post Event</span></a></li>

          <li><a href="{{ url(''). '/career' }}"><i class="fa fa-list"></i> <span>Career</span></a></li>
          <!-- ======================================= -->
        
          <li><a href="{{ url(config('backpack.base.route_prefix').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
