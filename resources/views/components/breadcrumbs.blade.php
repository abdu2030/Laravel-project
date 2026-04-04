{{-- Breadcrumbs Component: Navigation aid --}}
<nav {{ $attributes }}>
  <ul class="flex items-center gap-sm text-muted mb-md">
    <li>
      <a href="/">Home</a>
    </li>

    @foreach ($links as $label => $link)
      <li>&rarr;</li>
      <li>
        <a href="{{ $link }}">
          {{ $label }}
        </a>
      </li>
    @endforeach
  </ul>
</nav>