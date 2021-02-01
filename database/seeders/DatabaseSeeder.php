<?php

namespace Database\Seeders;

use App\Models\Bug;
use App\Models\BugStatus;
use App\Models\GroupUser;
use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Domain;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Organization::truncate();
        Company::truncate();
        User::truncate();
        Contact::truncate();
        Group::truncate();
        GroupUser::truncate();
        Bug::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create groups
        $accounts = Group::create(['name' => 'accounts']);
        $support = Group::create(['name' => 'support']);
        $sales = Group::create(['name' => 'sales']);

    
        // Setup default Organization and Company
        $org = Organization::create([
            'id' => 1,
            'name' => 'Unassigned Organization'
        ]);

        $company = Company::create([
            'id' => 1,
            'organization_id' => $org->id,
            'name' => 'Unassigned Company',
        ]);

        $org->head_office_id = $company->id;
        $org->save();


        // Setup Alpha IT Centre
        $ait_org = Organization::create([
            'name' => 'Alpha IT Centre'
        ]);

        $ait = Company::create([
            'organization_id' => $ait_org->id,
            'name' => 'Alpha IT Centre',
            'address' => '1/48 Lillian Ave',
            'suburb' => 'Salisbury',
            'state' => 'QLD',
            'postcode' => '4107',
            'phone' => '07 3277 3636'
        ]);

        $ait_org->head_office_id = $ait->id;
        $ait_org->save();

        $shane = User::create([
            'email' => 'shane@alphasg.com.au',
            'email_verified_at' => now(),
            'first_name' => 'Shane',
            'last_name' => 'Poppleton',
            'mobile' => '0400 588 588',
            'password' => Hash::make('secret'),
            'company_id' => $ait->id,
            'is_admin' => true,
            'remember_token' => \Str::random(10),
            'api_token' => \Str::random(60)
        ]);

        $shane->groups()->attach([$support->id]);

        $len = User::create([
            'email' => 'len@alphasg.com.au',
            'email_verified_at' => now(),
            'first_name' => 'Len',
            'last_name' => 'Groves',
            'mobile' => '0438 711 559',
            'password' => Hash::make('secret'),
            'company_id' => $ait->id,
            'remember_token' => \Str::random(10),
            'api_token' => \Str::random(60)
        ]);
        $len->groups()->attach([$sales->id, $support->id]);

        $theresa = User::create([
            'email' => 'theresa@alphasg.com.au',
            'email_verified_at' => now(),
            'first_name' => 'Theresa',
            'last_name' => 'Groves',
            'mobile' => '0438 717 559',
            'password' => Hash::make('secret'),
            'company_id' => $ait->id,
            'remember_token' => \Str::random(10),
            'api_token' => \Str::random(60)
        ]);
        $theresa->groups()->attach([$accounts->id, $support->id]);

        $shane->bugs()->create([
            'title' => 'bug view dialog doesn\'t work',
            'content' => 'go to the bug page and it shows up with no text on it'
        ]);
    }
}
