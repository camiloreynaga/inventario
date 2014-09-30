<?php

class m140930_051758_first_tables extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m140930_051758_first_tables does not support migration down.\n";
//		return false;
//	}

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
          
            //Tabla tipo de producto
            $this->createTable('tbl_tipo_producto',array(
                'id'=>'pk',
                'tipo_producto'=>'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', // 0=si ;1=no
                //registro para el sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');
            
            //Tabla Fabricante / Marca / Laboratorio
            $this->createTable('tbl_marca', array(
                'id'=>'pk',
                'marca'=>'varchar(50) NOT NULL',
                'activo'=>'bool DEFAULT 0', // 0=si ;1=no
                //registro para el sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');
            
            //Tabla Fabricante / Marca / Laboratorio
            $this->createTable('tbl_estado', array(
                'id'=>'pk',
                'estado'=>'varchar(50) NOT NULL',
                //registro para el sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');
            
            
            
            // tabla de bienes - tbl central de la app
            $this->createTable('tbl_bien', array(
                'id'=>'pk',
                'nombre_bien'=> 'VARCHAR(50) CHARACTER SET UTF8',
                //'codigo_patrimonial'=> 'VARCHAR(20) CHARACTER SET UTF8',
                //'codigo_interno'=> 'VARCHAR(20) CHARACTER SET UTF8',
                //'estado_id'=> 'INTEGER(11)', //fk
                'tipo_producto_id'=> 'INTEGER(11)',//FK
                'marca_id'=> 'INTEGER(11)', //fk
                'modelo'=> 'VARCHAR(20) CHARACTER SET UTF8',
                'color'=> 'VARCHAR(20) CHARACTER SET UTF8',
                //'serie'=> 'VARCHAR(50) CHARACTER SET UTF8',
                'dimensiones' =>'VARCHAR(50) CHARACTER SET UTF8',
                'observacion' =>'TEXT',
                //registro del sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');
            
            //Relaciones
            
            //producto tiene pertenece a un tipo
             $this->addForeignKey('fk_tipo_bien','tbl_bien', 'tipo_producto_id','tbl_tipo_producto', 'id', 'CASCADE', 'RESTRICT');
             //producto tiene un fabricante
             $this->addForeignKey('fk_marca_bien', 'tbl_bien', 'marca_id', 'tbl_marca', 'id', 'CASCADE', 'RESTRICT');
	}

	public function safeDown()
	{   
            $this->dropForeignKey('fk_tipo_bien', 'tbl_bien');
            $this->dropForeignKey('fk_marca_bien', 'tbl_bien');
            
            $this->truncateTable('tbl_bien');
            $this->truncateTable('tbl_tipo_producto');
            $this->truncateTable('tbl_marca');
            $this->truncateTable('tbl_estado');
            
            $this->dropTable('tbl_bien');
            $this->dropTable('tbl_tipo_producto');
            $this->dropTable('tbl_marca');
            $this->dropTable('tbl_estado');
	}
	
}