<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://localhost:8000/{{Auth::user()->avatar_image}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <!-- Status   href="{{route('editProfile',['user'=>Auth::user()->name])}}" -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
<span class="input-group-btn">
  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
</span>
            </div>
        </form>  --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <br><br>
        <ul class="sidebar-menu">
            {{--  <li class="header">HEADER</li>  --}}

            <!-- Optionally, you can add icons to the links -->
            <li><a href="/index"><span>Dashboard</span></a></li>
            @role('admin')
            <li><a href="/managers"><span>Managers</span></a></li>
            @endrole

            @hasanyrole('admin|manager')
            <li><a href="/receptionists"><span>Receptionists</span></a></li>
            @endhasanyrole
            
            @hasanyrole('admin|manager')
            <li><a href="/floors"><span>Floors</span></a></li>
            <li><a href="/rooms"><span>Rooms</span></a></li>
            @endrole
            
            @hasanyrole('admin|manager|receptionist')
            <li><a href="/clients"><span>Clients</span></a></li>
            @endhasanyrole
            
            @hasanyrole('receptionist|client')
            <li><a href="/reservations"><span>Reservations</span></a></li>
            @endhasanyrole
            {{--  <li class="active"><a href="#"><span>Link</span></a></li>
            <li><a href="#"><span>Another Link</span></a></li>
            <li class="treeview">
                <a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>  --}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>