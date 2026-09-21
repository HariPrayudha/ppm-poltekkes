<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Kebijakan Mutu',
            'Manual Mutu',
            'Standar Mutu',
            'Prosedur Operasional Standar (SOP)',
            'Formulir Mutu',
        ];

        foreach ($categories as $name) {
            DocumentCategory::updateOrCreate(
                ['name' => $name]
            );
        }
    }
}
