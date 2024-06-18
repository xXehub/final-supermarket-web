{{-- gawe auth check --}}
@if (Auth::check())
    <div class="col-3 d-none d-md-block border-end">
        <div class="card-body">
            <h4 class="subheader">Settings Sidebar</h4>
            <div class="list-group list-group-transparent">
                <a href="{{ route('profile.index') }}"
                    class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('profile.index') ? 'active' : '' }}">Profil
                    Saya</a>
                {{-- <a href="#" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('notifications.index') ? 'active' : '' }}">My Notifications</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('connected-apps.index') ? 'active' : '' }}">Connected Apps</a>
                <a href="./settings-plan.html"
                    class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('plans.index') ? 'active' : '' }}">Plans</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('billing.index') ? 'active' : '' }}">Billing & Invoices</a> --}}
            </div>
            <h4 class="subheader mt-4">History</h4>
            <div class="list-group list-group-transparent">
                <a href="{{ route('profile.pembelian') }}"
                    class="list-group-item list-group-item-action {{ request()->routeIs('profile.pembelian') ? 'active' : '' }}">Pembelian</a>
            </div>
        </div>

    </div>
@endif
