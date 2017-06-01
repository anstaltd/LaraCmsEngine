<?php

namespace ChickenTikkaMasala\LaraCms\Commands;

use ChickenTikkaMasala\LaraCms\Models\Author;
use ChickenTikkaMasala\LaraCms\Models\Site;
use Illuminate\Console\Command;
use Illuminate\Validation\Validator;

/**
 * Class SiteCommand
 * @package ChickenTikkaMasala\LaraCms\Commands
 */
class AuthorCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laracms:author:create';

    /**
     * @var string
     */
    protected $description = 'Create a laracms author';


    public function handle()
    {
        $params = [];

        $author = new Author();

        $sites = Site::all([
            'id',
            'title',
        ]);

        if (count($sites) === 0) {
            $this->error('There are no sites to create a user for');
            exit;
        }

        $sorted = [];

        foreach($sites as $key => $site) {
            $sorted[$site['id']] = $site['title'];
        }

        $params['name'] = $this->ask('Name');
        $params['email'] = $this->ask('Email');
        $params['password'] = $this->secret('Password');
        $params['password_confirmation'] = $this->secret('Password confirm');
        $params['site_id'] = $this->choice('For which site?', $sorted);

        $params['site_id'] = array_flip($sorted)[$params['site_id']];

        $validator = \Validator::make($params, [
            'name' => 'required|min:2|max:255|string',
            'email' => 'required|email|max:255|unique:'.$author->getTable().'|string',
            'password' => 'required|string|min:6|confirmed',
            'site_id' => 'required|integer',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            foreach($errors->all() as $error) {
                $this->error($error);
            }

            exit;
        }

        $author->fill($params);
        $author->save();

        $this->info('Created new author '.$author->name.' with ID: '.$author->id);

    }

}
