<?php

class m140930_060600_sede_tables extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m140930_060600_sede_tables does not support migration down.\n";
//		return false;
//	}

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
            $this->createTable('tbl_sede',array(
                'id'=>'pk',
                'sede'=>'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', //0=Si 1=No
                //'fecha_nacimiento'=>'date',
                //
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ) ,'ENGINE=InnoDB');
            
            //tabla empleado
            $this->createTable('tbl_sub_sede',array(
                'id'=>'pk',
                'sub_sede'=>'varchar(50) NOT NULL',
                'sede_id'=>'int(11)',
                'activo'=>'bool DEFAULT 0', //0=Si 1=No
                //
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ) ,'ENGINE=InnoDB');
            
            //tabla usuario
           $this->createTable('tbl_oficina',array(
                'id'=>'pk',
                'oficina' => 'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', //0=Si 1=No
                'create_time' => 'datetime DEFAULT NULL',
                'create_user_id' => 'int(11) DEFAULT NULL',
                'update_time' => 'datetime DEFAULT NULL',
                'update_user_id' => 'int(11) DEFAULT NULL',
           ), 'ENGINE=InnoDB');
           
           //relacion empleado cargo
           $this->addForeignKey('fk_sede_subsede', 'tbl_sub_sede', 'sede_id', 'tbl_sede', 'id','CASCADE','RESTRICT');
	}

	public function safeDown()
	{
            $this->dropForeignKey('fk_sede_subsede', 'tbl_sub_sede');
            
            $this->dropTable('tbl_sub_sede');
            $this->dropTable('tbl_sede');
            $this->dropTable('tbl_oficina');
	}
	
}