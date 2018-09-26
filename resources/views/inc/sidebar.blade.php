<nav class="col-md-2 d-none d-md-block bg-light sidebar pull-right" style="font-size: 20px" >
    <div class="sidebar-sticky ">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/home">
                    الرئيسية
                </a>
            </li>
            @if(!Auth::user()->isUser())
            <li class="nav-item">
                <a class="nav-link active" href="/categories">
                    <span data-feather="home"></span>
                    الفئات
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/objects">
                    <span data-feather="file"></span>
                    العناصر
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/regions">
                    <span data-feather="users"></span>
                    المناطق
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/streets">
                    <span data-feather="shopping-cart"></span>
                    الشوارع
                </a>
            </li>
            @if(Auth::user()->isAdmin())
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                </a>
            </h6>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    إضافة المشرفين
                </a>
            </li>
            @endif
            @endif
        </ul>

    </div>
</nav>