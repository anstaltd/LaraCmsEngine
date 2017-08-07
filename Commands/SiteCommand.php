<?php

namespace Ansta\LaraCms\Commands;

use Ansta\LaraCms\Models\Site;
use Illuminate\Console\Command;

/**
 * Class SiteCommand
 * @package Ansta\LaraCms\Commands
 */
class SiteCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laracms:site:create';

    /**
     * @var string
     */
    protected $description = 'Create a laracms site';

    public function handle()
    {
        $params = [];

        $site = new Site();

        $params['title'] = $this->ask('Title');
        $params['domain'] = $this->ask('Domain');

        $validator = \Validator::make($params, [
            'title' => 'required|min:2|max:255|string',
            'domain' => 'required|max:255|unique:'.$site->getTable().',domain|string',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach($errors->all() as $error) {
                $this->error($error);
            }

            exit;
        }

        $params['config_data'] = [];

        $site->fill($params);
        $site->save();

        $this->info('Site created');
    }
}
