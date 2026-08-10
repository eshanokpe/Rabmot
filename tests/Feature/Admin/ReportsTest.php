<?php

namespace Tests\Feature\Admin;

use App\Models\PaymentModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReportsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_finance_admin_can_view_all_four_report_pages(): void
    {
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $this->get(route('admin.reports.revenue'))->assertOk();
        $this->get(route('admin.reports.orders'))->assertOk();
        $this->get(route('admin.reports.agentPerformance'))->assertOk();
        $this->get(route('admin.reports.referrals'))->assertOk();
    }

    public function test_role_outside_reports_area_is_denied(): void
    {
        // Every one of the 4 canonical roles has at least view-reports access,
        // so this uses a role deliberately absent from config/admin_permissions.php
        // to prove the gate restricts by role rather than failing open.
        $this->actingAsAdmin(['role' => 'unlisted_role']);

        $response = $this->get(route('admin.reports.revenue'));

        $response->assertForbidden();
    }

    public function test_revenue_totals_match_raw_payment_sum(): void
    {
        PaymentModel::factory()->count(3)->create(['status' => 'Successful', 'amount' => 10000]);
        PaymentModel::factory()->create(['status' => 'Failed', 'amount' => 99999]);
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $response = $this->get(route('admin.reports.revenue'));

        $response->assertOk();
        $expectedTotal = PaymentModel::where('status', 'Successful')->sum('amount');
        $response->assertViewHas('totalRevenue', fn ($total) => (float) $total === (float) $expectedTotal);
    }

    public function test_csv_export_returns_parseable_rows(): void
    {
        PaymentModel::factory()->count(2)->create(['status' => 'Successful']);
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $response = $this->get(route('admin.reports.export', ['report' => 'revenue', 'format' => 'csv']));

        $response->assertOk();
        $this->assertStringStartsWith('text/csv', $response->headers->get('content-type'));
        $rows = array_filter(explode("\n", $response->streamedContent()));
        $this->assertGreaterThanOrEqual(3, count($rows)); // header + 2 payments
        $this->assertNotFalse(str_getcsv($rows[0]));
    }

    public function test_pdf_export_returns_pdf_bytes(): void
    {
        PaymentModel::factory()->create(['status' => 'Successful']);
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $response = $this->get(route('admin.reports.export', ['report' => 'revenue', 'format' => 'pdf']));

        $response->assertOk();
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }
}
