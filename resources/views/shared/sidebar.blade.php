<div class="card">
   <div class="card-header">Menu</div>

   <div class="list-group list-group-flush">
      @if(auth()->user()->hasPermissionTo('View executive dashboard'))
      <a class="list-group-item list-group-item-action {{ (request()->is('home') ? 'active' : '') }}"
         href="{{ route('dashboard.home') }}">Overview</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View executive dashboard'))
      <a class="list-group-item list-group-item-action {{ (request()->is('executive.index') ? 'active' : '') }}"
         href="{{ route('executive.index') }}">Dashboard</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View operation dashboard'))
      <a class="list-group-item list-group-item-action {{ (request()->is('operation.index') ? 'active' : '') }}"
         href="{{ route('operation.index') }}">Op. Dashboard</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View activity'))
      <a class="list-group-item list-group-item-action {{ (request()->is('activity') ? 'active' : '') }}"
         href="{{ route('dashboard.activity') }}">Activity</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View groups'))
      <a class="list-group-item list-group-item-action {{ (request()->routeIs(['group.index', 'group.show', 'group.member']) ? 'active' : '') }}"
         href="{{ route('group.index') }}">Groups</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View marketplace'))
      <a class="list-group-item list-group-item-action {{ (request()->is('marketplace') ? 'active' : '') }}"
         href="{{ route('dashboard.marketplace') }}">Marketplace</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View feedback'))
      <a class="list-group-item list-group-item-action {{ (request()->is('feedback') ? 'active' : '') }}"
         href="{{ route('dashboard.feedback') }}">Feedback</a>
      @endif

      @isset ($menu)
      @foreach($menu as $url => $value)
      <a class="list-group-item list-group-item-action" href="{{ $url }}">{{ $value }}</a>
      @endforeach
      @endisset

      @if(auth()->user()->hasPermissionTo('View roles'))
      <a class="list-group-item list-group-item-action {{ (request()->is('roles') ? 'active' : '') }}"
         href="{{ route('roles.index') }}">Roles</a>
      @endif

      @if(auth()->user()->hasPermissionTo('View archived groups'))
      <a class="list-group-item list-group-item-action {{ (request()->is('archive') ? 'active' : '') }}"
         href="{{ route('group.archive') }}">Archive</a>
      @endif


      @if(auth()->user()->hasPermissionTo('View data bundles'))
      <a class="list-group-item list-group-item-action list-group-item-danger flex-column align-items-start {{ (request()->is('bundles') ? 'active' : '') }}"
         href="{{ route('bundles.index') }}">
         <div class="d-flex w-100 justify-content-between">
            <h6 class="mb-1">Data Bundles <small>(debug)</small></h6>
         </div>
      </a>
      @endif

   </div>
</div>