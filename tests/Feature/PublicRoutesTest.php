<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_public_routes_return_200(): void
    {
        $routes = [
            '/',
            '/conocernos',
            '/conocernos/que-es',
            '/conocernos/quienes-somos',
            '/conocernos/alianzas',
            '/que-hacemos',
            '/que-hacemos/educacion',
            '/que-hacemos/interculturalidad',
            '/proyectos',
            '/asociate',
            '/contacto',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }
}
