<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelas extends Migration
{
	public function up()
	{
		$forge = \Config\Database::forge();
		$fields = [
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'nome'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'altura'      => [
				'type'           => 'DOUBLE',
				'default'        => 0.00,
			],
			'lactose' => [
				'type'           => 'INT',
				'default'        => 0,
			],
			'peso'      => [
				'type'           => 'DOUBLE',
				'default'        => 0.00,
			],
			'atleta' => [
				'type'           => 'INT',
				'default'        => 0,
			],
			'created_at'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
			'updated_at'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
			'deleted_at'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
		];
		$forge->addField($fields);
		$forge->createTable("pessoas");

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$forge = \Config\Database::forge();
		$forge->dropTable("pessoa");
	}
}
