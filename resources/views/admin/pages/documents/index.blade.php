@extends('admin.layouts.app')

@section('title', 'Document Process')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Document Process</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @foreach(['success' => 'success', 'error' => 'danger'] as $flash => $style)
                @if(session($flash))
                    <div class="alert alert-{{ $style }} alert-dismissible fade show" role="alert">
                        {{ session($flash) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="document-tabs">
                        @foreach(['' => 'All Documents'] + collect($statuses)->mapWithKeys(fn ($status) => [$status['key'] => $status['label']])->all() as $key => $label)
                            <li class="nav-item">
                                <a href="{{ route('admin.documents.index', array_filter(['status' => $key, 'search' => $search])) }}"
                                    class="nav-link {{ ($statusKey ?? '') === $key ? 'active' : '' }}" data-status="{{ $key }}">
                                    {{ $label }}
                                    <span class="badge bg-secondary-lt ms-2">{{ $counts[$key ?: 'all'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body border-bottom py-3">
                    <form method="GET" action="{{ route('admin.documents.index') }}" id="document-search" class="d-flex gap-2" style="max-width: 520px">
                        <input type="hidden" name="status" value="{{ $statusKey }}" />
                        <input type="search" name="search" class="form-control" placeholder="Search process ID or customer email"
                            value="{{ $search }}" />
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </form>
                </div>
                <div id="document-table">
                    @include('admin.pages.documents._table')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tabs, search and pagination reload only the table, and keep the URL in
    // sync so refresh / back / sharing a link land on the same view.
    (function () {
        const table = document.getElementById('document-table');
        const tabs = document.querySelectorAll('#document-tabs [data-status]');
        const searchForm = document.getElementById('document-search');

        function load(url, push) {
            table.style.opacity = '0.5';
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (res) { if (!res.ok) throw new Error(res.status); return res.text(); })
                .then(function (html) {
                    table.innerHTML = html;
                    table.style.opacity = '';
                    if (push) history.pushState(null, '', url);
                    syncControls(new URL(url, window.location.href));
                })
                .catch(function () { window.location.href = url; });
        }

        function syncControls(url) {
            const status = url.searchParams.get('status') || '';
            const search = url.searchParams.get('search') || '';
            tabs.forEach(function (tab) {
                tab.classList.toggle('active', tab.dataset.status === status);
                const tabUrl = new URL(tab.href);
                search ? tabUrl.searchParams.set('search', search) : tabUrl.searchParams.delete('search');
                tab.href = tabUrl.toString();
            });
            searchForm.elements.status.value = status;
            searchForm.elements.search.value = search;
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function (event) {
                event.preventDefault();
                load(tab.href, true);
            });
        });

        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const url = new URL(searchForm.action);
            new FormData(searchForm).forEach(function (value, key) { if (value) url.searchParams.set(key, value); });
            load(url.toString(), true);
        });

        table.addEventListener('click', function (event) {
            const link = event.target.closest('.pagination a');
            if (link) {
                event.preventDefault();
                load(link.href, true);
            }
        });

        window.addEventListener('popstate', function () { load(window.location.href, false); });
    })();
</script>
@endsection
