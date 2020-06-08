<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit" class="dropdown-item">
        <i class="ni ni-user-run"></i>
        <span>Logout</span>
    </button>
</form>
