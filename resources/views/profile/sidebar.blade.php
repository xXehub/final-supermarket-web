{{-- gawe auth check --}}
@if (Auth::check())
    <div class="col-3 d-none d-md-block border-end">
        <div class="card-body">
            <h4 class="subheader">Settings Sidebar</h4>
            <div class="list-group list-group-transparent">
                <a href="{{ route('profile.index') }}"
                    class="list-group-item list-group-item-action d-flex align-items-center active">Profil Saya</a>
                {{-- <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">My
                    Notifications</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected
                    Apps</a>
                <a href="./settings-plan.html"
                    class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing
                    & Invoices</a> --}}
            </div>
            <h4 class="subheader mt-4">History</h4>
            <div class="list-group list-group-transparent">
                <a href="{{ route('profile.pembelian') }}" class="list-group-item list-group-item-action">Pembelian</a>
            </div>
        </div>
    </div>
@endif
