<?php

namespace App\Console\Commands\Env;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class Encrypt extends Command
{
    protected $signature = 'env:encrypt {env=all} {key?} {--delete}';

    protected $description = 'Encrypt environment variable file';

    protected $environments = [
        'develop',
        'production',
    ];

    protected $key;

    public function handle()
    {
        $env = $this->argument('env');
        $this->key = $this->argument('key');
        $delete = $this->option('delete');

        if(empty($this->key)) {
            $this->key = Decrypt::getKeyFileContents();
        }

        if(!empty($env) && $env !== 'all') {
            $this->encrypt($env, $delete);
        } else {
            foreach ($this->environments as $env) {
                $this->encrypt($env, $delete);
            }
        }
    }

    protected function encrypt($env, $delete = false)
    {
        $crypt = new Encrypter($this->key, 'AES-256-CBC');

        $path = \base_path('.env.'.$env);

        $text = \file_get_contents($path);

        $enc = $crypt->encrypt($text);

        \file_put_contents($path . '.enc', $enc);

        if($delete === true) {
            \unlink($path);
        }

        $this->info("Encypted environment file for environment: ".$env);
    }
}
