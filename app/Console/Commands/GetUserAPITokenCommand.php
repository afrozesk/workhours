<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Class GetUserAPITokenCommand.
 */
class GetUserAPITokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'base_user:api_token';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(): void
    {
        /** @var string $userEmail */
        $userEmail = env('USER_EMAIL');

        /** @var string $userPassword */
        $userPassword = env('USER_PWD');

        /** @var User $user */
        $user = User::query()->where('email', $userEmail)->firstOrFail();

        /** @var string|null $apiToken */
        $apiToken = null;

        if (
            Hash::check(
                $userPassword,
                $user->getAuthPassword()
            )
        ) {
            $apiToken = Hash::make(
                $userEmail . $user->password . env('APP_KEY')
            );

            $user->api_token = $apiToken;
            $user->save();
        }

        // Return api token
        if ($apiToken) {
            $this->output->success("API Token: {$apiToken}");

            return;
        }

        $this->output->error("User not found!");
    }
}
