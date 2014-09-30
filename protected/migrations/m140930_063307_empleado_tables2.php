<?php

class m140930_063307_empleado_tables2 extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m140930_063307_empleado_tables2 does not support migration down.\n";
//		return false;
//	}

	public function safeUp()
	{
            
            $this->createTable('tbl_modalidad',array(
                'id'=>'pk',
                'modalidad'=>'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', //0=Si 1=No
                //'fecha_nacimiento'=>'date',
                //
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ) ,'ENGINE=InnoDB');
            
            $this->createTable('tbl_cargo',array(
                'id'=>'pk',
                'cargo'=>'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', //0=Si 1=No
                //'fecha_nacimiento'=>'date',
                //
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ) ,'ENGINE=InnoDB');
            
            //tabla empleado
            $this->createTable('tbl_empleado',array(
                'id'=>'pk',
                'nombre'=>'varchar(50) NOT NULL',
                'ap_paterno'=>'varchar(50) NOT NULL',
                'ap_materno'=>'varchar(50) DEFAULT NULL',
                'fecha_nacimiento'=>'date',
                'doc_identidad'=>'varchar(10) NOT NULL',
                'direccion'=>'varchar(100) DEFAULT NULL',
                'telefono'=>'varchar(50)',
                'movil'=>'varchar(50)',
                'cargo_id'=>'int(11)',
                'modalidad_id'=>'int(11)',
                'sub_sede_id'=>'int(11)',
                'oficina_id'=>'int(11)',
                //
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ) ,'ENGINE=InnoDB');
            
            //tabla usuario
           $this->createTable('tbl_usuario',array(
                'id'=>'pk',
                'username' => 'string NOT NULL',
                'email' => 'string ',
                'password' => 'string NOT NULL',
                'empleado_id'=>'int(11) NOT NULL',
                'last_login_time' => 'datetime DEFAULT NULL',
                'create_time' => 'datetime DEFAULT NULL',
                'create_user_id' => 'int(11) DEFAULT NULL',
                'update_time' => 'datetime DEFAULT NULL',
                'update_user_id' => 'int(11) DEFAULT NULL',
           ), 'ENGINE=InnoDB');
           
           //relacion empleado cargo
           $this->addForeignKey('fk_empleado_cargo', 'tbl_empleado', 'cargo_id', 'tbl_cargo', 'id','CASCADE','RESTRICT');
           //relacion empleado modalidad
           $this->addForeignKey('fk_empleado_modalidad', 'tbl_empleado', 'modalidad_id', 'tbl_modalidad', 'id','CASCADE','RESTRICT');
           
           //relacion empleado sub sede
           $this->addForeignKey('fk_empleado_subsede', 'tbl_empleado', 'sub_sede_id', 'tbl_sub_sede', 'id','CASCADE','RESTRICT');//relacion empleado cargo
           //relacion empleado oficina
           $this->addForeignKey('fk_empleado_oficina', 'tbl_empleado', 'oficina_id', 'tbl_oficina', 'id','CASCADE','RESTRICT');

            //Relación de empleado con usuario
            $this->addForeignKey('fk_empleado_usuario', 'tbl_usuario', 'empleado_id', 'tbl_empleado', 'id','CASCADE','RESTRICT');
	}

	public function safeDown()
	{
            $this->dropForeignKey('fk_empleado_cargo', 'tbl_empleado');
            $this->dropForeignKey('fk_empleado_modalidad', 'tbl_empleado');
            $this->dropForeignKey('fk_empleado_subsede', 'tbl_empleado');
            $this->dropForeignKey('fk_empleado_oficina', 'tbl_empleado');
            $this->dropForeignKey('fk_empleado_usuario', 'tbl_usuario');
            
            $this->dropTable('tbl_cargo');
            $this->dropTable('tbl_modalidad');
            $this->dropTable('tbl_empleado');
            $this->dropTable('tbl_usuario');
	}
}