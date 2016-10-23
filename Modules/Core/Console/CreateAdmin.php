<?php namespace Modules\Core\Console;

use App\User;
use Illuminate\Console\Command;
use Sentinel;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateAdmin extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'crm:create-admin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Adds an admin to the database';

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
	 * @return mixed
	 */
	public function fire()
	{
	    $this->line("Create an Admin:");
        $data['first_name']     = $this->ask('First Name:');
        $data['last_name']     = $this->ask('Last Name:');
        $data['email']    = $this->ask('E-Mail');
        $data['password'] = bcrypt($this->secret('Password:'));

        $admin = User::create($data);

        $role = Sentinel::getRoleRepository()->findBySlug('admin');
        $role->users()->attach($admin);

        $admin->save();
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			//['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
