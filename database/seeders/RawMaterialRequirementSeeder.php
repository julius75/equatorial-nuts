<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use App\Models\RawMaterialRequirement;
use Illuminate\Database\Seeder;

class RawMaterialRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = count(RawMaterialRequirement::all());
        if ($count == 0){
            $rawMaterials = ['CASHEW NUTS', 'MACADAMIA NUTS', 'MAIZE', 'WHITE SORGHUM', 'SOYABEANS'];
            $requirements = [];
            foreach ($rawMaterials as $rawMaterial) {
                $material = RawMaterial::where('name', '=', $rawMaterial)->first();
                if ($material){
                    if ($material->name == 'CASHEW NUTS')
                    {
                        $requirements = [
                            [
                                'parameter'=>'Mould',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Insect Damage',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Immature',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Moisture Content',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>8,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Count Per Kilo',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>199,
                                'unit'=>'nuts',
                            ],[
                                'parameter'=>'Physical Appearance',
                                'type'=>'text',
                                'value'=>'MIN',
                                'requirement'=>'Fresh as possible, smooth surface which is green to jungle green colour and clean(should not have attached apple, soil, stones or any other foreign matter )',
                                'unit'=>null,
                            ]];
                    }
                    if ($material->name == 'MACADAMIA NUTS')
                    {
                        $requirements = [
                            [
                                'parameter'=>'Macadamia shells with adhering husk/hull ',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>null,
                            ],[
                                'parameter'=>'Unopened cracks',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>null,
                            ],[
                                'parameter'=>'Living pests',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>null,
                            ],[
                                'parameter'=>'Good Quality',
                                'type'=>'percentage',
                                'value'=>'MIN',
                                'requirement'=>75,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Mould',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Foreign smell and/or taste (Rancidity)',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>null,
                            ],[
                                'parameter'=>'Immature-Shrunken or shrivelled kernel.',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>10,
                                'unit'=>'%',
                            ], [
                                'parameter'=>'Insect Damage',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>10,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Size tolerances: Minimum size 19.0 mm diameter',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3,
                                'unit'=>'%',
                            ],
                        ];
                    }
                    if ($material->name == 'MAIZE')
                    {
                        $requirements = [
                            [
                                'parameter'=>'Foreign Matter %',
                                'type'=>'percentage',
                                'value'=>'MIN',
                                'requirement'=>1.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Inorganic matter %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>0.5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Broken Kernels %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>4.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Pest damaged  grains %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3.0,
                                'unit'=>'%',
                            ], [
                                'parameter'=>'Rotten and Diseased grains %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>4.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Discoloured grains %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>1.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Moisture %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>13.5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Immature /shriveled %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Filth %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>0.1,
                                'unit'=>'%',
                            ],
                        ];
                    }
                    if ($material->name == 'WHITE SORGHUM')
                    {
                        $requirements = [
                            [
                                'parameter'=>'VARIETY',
                                'type'=>'text',
                                'value'=>null,
                                'requirement'=>'WHITE VARIETY - GADAM, SILA',
                                'unit'=>null,
                            ],[
                                'parameter'=>'BUSHEL WEIGHT (Minimum)',
                                'type'=>'integer',
                                'value'=>'MIN',
                                'requirement'=>67,
                                'unit'=>'kg/hl',
                            ],[
                                'parameter'=>'TANNINS(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>0.5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'MOISTURE CONTENT (Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>13.0,
                                'unit'=>'%',
                            ], [
                                'parameter'=>'FOREIGN MATTER(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'INFESTATION',
                                'type'=>'text',
                                'value'=>'MAX',
                                'requirement'=>'Absent',
                                'unit'=>null,
                            ],[
                                'parameter'=>'HEAT DAMAGE',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>0.2,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'OTHER GRAINS(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'EARTH,SAND AND STONES(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'SPROUTED GRAINS(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'INSECT DAMAGE(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'TRASH(2MM SCREEN TAILS)-Max',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>10,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'SCREENING(2MM SCREEN) THROUGH(Max)',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>20,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'MOULDY GRAINS',
                                'type'=>'text',
                                'value'=>'MAX',
                                'requirement'=>'Absent',
                                'unit'=>null,
                            ],[
                                'parameter'=>'AFLATOXIN (MAX)',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>5,
                                'unit'=>'PPB',
                            ],[
                                'parameter'=>'PROTEIN (DMB)',
                                'type'=>'integer',
                                'value'=>'MIN',
                                'requirement'=>7.0,
                                'unit'=>null,
                            ],[
                                'parameter'=>'OIL %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>4.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'FIBRE %',
                                'type'=>'percentage',
                                'value'=>'MIN',
                                'requirement'=>3.5,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'ASH %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>1.5,
                                'unit'=>'%',
                            ]
                        ];
                    }
                    if ($material->name == 'SOYABEANS')
                    {
                        $requirements = [
                            [
                                'parameter'=>'Contamination',
                                'type'=>'text',
                                'value'=>'MAX',
                                'requirement'=>'Absent',
                                'unit'=>null,
                            ],[
                                'parameter'=>'Moisture Content %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>10,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Ash Content %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Protein %',
                                'type'=>'percentage',
                                'value'=>'MIN',
                                'requirement'=>38.0,
                                'unit'=>'%',
                            ], [
                                'parameter'=>'Lipid Oil Content',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>18.0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Shape',
                                'type'=>'text',
                                'value'=>null,
                                'requirement'=>'Spherical',
                                'unit'=>null,
                            ],[
                                'parameter'=>'Packaging',
                                'type'=>'text',
                                'value'=>'MIN',
                                'requirement'=>'Clean & Good quality sacks',
                                'unit'=>null,
                            ],[
                                'parameter'=>'Shelf Life',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>6,
                                'unit'=>'months',
                            ],[
                                'parameter'=>'Foreign Matter %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>2,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Insect Damage %',
                                'type'=>'percentage',
                                'value'=>'MAX',
                                'requirement'=>3,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Infestation',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'Mould',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>0,
                                'unit'=>'%',
                            ],[
                                'parameter'=>'AFLATOXIN',
                                'type'=>'integer',
                                'value'=>'MAX',
                                'requirement'=>5,
                                'unit'=>'PPB',
                            ],
                        ];
                    }
                    if (count($requirements) > 0){
                        foreach ($requirements as $requirement){
                            $material->raw_material_requirements()->create($requirement);
                        }
                    }
                }
            }
        }
    }
}
