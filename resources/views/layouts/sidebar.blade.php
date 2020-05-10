<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{url($img_path)}}/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{auth()->user()->FullName}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
    <form action="{{route('dashboard.users.index')}}" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="q" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

        @if(auth()->user()->hasPermission('read_users'))
      <li><a href="{{route('dashboard.users.index')}}"><i class="fa fa-circle-o text-red"></i> <span>Users</span></a></li>
      @endif
      @if(auth()->user()->hasPermission('read_categories'))
      <li><a href="{{route('dashboard.categories.index')}}"><i class="fa fa-circle-o text-yellow"></i> <span>Categories</span></a></li>
      @endif
      @if(auth()->user()->hasPermission('read_products'))
      <li><a href="{{route('dashboard.products.index')}}"><i class="fa fa-circle-o text-green"></i> <span>Products</span></a></li>
      @endif
      @if(auth()->user()->hasPermission('read_clients'))
      <li><a href="{{route('dashboard.clients.index')}}"><i class="fa fa-circle-o text-blue"></i> <span>Clients</span></a></li>
      @endif

      @if (auth()->user()->hasPermission('read_orders'))
      <li><a href="{{route('dashboard.orders.index')}}"><i class="fa fa-circle-o text-aqua"></i> <span>Orders</span></a></li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
