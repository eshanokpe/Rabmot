<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UnifiedDocumentsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_view_all_documents_and_service_tabs(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);

        $this->get(route('admin.processtype.index'))
            ->assertOk()
            ->assertViewIs('admin.pages.processType.documents')
            ->assertSee('All Services')
            ->assertSee('Vehicle Licence Renewal')
            ->assertSee('New Vehicle Registration')
            ->assertSee('Change of Ownership')
            ->assertSee("New Driver&#039;s Licence", false)
            ->assertSee("Driver&#039;s Licence Renewal", false)
            ->assertSee("International Driver&#039;s Licence", false)
            ->assertSee('Last Plate Number')
            ->assertSee('Other Permits');
    }

    public function test_existing_service_list_routes_open_the_unified_documents_page_on_their_tab(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);

        $this->get(route('admin.processVehiclePaperRenewal'))
            ->assertRedirect(route('admin.processtype.index', ['service' => 'vehicle_licence_renewal']));
    }
}
