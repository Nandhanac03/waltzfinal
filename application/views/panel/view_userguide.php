<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Style for professional look -->
    <style>
        .userguide-container {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #334155;
        }
        .guide-sidebar {
            background: #f8fafc;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .guide-search-container {
            padding: 1.25rem;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
        }
        .guide-search-input {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            width: 100%;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        .guide-search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        .guide-list {
            max-height: 70vh;
            overflow-y: auto;
        }
        .guide-item {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
        }
        .guide-item:last-child {
            border-bottom: none;
        }
        .guide-link {
            padding: 1rem 1.25rem !important;
            display: flex !important;
            align-items: center;
            color: #475569 !important;
            font-weight: 500;
            border-radius: 0 !important;
        }
        .guide-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            opacity: 0.7;
        }
        .guide-link.active {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .guide-link.active i {
            opacity: 1;
        }
        .guide-link:hover:not(.active) {
            background: #eff6ff;
            color: #1e40af !important;
        }
        .guide-card {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
        }
        .guide-card-header {
            background: #fff;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .guide-card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        .guide-card-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            font-weight: 400;
        }
        .guide-card-body {
            padding: 2.5rem;
            line-height: 1.7;
            font-size: 1.05rem;
        }
        .guide-card-body h4 {
            font-weight: 700;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 0.5rem;
        }
        .guide-card-body ul, .guide-card-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        .guide-card-body li {
            margin-bottom: 0.75rem;
        }
        .tab-pane {
            animation: fadeIn 0.4s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Custom scrollbar */
        .guide-list::-webkit-scrollbar {
            width: 6px;
        }
        .guide-list::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .guide-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .guide-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" style="font-weight: 800; letter-spacing: -0.5px;">Userguide Library</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Userguide</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content userguide-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="guide-sidebar">
                        <div class="guide-search-container">
                            <input type="text" class="guide-search-input" id="guideSearch" placeholder="Search guides..." onkeyup="filterGuides()">
                        </div>
                        <div class="guide-list" id="guideNavList">
                            <ul class="nav flex-column nav-pills">
                                <?php if ($userguides) : foreach ($userguides as $index => $guide) : ?>
                                    <li class="guide-item">
                                        <a href="#guide-<?= $guide->id ?>" class="nav-link guide-link <?= $index == 0 ? 'active' : '' ?>" data-toggle="pill">
                                            <i class="fas fa-book-open"></i> <span><?= $guide->title ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="tab-content">
                        <?php if ($userguides) : foreach ($userguides as $index => $guide) : ?>
                            <div class="tab-pane <?= $index == 0 ? 'active' : '' ?>" id="guide-<?= $guide->id ?>">
                                <div class="guide-card">
                                    <div class="guide-card-header">
                                        <h2 class="guide-card-title"><?= $guide->title ?></h2>
                                        <?php if ($guide->subtitle) : ?>
                                            <p class="guide-card-subtitle"><?= $guide->subtitle ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="guide-card-body">
                                        <?= $guide->description ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; else: ?>
                            <div class="card card-body text-center p-5">
                                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                <h3 class="text-muted">No userguides found.</h3>
                                <p class="text-muted">Start by adding some guides in the management section.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
function filterGuides() {
    var input = document.getElementById("guideSearch");
    var filter = input.value.toLowerCase();
    var list = document.getElementById("guideNavList");
    var items = list.getElementsByClassName("guide-item");

    for (var i = 0; i < items.length; i++) {
        var span = items[i].getElementsByTagName("span")[0];
        var txtValue = span.textContent || span.innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}
</script>
