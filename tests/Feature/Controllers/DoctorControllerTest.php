<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Doctor;

use App\Models\Specialty;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorControllerTest extends TestCase
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
    public function it_displays_index_view_with_doctors()
    {
        $doctors = Doctor::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('doctors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.doctors.index')
            ->assertViewHas('doctors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_doctor()
    {
        $response = $this->get(route('doctors.create'));

        $response->assertOk()->assertViewIs('app.doctors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_doctor()
    {
        $data = Doctor::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('doctors.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('doctors', $data);

        $doctor = Doctor::latest('id')->first();

        $response->assertRedirect(route('doctors.edit', $doctor));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_doctor()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('doctors.show', $doctor));

        $response
            ->assertOk()
            ->assertViewIs('app.doctors.show')
            ->assertViewHas('doctor');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_doctor()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('doctors.edit', $doctor));

        $response
            ->assertOk()
            ->assertViewIs('app.doctors.edit')
            ->assertViewHas('doctor');
    }

    /**
     * @test
     */
    public function it_updates_the_doctor()
    {
        $doctor = Doctor::factory()->create();

        $user = User::factory()->create();
        $specialty = Specialty::factory()->create();

        $data = [
            'ci' => $this->faker->text(255),
            'name' => $this->faker->name,
            'first_surname' => $this->faker->text(255),
            'last_surname' => $this->faker->text(255),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'user_id' => $user->id,
            'specialty_id' => $specialty->id,
        ];

        $response = $this->put(route('doctors.update', $doctor), $data);

        unset($data['user_id']);

        $data['id'] = $doctor->id;

        $this->assertDatabaseHas('doctors', $data);

        $response->assertRedirect(route('doctors.edit', $doctor));
    }

    /**
     * @test
     */
    public function it_deletes_the_doctor()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->delete(route('doctors.destroy', $doctor));

        $response->assertRedirect(route('doctors.index'));

        $this->assertDeleted($doctor);
    }
}
