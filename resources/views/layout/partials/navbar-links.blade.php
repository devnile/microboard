<li class="nav-item">
    <a class="nav-link active" href="#navbar-dashboards" data-toggle="collapse" role="button"
       aria-expanded="true" aria-controls="navbar-dashboards">
        <i class="ni ni-shop text-primary"></i>
        <span class="nav-link-text">Dashboards</span>
    </a>
    <div class="collapse show" id="navbar-dashboards">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('microboard.home') }}" class="nav-link">
                    <span class="sidenav-mini-icon"> D </span>
                    <span class="sidenav-normal"> Dashboard </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('microboard.home') }}" class="nav-link active">
                    <span class="sidenav-mini-icon"> A </span>
                    <span class="sidenav-normal"> Alternative </span>
                </a>
            </li>
        </ul>
    </div>
</li>
