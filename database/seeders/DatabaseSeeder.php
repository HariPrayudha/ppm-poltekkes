<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ContactSeeder::class,
            GreetingSeeder::class,
            OrganizationProfileSeeder::class,
            ServiceSeeder::class,
            RelatedLinkSeeder::class,
            BannerSeeder::class,
            DocumentCategorySeeder::class,
            DocumentSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
