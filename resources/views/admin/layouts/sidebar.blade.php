   <!-- Logo Section -->
   <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
       <div class="d-flex align-items-center">
           <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085" alt="Logo" class="me-2" style="height: 35px;">
           <span class="fw-semibold text-primary">FoodAdmin</span>
       </div>
   </div>

   <!-- Navigation Menu -->
   <div class="nav-menu flex-grow-1 px-3 py-4">
       <!-- Main Navigation -->
       <div class="nav-section mb-3">
           <small class="text-muted text-uppercase px-3 mb-2 d-block">Main</small>
           <ul class="nav nav-pills flex-column">
               <li class="nav-item">
                   <a href="index.html" class="nav-link"> <i class="fas fa-home me-2"></i>
                       <span>Dashboard</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="orders.html" class="nav-link">
                       <i class="fas fa-shopping-cart me-2"></i>
                       <span>Đơn hàng</span>
                       <span class="badge rounded-pill bg-danger ms-auto">5</span>
                   </a>
               </li>

           </ul>
       </div>

       <!-- Menu Management Section -->
       <div class="nav-section mb-3">
           <small class="text-muted text-uppercase px-3 mb-2 d-block"><b>Sản phẩm</b></small>
           <ul class="nav nav-pills flex-column">
               <li class="nav-item">
                   <a href="{{route('products.index')}}" class="nav-link">
                       <i class="fas fa-utensils me-2"></i>
                       <span>Quản lý sản phẩm</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{ route('categories.index') }}" class="nav-link {{ Request::routeIs('categories.index') ? 'active' : '' }}"> <i class="fas fa-tags me-2"></i>
                       <span>Quản lý danh mục</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="promotions.html" class="nav-link">
                       <i class="fas fa-percent me-2"></i>
                       <span>Mã giảm giá</span>
                   </a>
               </li>
           </ul>
       </div>

       <!-- Analytics Section -->
       <div class="nav-section mb-3">
           <small class="text-muted text-uppercase px-3 mb-2 d-block">Analytics</small>
           <ul class="nav nav-pills flex-column">
               <li class="nav-item">
                   <a href="#" class="nav-link d-flex align-items-center justify-content-between"
                       data-bs-toggle="collapse"
                       data-bs-target="#reportsCollapse">
                       <div>
                           <i class="fas fa-chart-line me-2"></i>
                           <span>Reports</span>
                       </div>
                       <i class="fas fa-chevron-down fs-xs"></i>
                   </a>
                   <div class="collapse" id="reportsCollapse">
                       <ul class="nav nav-pills flex-column ms-4 mt-2">
                           <li class="nav-item">
                               <a href="#" class="nav-link sub-nav-link">
                                   <i class="fas fa-chart-bar me-2"></i>
                                   <span>Sales Report</span>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="#" class="nav-link sub-nav-link">
                                   <i class="fas fa-chart-pie me-2"></i>
                                   <span>Analytics</span>
                               </a>
                           </li>
                       </ul>
                   </div>
               </li>
           </ul>
       </div>

       <!-- Settings Section -->
       <div class="nav-section">
           <small class="text-muted text-uppercase px-3 mb-2 d-block">Settings</small>
           <ul class="nav nav-pills flex-column">
               <li class="nav-item">
                   <a href="{{ route('users.index') }}" class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}">
                       <i class="fas fa-users me-2"></i>
                       <span>User Management</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="#" class="nav-link">
                       <i class="fas fa-cog me-2"></i>
                       <span>System Settings</span>
                   </a>
               </li>
           </ul>
       </div>
   </div>

   <!-- Bottom Section -->
   <div class="border-top p-3">
       <div class="d-flex align-items-center">
           <div class="flex-shrink-0">
               <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e"
                   alt="Profile"
                   class="rounded-circle"
                   style="width: 40px; height: 40px; object-fit: cover;">
           </div>
           <div class="flex-grow-1 ms-3">
               <div class="fw-semibold">John Doe</div>
               <small class="text-muted">Administrator</small>
           </div>
       </div>
   </div>