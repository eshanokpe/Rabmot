<?php

namespace Tests\Feature\Admin;

use App\Models\PaymentModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionDateFilterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_transaction_history_can_be_filtered_by_a_start_and_end_date(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);

        $included = PaymentModel::create([
            'process_id' => 'IN-RANGE-001',
            'orderNo' => 'IN-RANGE-ORDER-001',
            'email' => 'included@example.test',
            'amount' => 125,
        ]);
        $included->created_at = '2026-10-05 13:15:00';
        $included->save();

        $excluded = PaymentModel::create([
            'process_id' => 'OUT-OF-RANGE-001',
            'orderNo' => 'OUT-OF-RANGE-ORDER-001',
            'email' => 'excluded@example.test',
            'amount' => 250,
        ]);
        $excluded->created_at = '2026-10-11 00:00:00';
        $excluded->save();

        $this->get(route('admin.transactions', [
            'date_from' => '2026-10-01',
            'date_to' => '2026-10-10',
        ]))
            ->assertOk()
            ->assertSee('IN-RANGE-001')
            ->assertDontSee('OUT-OF-RANGE-001');
    }

    public function test_transaction_date_range_rejects_an_end_date_before_the_start_date(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);

        $this->get(route('admin.transactions', [
            'date_from' => '2026-10-10',
            'date_to' => '2026-10-01',
        ]))->assertSessionHasErrors('date_to');
    }
}
