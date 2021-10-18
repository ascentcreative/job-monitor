<?php

namespace AscentCreative\JobMonitor;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;


class JobMonitorServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
   
    $this->mergeConfigFrom(
        __DIR__.'/../config/jobmonitor.php', 'jobmonitor'
    );

  }

  public function boot()
  {
      $this->bootComponents();

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'jobmonitor');

    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

  }

  

  // register the components
  public function bootComponents() {
        Blade::component('jobmonitor-progress', 'AscentCreative\JobMonitor\Components\MonitorProgress');
  }




  

    public function bootPublishes() {

      $this->publishes([
        __DIR__.'/Assets' => public_path('vendor/ascentcreative/geo'),
    
      ], 'public');

      $this->publishes([
        __DIR__.'/config/geo.php' => config_path('geo.php'),
      ]);

    }



}