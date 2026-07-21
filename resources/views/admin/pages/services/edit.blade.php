@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Edit Service
                            @if ($item->status === 'active')
                                <span class="badge text-bg-success">Active</span>
                            @else
                                <span class="badge text-bg-secondary">Inactive</span>
                            @endif
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Service</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-12 mt-2 ps-2">
                                <form class="form-fieldset" method="POST" action="{{ route('admin.services.update', ['id' => encrypt($item->id)]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Service Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Price (NGN)</label>
                                            <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $item->price) }}" required/>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
                                        </div>

                                        <div class="mb-3 col-4">
                                            <label class="form-label required">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="active" {{ old('status', $item->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $item->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label">Commission Rate Override (%)</label>
                                            <input type="number" step="0.01" min="0" max="100" name="commission_rate_override" class="form-control" value="{{ old('commission_rate_override', $item->commission_rate_override) }}"/>
                                            <small class="form-hint">Leave blank to use the agent's normal resolved commission rate.</small>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label">Effective Date</label>
                                            <input type="date" name="effective_date" class="form-control" value="{{ old('effective_date', $item->effective_date ? $item->effective_date->format('Y-m-d') : '') }}"/>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" name="commission_eligible" value="1" {{ old('commission_eligible', $item->commission_eligible) ? 'checked' : '' }}>
                                                <span class="form-check-label">This service is eligible for agent referral commission</span>
                                            </label>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <button type="submit" class="btn btn-primary ms-auto">Update Service</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
