<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use App\Models\Tenant;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'domain' => 'required|string|max:255|unique:domains,domain',
        ])->validate();

        $this->createTenant($input);

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    protected function createTenant(array $input): void
    {
        $domain = $input['domain'];
        $tenant = Tenant::create();
        $tenant->domains()->create(['domain' => $domain]);
    
        $isDomain = Str::contains($domain, ".");
        if(!$isDomain) {
            $domain = $tenant->domain()->first()->domain . "." . env('CENTRAL_DOMAIN_NAME');
        }
    
        $tenant->run(function () use ($input) {
            $userTenant = User::create([
                'email' => $input['email'],
                'name' => $input['name'],
                'password' => Hash::make($input['password']),
            ]);
            $this->createTeam($userTenant);
            //Auth::login($userTenant, true);
        });
    }
}
