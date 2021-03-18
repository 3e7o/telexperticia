<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MedicalBoard;

use App\Models\Patient;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalBoardControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_medical_boards()
    {
        $medicalBoards = MedicalBoard::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('medical-boards.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_boards.index')
            ->assertViewHas('medicalBoards');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_medical_board()
    {
        $response = $this->get(route('medical-boards.create'));

        $response->assertOk()->assertViewIs('app.medical_boards.create');
    }

    /**
     * @test
     */
    public function it_stores_the_medical_board()
    {
        $data = MedicalBoard::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('medical-boards.store'), $data);

        $this->assertDatabaseHas('medical_boards', $data);

        $medicalBoard = MedicalBoard::latest('id')->first();

        $response->assertRedirect(route('medical-boards.edit', $medicalBoard));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_medical_board()
    {
        $medicalBoard = MedicalBoard::factory()->create();

        $response = $this->get(route('medical-boards.show', $medicalBoard));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_boards.show')
            ->assertViewHas('medicalBoard');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_medical_board()
    {
        $medicalBoard = MedicalBoard::factory()->create();

        $response = $this->get(route('medical-boards.edit', $medicalBoard));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_boards.edit')
            ->assertViewHas('medicalBoard');
    }

    /**
     * @test
     */
    public function it_updates_the_medical_board()
    {
        $medicalBoard = MedicalBoard::factory()->create();

        $patient = Patient::factory()->create();

        $data = [
            'date' => $this->faker->dateTime,
            'status' => 'Programado',
            'patient_id' => $patient->id,
        ];

        $response = $this->put(
            route('medical-boards.update', $medicalBoard),
            $data
        );

        $data['id'] = $medicalBoard->id;

        $this->assertDatabaseHas('medical_boards', $data);

        $response->assertRedirect(route('medical-boards.edit', $medicalBoard));
    }

    /**
     * @test
     */
    public function it_deletes_the_medical_board()
    {
        $medicalBoard = MedicalBoard::factory()->create();

        $response = $this->delete(
            route('medical-boards.destroy', $medicalBoard)
        );

        $response->assertRedirect(route('medical-boards.index'));

        $this->assertDeleted($medicalBoard);
    }
}
