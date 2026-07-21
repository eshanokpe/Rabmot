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
                            Settings
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    <div class="col-12">
                        @if(session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var successAlert = document.getElementById('success-alert');
                                if (successAlert) {
                                    setTimeout(function() {
                                        successAlert.style.display = 'none';
                                    }, 10000);
                                }
                            });
                        </script>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tab-general" class="nav-link active" data-bs-toggle="tab">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-email" class="nav-link" data-bs-toggle="tab">Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-sms-whatsapp" class="nav-link" data-bs-toggle="tab">SMS &amp; WhatsApp</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-currency-timezone" class="nav-link" data-bs-toggle="tab">Currency &amp; Timezone</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-commission" class="nav-link" data-bs-toggle="tab">Commission</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-maintenance" class="nav-link" data-bs-toggle="tab">Maintenance Mode</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active show" id="tab-general">
                                        <h4>General Settings</h4>
                                        <p class="text-muted">Record-keeping values for the site. Not yet displayed elsewhere in the app.</p>
                                        <form method="POST" action="{{ route('admin.settings.updateGeneral') }}" class="row">
                                            @csrf
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Site Name</label>
                                                <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings->site_name) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Support Email</label>
                                                <input type="email" name="support_email" class="form-control" value="{{ old('support_email', $settings->support_email) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Support Phone</label>
                                                <input type="text" name="support_phone" class="form-control" value="{{ old('support_phone', $settings->support_phone) }}"/>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save General Settings</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-email">
                                        <h4>Email Settings</h4>
                                        <p class="text-muted">Controls the "From" address/name used on every outgoing system email. Leave blank to keep using the default (info@rabmotlicensing.com / Rabmot Licensing Agency).</p>
                                        <form method="POST" action="{{ route('admin.settings.updateEmail') }}" class="row">
                                            @csrf
                                            <div class="mb-3 col-6">
                                                <label class="form-label">From Address</label>
                                                <input type="email" name="mail_from_address" class="form-control" value="{{ old('mail_from_address', $settings->mail_from_address) }}" placeholder="info@rabmotlicensing.com"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">From Name</label>
                                                <input type="text" name="mail_from_name" class="form-control" value="{{ old('mail_from_name', $settings->mail_from_name) }}" placeholder="Rabmot Licensing Agency"/>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Email Settings</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-sms-whatsapp">
                                        <h4>SMS Provider</h4>
                                        <p class="text-muted">Credential storage only — no SMS provider is integrated yet, so nothing sends using these values today.</p>
                                        <form method="POST" action="{{ route('admin.settings.updateSms') }}" class="row mb-4">
                                            @csrf
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Provider Name</label>
                                                <input type="text" name="sms_provider" class="form-control" value="{{ old('sms_provider', $settings->sms_provider) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Sender ID</label>
                                                <input type="text" name="sms_sender_id" class="form-control" value="{{ old('sms_sender_id', $settings->sms_sender_id) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">API Key</label>
                                                <input type="password" name="sms_api_key" class="form-control" autocomplete="off" placeholder="{{ $settings->sms_api_key ? '•••••••• (leave blank to keep current)' : '' }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">API Secret</label>
                                                <input type="password" name="sms_api_secret" class="form-control" autocomplete="off" placeholder="{{ $settings->sms_api_secret ? '•••••••• (leave blank to keep current)' : '' }}"/>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save SMS Settings</button>
                                            </div>
                                        </form>

                                        <hr>

                                        <h4>WhatsApp API</h4>
                                        <p class="text-muted">Credential storage only — no WhatsApp integration exists yet, so nothing sends using these values today.</p>
                                        <form method="POST" action="{{ route('admin.settings.updateWhatsapp') }}" class="row">
                                            @csrf
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Phone Number ID</label>
                                                <input type="text" name="whatsapp_phone_number_id" class="form-control" value="{{ old('whatsapp_phone_number_id', $settings->whatsapp_phone_number_id) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Business Account ID</label>
                                                <input type="text" name="whatsapp_business_account_id" class="form-control" value="{{ old('whatsapp_business_account_id', $settings->whatsapp_business_account_id) }}"/>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">API Token</label>
                                                <input type="password" name="whatsapp_api_token" class="form-control" autocomplete="off" placeholder="{{ $settings->whatsapp_api_token ? '•••••••• (leave blank to keep current)' : '' }}"/>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save WhatsApp Settings</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-currency-timezone">
                                        <h4>Currency</h4>
                                        <p class="text-muted">Record-keeping only — the ₦ symbol used throughout the site is not yet driven by this value.</p>
                                        <form method="POST" action="{{ route('admin.settings.updateCurrency') }}" class="row mb-4">
                                            @csrf
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Currency Code</label>
                                                <input type="text" name="currency_code" maxlength="3" class="form-control" value="{{ old('currency_code', $settings->currency_code) }}" required/>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Currency Symbol</label>
                                                <input type="text" name="currency_symbol" class="form-control" value="{{ old('currency_symbol', $settings->currency_symbol) }}" required/>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Currency</button>
                                            </div>
                                        </form>

                                        <hr>

                                        <h4>Timezone</h4>
                                        <p class="text-muted">Applies application-wide (affects all date/time display and calculations).</p>
                                        <form method="POST" action="{{ route('admin.settings.updateTimezone') }}" class="row">
                                            @csrf
                                            <div class="mb-3 col-6">
                                                <label class="form-label required">Timezone</label>
                                                <select name="timezone" class="form-select" required>
                                                    @foreach (timezone_identifiers_list() as $tz)
                                                        <option value="{{ $tz }}" {{ old('timezone', $settings->timezone) === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Timezone</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-commission">
                                        <h4>Commission Defaults</h4>
                                        <p class="text-muted">Commission configuration (base rate, tiers, overrides, audit log) has its own dedicated module.</p>
                                        <div class="card card-sm bg-light mb-3">
                                            <div class="card-body">
                                                <p class="mb-0"><strong>Current Base Commission Rate:</strong> {{ $commissionSetting->rate ?? '—' }}%</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.commission.index') }}" class="btn btn-outline-primary">Manage Commission Settings</a>
                                    </div>

                                    <div class="tab-pane" id="tab-maintenance">
                                        <h4>Maintenance Mode</h4>
                                        <p class="text-muted">Puts the public-facing site into maintenance mode. The admin panel stays fully accessible so you can turn it back off.</p>

                                        <div class="mb-3">
                                            @if ($isDown)
                                                <span class="badge text-bg-danger">Currently DOWN for maintenance</span>
                                            @else
                                                <span class="badge text-bg-success">Site is live</span>
                                            @endif
                                        </div>

                                        @if (!$isDown)
                                            <form method="POST" action="{{ route('admin.settings.maintenance.enable') }}" class="row" onsubmit="return confirm('This will take the public site down for all visitors. Are you sure you want to enable maintenance mode?');">
                                                @csrf
                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Maintenance Message (optional)</label>
                                                    <textarea name="maintenance_message" class="form-control" rows="2">{{ old('maintenance_message', $settings->maintenance_message) }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-danger">Enable Maintenance Mode</button>
                                                </div>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.settings.maintenance.disable') }}" onsubmit="return confirm('This will bring the public site back online. Are you sure?');">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Disable Maintenance Mode</button>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
