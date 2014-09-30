<?php

class m140930_063316_inventario_tables2 extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m140930_063316_inventario_tables2 does not support migration down.\n";
//		return false;
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
            
         $this->createTable('tbl_inventario', array(
                'id'=>'pk',
                'fecha_inventario'=>'DATETIME',
                'empleado_id'=> 'INTEGER(11)', //empleado responsable de bienes
                'responsable_id'=> 'INTEGER(11)',//inventariador responsbale
                //'dimensiones' =>'VARCHAR(50) CHARACTER SET UTF8',
                'folio'=>'Varchar(50)',
                'observacion' =>'TEXT',
                //registro del sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');   
            
         $this->createTable('tbl_detalle_inventario', array(
                'id'=>'pk',
                'inventario_id'=>'INTEGER(11)',
                'fecha_registro'=>'DATETIME',
                'bien_id'=> 'INTEGER(11)',
                'codigo_patrimonial'=> 'VARCHAR(20) CHARACTER SET UTF8',
                'codigo_interno'=> 'VARCHAR(20) CHARACTER SET UTF8',
                'estado_id'=> 'INTEGER(11)', //fk
                'marca_id'=> 'INTEGER(11)', //fk
                //'modelo'=> 'VARCHAR(20) CHARACTER SET UTF8',
                //'color'=> 'VARCHAR(20) CHARACTER SET UTF8',
                'serie'=> 'VARCHAR(50) CHARACTER SET UTF8',
                //'dimensiones' =>'VARCHAR(50) CHARACTER SET UTF8',
                'observacion' =>'TEXT',
                //registro del sistema
                'create_time'=>'datetime DEFAULT NULL',
                'create_user_id'=> 'int(11) DEFAULT NULL',
                'update_time'=>'datetime DEFAULT NULL',
                'update_user_id'=>'int(11) DEFAULT NULL',
            ),'ENGINE=InnoDB');
         //relacion inventario empleado
           $this->addForeignKey('fk_empleado_inventario', 'tbl_inventario', 'empleado_id', 'tbl_empleado', 'id','CASCADE','RESTRICT');
           //relacion inventario responsable
           $this->addForeignKey('fk_responsable_inventario', 'tbl_inventario', 'responsable_id', 'tbl_empleado', 'id','CASCADE','RESTRICT');
          //relacion inventario detalle
            $this->addForeignKey('fk_detalle_inventario', 'tbl_detalle_inventario', 'inventario_id', 'tbl_inventario', 'id','CASCADE','RESTRICT');
	
            //relacion bien detalle
            $this->addForeignKey('fk_bien_detalle', 'tbl_detalle_inventario', 'bien_id', 'tbl_bien', 'id','CASCADE','RESTRICT');
	
            //relacion estado detalle
            $this->addForeignKey('fk_estado_detalle', 'tbl_detalle_inventario', 'estado_id', 'tbl_estado', 'id','CASCADE','RESTRICT');
	
	}

	public function safeDown()
	{
            $this->dropForeignKey('fk_estado_detalle', 'tbl_detalle_inventario');
            $this->dropForeignKey('fk_bien_detalle', 'tbl_detalle_inventario');
            $this->dropForeignKey('fk_detalle_inventario', 'tbl_detalle_inventario');
            $this->dropForeignKey('fk_responsable_inventario', 'tbl_inventario');
            $this->dropForeignKey('fk_empleado_inventario', 'tbl_inventario');
            
            $this->truncateTable('tbl_detalle_inventario');
            $this->truncateTable('tbl_inventario');
            $this->dropTable('tbl_detalle_inventario');
            $this->dropTable('tbl_inventario');
                    
	}
}