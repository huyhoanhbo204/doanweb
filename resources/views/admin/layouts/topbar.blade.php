<div class="container-fluid px-3">
    <!-- Mobile Menu Toggle -->
    <button class="btn btn-icon me-2" id="mobileSidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Logo - Show only on mobile -->
    <a class="navbar-brand d-flex align-items-center me-auto">
        <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085"
            alt="Logo"
            class="me-2"
            style="height: 32px;">
        <span class="fw-semibold text-primary d-none d-sm-inline">FoodAdmin</span>
    </a>

    <!-- Right Side Items -->
    <div class="d-flex align-items-center gap-3">
        <!-- User Profile -->
        <div class="dropdown">
            <button class="btn p-0" data-bs-toggle="dropdown">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                    alt="Profile"
                    class="rounded-circle"
                    style="width: 35px; height: 35px; object-fit: cover;">
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow-sm">
                <div class="px-3 py-2">
                    <div class="fw-semibold">{{ Auth::check() ? Auth::user()->fullname : 'null' }}</div>
                    <small class="text-muted">{{ Auth::check() ? Auth::user()->role : 'null' }}</small>

                </div>
                <a class="dropdown-item text-primary" href="{{ route('index') }}">
                    <i class="fas fa-home me-2"></i> Home
                </a>

                <!-- Logout Item -->
                <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>



<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Search...">
                </div>
                <div class="mt-3">
                    <small class="text-muted">Recent Searches</small>
                    <div class="list-group list-group-flush mt-2">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-history me-2 text-muted"></i>
                            Chicken Burger
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-history me-2 text-muted"></i>
                            Order #12345
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>