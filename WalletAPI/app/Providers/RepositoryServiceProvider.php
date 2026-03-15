<?php

namespace App\Providers;

use App\Repository\Interfaces\UserRepoInterface;
use App\Repository\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{

  public function register():void
  {
    $this->app->bind(UserRepoInterface::class,UserRepo::class);

  }

  public function boot(){

  }
}