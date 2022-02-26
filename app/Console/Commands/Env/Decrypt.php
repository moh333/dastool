<?php

namespace App\Console\Commands\Env;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class Decrypt extends Command
{
    protected $signature = 'env:decrypt {env=all} {key?} {--replace}';

    protected $description = 'Decrypt environment variable file';

    protected $environments = [
        'develop',
        'production',
    ];

    protected $key;

    public function handle()
    {
        $env = $this->argument('env');
        $this->key = $this->argument('key');
        $replace = $this->option('replace');

        if(empty($this->key)) {
            $this->key = self::getKeyFileContents();
        }

        if(empty($this->key)) {
            $this->key = Decrypt::getKeyFileContents();
        }

        if(!empty($env) && $env !== 'all') {
            $this->decrypt($env, $replace);
        } else {
            foreach ($this->environments as $env) {
                $this->decrypt($env, $replace);
            }
        }

    }

    protected function decrypt($env, $replace = false)
    {
        $crypt = new Encrypter($this->key, 'AES-256-CBC');

        $path = \base_path('.env.'.$env);

        $enc = \file_get_contents($path . '.enc');

        $dec = $crypt->decrypt($enc);

        if($replace === true) {
            $dest = \base_path('.env');
        } else {
            $dest = $path;
        }

        \file_put_contents($dest, $dec);

        $this->info("Decrypted environment file for environment: ".$env);
    }

    public static function getKeyFileContents(): string
    {
        return trim(\file_get_contents(\base_path('.envkey')));
    }
}
