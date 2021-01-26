<?php

namespace Database\Seeders;

use App\Models\GroupUser;
use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Domain;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Group;
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
        Organization::truncate();
        Company::truncate();
        User::truncate();
        Contact::truncate();
        Group::truncate();
        GroupUser::truncate();

        $accounts = Group::create(['name' => 'accounts']);
        $support = Group::create(['name' => 'support']);
        $sales = Group::create(['name' => 'sales']);

        $org = Organization::create([
            'name' => 'ASG Communications'
        ]);

        $company = Company::create([
            'organization_id' => $org->id,
            'name' => 'ASG Communications',
            'address' => '1/48 Lillian Ave',
            'suburb' => 'Salisbury',
            'state' => 'QLD',
            'postcode' => '4107',
            'phone' => '07 3277 3636'
        ]);

        $org->head_office_id = $company->id;
        $org->save();

        $user = User::create([
            'email' => 'shane@alphasg.com.au',
            'email_verified_at' => now(),
            'first_name' => 'Shane',
            'last_name' => 'Poppleton',
            'mobile' => '0400 588 588',
            'password' => Hash::make('secret'),
            'company_id' => $company->id,
            'remember_token' => \Str::random(10),
            'api_token' => \Str::random(60)
        ]);

        $user->groups()->attach([$accounts->id, $support->id]);


        Organization::factory(10)->create();
        Organization::each(function ($org) {
            Domain::factory(mt_rand(1, 3))->create(['organization_id' => $org->id]);
            Company::factory(mt_rand(1, 5))->create(['organization_id' => $org->id]);
        });

        Company::each(function ($company) {
            Contact::factory(mt_rand(1, 5))->create(['company_id' => $company->id]);
            User::factory()->create(['company_id' => $company->id]);
        });

        User::each(fn($user) => User::inRandomOrder()
            ->where('id', '!=', $user->id)
            ->limit(mt_rand(1, 5))
            ->each(fn($recipient) => Message::factory(mt_rand(1, 3))->create([
                'from_user_id' => $user->id,
                'to_user_id' => $recipient->id
            ])
            )
        );
    }
}
