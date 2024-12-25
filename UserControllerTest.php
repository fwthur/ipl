<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman index menampilkan daftar user untuk admin.
     */
    public function test_admin_can_view_user_index()
    {
        // Arrange: Buat user dengan role admin
        $admin = User::factory()->create(['roles' => 'admin']);

        // Act: Akses route index sebagai admin
        $response = $this->actingAs($admin)->get(route('users.index'));

        // Assert: Pastikan halaman dapat diakses dan statusnya 200
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.users.index');
    }

    /**
     * Test user non-admin tidak bisa mengakses halaman index.
     */
    public function test_non_admin_cannot_view_user_index()
    {
        // Arrange: Buat user dengan role bukan admin
        $user = User::factory()->create(['roles' => 'user']);

        // Act: Akses route index sebagai non-admin
        $response = $this->actingAs($user)->get(route('users.index'));

        // Assert: Pastikan akses ditolak (403 Forbidden)
        $response->assertStatus(403);
    }

    /**
     * Test admin bisa menambahkan user baru.
     */
    public function test_admin_can_store_user()
    {
        // Arrange: Buat user admin
        $admin = User::factory()->create(['roles' => 'admin']);

        // Data user baru
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'roles' => 'user',
        ];

        // Act: Simulasikan penyimpanan user baru
        $response = $this->actingAs($admin)->post(route('users.store'), $userData);

        // Assert: Pastikan user baru tersimpan dan redirect sukses
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'Users Berhasil di tambahkan!');
    }

    /**
     * Test non-admin tidak bisa menambahkan user baru.
     */
    public function test_non_admin_cannot_store_user()
    {
        // Arrange: Buat user non-admin
        $user = User::factory()->create(['roles' => 'user']);

        // Data user baru
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'roles' => 'user',
        ];

        // Act: Coba simpan user sebagai non-admin
        $response = $this->actingAs($user)->post(route('users.store'), $userData);

        // Assert: Pastikan akses ditolak
        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', ['email' => 'johndoe@example.com']);
    }
}
