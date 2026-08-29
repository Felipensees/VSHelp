<?php

namespace Database\Seeders;

use App\Models\InspectionSection;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'name' => 'INSPEÇÃO DE MONTAGEM',
                'sort_order' => 1,
                'items' => [
                    'Revestimento/Plotagem',
                    'Inspeção geral da estrutura (Pintura)',
                    'Inspeção geral da estrutura (Furos)',
                    'Logotipo Videosoft',
                ],
            ],

            [
                'name' => 'INSPEÇÃO MONITOR/TOUCH',
                'sort_order' => 2,
                'items' => [
                    'Monitor',
                    'Touch',
                ],
            ],

            [
                'name' => 'INSPEÇÃO EQUIPAMENTOS',
                'sort_order' => 3,
                'items' => [
                    'Pinpad - Fixação e funcionalidade',
                    'Impressora - Fixação e funcionalidade',
                    'Camera - Fixação e funcionalidade',
                    'Leitores - Fixação e funcionalidade',
                    'Caixa de som - Fixação e funcionalidade',
                    'Wireless / Pigtail - Fixação e funcionalidade',
                    'Led - Fixação e funcionalidade',
                    'CPU - Fixação e funcionalidade',
                    'Cooler - Fixação e funcionalidade',
                    'HUB / Extensor - Fixação e funcionalidade',
                    'Chave ON/OFF - Fixação e funcionalidade',
                    'Outros',
                ],
            ],

            [
                'name' => 'INSPEÇÃO PORTAS',
                'sort_order' => 4,
                'items' => [
                    'Portas - Fixação e funcionalidade',
                ],
            ],

            [
                'name' => 'INSPEÇÃO ASSISTÊNCIA',
                'sort_order' => 5,
                'items' => [
                    'Informações técnicas do totem',
                    'Sistema operacional',
                    'Licença operacional',
                    'Conexão Wireless',
                    'Conexão a cabo',
                    'TeamViewer',
                    'Zabbix',
                ],
            ],
        ];

        foreach ($sections as $sectionData) {
            $section = InspectionSection::updateOrCreate(
                [
                    'name' => $sectionData['name'],
                ],
                [
                    'sort_order' => $sectionData['sort_order'],
                    'active' => true,
                ]
            );

            foreach ($sectionData['items'] as $index => $itemName) {
                $section->items()->updateOrCreate(
                    [
                        'name' => $itemName,
                    ],
                    [
                        'sort_order' => $index + 1,
                        'active' => true,
                    ]
                );
            }
        }
    }
}