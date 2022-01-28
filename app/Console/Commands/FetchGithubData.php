<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Repository;
use Illuminate\Console\Command;
use Carbon\Carbon;

class FetchGithubData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Github users through Artisan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function makeRequest($url){
        $headers = [
            'Content-Type: application/json',
            'User-Agent:request',
            // 'Authorization:Token '
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responses = curl_exec($ch);
        return $responses;
    }
    public function handle()
    {
        $url = 'https://api.github.com/users';
        $responses = json_decode($this->makeRequest($url));
        foreach($responses as $response){
            $userData = json_decode($this->makeRequest($response->url));
            $repos = json_decode($this->makeRequest($userData->repos_url));
            $user = new User;
            $user->name = $userData->name?$userData->name:null;
            $user->github_id = $userData->id?$userData->id:null;
            $user->username=$userData->login?$userData->login:null;
            $user->location=$userData->location?$userData->location:null;
            $user->email=$userData->email?$userData->email:null;
            $user->followers=$userData->followers?$userData->followers:null;
            $user->following=$userData->following?$userData->following:null;
            $user->image = $userData->avatar_url?$userData->avatar_url:null;
            $user->joined_at = Carbon::createFromFormat('Y-m-d\TH:i:s+',$userData->created_at);
            $user->no_of_repository = count($repos);
            $user->save();
            foreach($repos as $repo){
                $userRepo = new Repository;
                $userRepo->repo_name = $repo->name?$repo->name:null;
                $userRepo->user_id = $user->id;
                $userRepo->forks=$repo->forks?$repo->forks:null;
                $userRepo->stars=$repo->watchers?$repo->watchers:null;
                $userRepo->save();
            }
        } 
        echo 'Data successfully saved to your database from github';
    }
}
