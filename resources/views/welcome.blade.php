<h1>User Information</h1>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<h2>Teams (via getTenants method)</h2>
<ul>
    @foreach ($user_tenants as $tenant)
        <li>{{ $tenant->name }}</li>
    @endforeach
</ul>

<h2>Teams (via teams method)</h2>
<ul>
    @foreach ($teams as $team)
        <li>{{ $team->name }} (ID: {{ $team->id }})</li>
    @endforeach
</ul>

<h2>Can Access First Tenant</h2>
<p>{{ $canAccessTenant ? 'Yes' : 'No' }}</p>

<h2>Can Access Panel</h2>
<p>{{ $canAccessPanel ? 'Yes' : 'No' }}</p>

<h2> Teams </h2>
<p> {{ $teams }}</p>
