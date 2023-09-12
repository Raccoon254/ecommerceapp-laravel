<!-- TOP HEADER -->
<div id="top-header">
    <div class="container">
        <ul class="header-links pull-left">
            <li><a href="#"><i class="fa fa-phone"></i> {{ config('app.contact') }}</a></li>
			<li><a href="#"><i class="fa fa-envelope-o"></i> {{ config('app.email') }}</a></li>
			<li><a href="#"><i class="fa fa-map-marker"></i> {{ config('app.address') }}</a></li>
        </ul>
        <ul class="header-links pull-right">
            <li><a href="#"><i class="fa fa-coins"></i> {{ config('app.currency') }}</a></li>
            <li>
                @if (Auth::check())
                    <a href="{{ route('account') }}"><i class="fa fa-user-o"></i>
                        @if( Auth::user()->isAdmin())
                            <i class="fa-solid fa-crown"></i>
                            Admin Center
                        @else
                            User Account
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login </a>
                @endif

            </li>
        </ul>
    </div>
</div>
<!-- /TOP HEADER -->
