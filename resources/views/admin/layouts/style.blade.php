<style>
    :root {
        --primary-color: #2563eb;
        --success-color: #059669;
        --warning-color: #d97706;
        --info-color: #0891b2;
        --sidebar-width: 280px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    .sidebar {
        width: var(--sidebar-width);
        box-shadow: 1px 0 10px rgba(0, 0, 0, 0.05);
    }

    .nav-link {
        color: #64748b;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        color: #1e293b;
        background-color: #f1f5f9;
    }

    .nav-link.active {
        background-color: var(--primary-color);
        color: white;
    }

    .stat-icon {
        padding: 1rem;
        border-radius: 12px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .search-input {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-icon:hover {
        background-color: #f1f5f9;
    }

    .table th {
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
    }

    /* Custom gradients for stat cards */
    .bg-primary {
        background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #059669, #10b981) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #d97706, #f59e0b) !important;
    }

    .bg-info {
        background: linear-gradient(135deg, #0891b2, #06b6d4) !important;
    }

    /* Mobile Sidebar and Layout Styles */
    @media (max-width: 991.98px) {
        .sidebar {
            position: fixed;
            left: -280px;
            top: 0;
            bottom: 0;
            z-index: 1045;
            transition: 0.3s ease-in-out;
            width: 280px;
        }

        .sidebar.show {
            left: 0;
        }

        .main-content {
            width: 100% !important;
            margin-left: 0 !important;
            transition: 0.3s ease-in-out;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }
    }

    /* Desktop Sidebar and Layout Styles */
    @media (min-width: 992px) {
        .sidebar {
            position: fixed;
            height: 100vh;
            transition: width 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease-in-out;
        }

        .sidebar.collapsed+.main-content {
            margin-left: 70px;
            width: calc(100% - 70px);
        }
    }

    /* Common styles for both mobile and desktop */
    .main-content {
        min-height: 100vh;
        background-color: #f8fafc;
    }

    .sidebar.collapsed .nav-link span,
    .sidebar.collapsed .nav-section small,
    .sidebar.collapsed .profile-info,
    .sidebar.collapsed .sidebar-brand-text {
        display: none;
    }

    .sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 0.75rem;
    }

    .sidebar.collapsed .nav-link i {
        margin: 0;
        font-size: 1.25rem;
    }

    p.text-muted {
        padding-top: 12px;
        padding-right: 10px;
    }

    /* Adjust alignment of the 'Showing' text and pagination buttons */
    #showingResults {
        font-size: 0.875rem;
        /* Adjust the font size if necessary */
        color: #6c757d;
        /* Optional: Change the text color */
    }

    /* Center the 'Showing' text with pagination */
    .card-footer .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination {
        margin-bottom: 0;
    }

    .breadcrumb a {
        text-decoration: none;
    }

    .nav-link.active {
        background-color: #007bff;
        /* Màu nền khi active */
        color: #fff;
        /* Màu chữ khi active */
        border-radius: 5px;
        /* Bo góc nếu cần */
        font-weight: bold;
    }

    .nav-link.active i {
        color: #fff;
        /* Màu icon khi active */
    }
</style>