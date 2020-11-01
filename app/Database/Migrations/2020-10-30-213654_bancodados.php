<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bancodados extends Migration
{
	public function up()
	{
		$forge = \Config\Database::forge();
		$forge->createDatabase('ci_lanches',true);
	 }
	

	//--------------------------------------------------------------------

	public function down()
	{
		$forge = \Config\Database::forge();
		$forge->dropDatabase('ci_lanches');
	    
	}
}
