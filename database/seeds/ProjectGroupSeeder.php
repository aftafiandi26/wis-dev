<?php


use App\ProjectGroup;
use Illuminate\Database\Seeder;

class ProjectGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectGroup::create([
            'group_name'    => 'SPK',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'LWL',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'ATTBU',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'GOD',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'KMG',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'OLI',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'RDS',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'UCA',
            'active'        => true,
        ]);

        ProjectGroup::create([
            'group_name'    => 'WHY',
            'active'        => true,
        ]);
    }
}