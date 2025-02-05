<?php
function Container_Insert($obj)
{
	$connQuery = new APP_BDD;
	$sql = 'INSERT INTO container VALUES (
	'.sqlIntNull($obj->IdContainer()).'
	, '.sqlIntNull($obj->IdContainerType()).'
	, '.sqlDateNull($obj->DateAcquisition()).'
	, '.sqlDateNull($obj->DateFin()).'
	, '.sqlStrNull($obj->Libelle()).')';
	if ($res = $connQuery->link->query($sql)) 
	{
		$obj->IdContainer(mysqli_insert_id($connQuery->link));
		$obj = Container_SelectOne($obj);
		unset($connQuery);
		return($obj);
	}else{unset($connQuery);
		return('error, insert failed.');
	}
}

function Container_Update($obj)
{
	$connQuery = new APP_BDD;
	$sql = 'UPDATE container SET 
	id_container = '.sqlIntNull($obj->IdContainer()).'
	, id_container_type = '.sqlIntNull($obj->IdContainerType()).'
	, date_acquisition = '.sqlDateNull($obj->DateAcquisition()).'
	, date_fin = '.sqlDateNull($obj->DateFin()).'
	, libelle = '.sqlStrNull($obj->Libelle()).'
	WHERE 
	id_container = '.$obj->IdContainer().'
	';
	if ($res = $connQuery->link->query($sql)) 
	{
		unset($connQuery);
		return($obj);
	}else{unset($connQuery);
		return('error, update failed.');
	}
}

function Container_Delete($obj)
{
	$connQuery = new APP_BDD;
	$sql = 'DELETE FROM container WHERE 
	id_container = '.$obj->IdContainer().'
	';
	if ($res = $connQuery->link->query($sql)) 
	{
		unset($connQuery);
		return(NULL);
	}else{unset($connQuery);
		return('error, delete failed.');
	}
}

function Container_SelectAll()
{
	$connQuery = new APP_BDD;
	$sql = 'SELECT * FROM container';
	$temp_coll = array();
	if ($res = $connQuery->link->query($sql))
	{
		foreach ($res as $key => $val) 
		{
			$temp_obj = new Container;
			$temp_obj->IdContainer($val['id_container']);
			$temp_obj->IdContainerType($val['id_container_type']);
			$temp_obj->DateAcquisition($val['date_acquisition']);
			$temp_obj->DateFin($val['date_fin']);
			$temp_obj->Libelle($val['libelle']);
			array_push($temp_coll, $temp_obj);
		}
		return $temp_coll;
	}
	else
	{
		unset($connQuery);
		return('error, update failed.');
	}
	unset($connQuery);
	return(1);
}

function Container_SelectOne($obj)
{
	$connQuery = new APP_BDD;
	$sql = 'SELECT * FROM container WHERE 
	id_container = '.$obj->IdContainer().'
	';
	if ($res = $connQuery->link->query($sql))
	{
		foreach ($res as $key => $val) 
		{
			$temp_obj = new Container;
			$temp_obj->IdContainer($val['id_container']);
			$temp_obj->IdContainerType($val['id_container_type']);
			$temp_obj->DateAcquisition($val['date_acquisition']);
			$temp_obj->DateFin($val['date_fin']);
			$temp_obj->Libelle($val['libelle']);
		}
		return $temp_obj;
	}
	else
	{
		unset($connQuery);
		return('error, update failed.');
	}
	unset($connQuery);
	return(1);
}

function Container_AllCol($obj)
{
	return('id_container
		, id_container_type
		, date_acquisition
		, date_fin
		, libelle');
}

// Added Func
function Container_SelectAllForASessionId($sessionId)
{
	$connQuery = new APP_BDD;
	$sql = 'SELECT * FROM `container` C 
			INNER JOIN many_vue_container VC 
				ON VC.id_container = C.id_container
			LEFT JOIN container_type CT
				ON CT.id_container_type = C.id_container_type
			WHERE 1';
	$temp_coll = array();
	if ($res = $connQuery->link->query($sql))
	{
		foreach ($res as $key => $val) 
		{
			$temp_containerType = new ContainerType;
			$temp_containerType->IdContainerType($val['id_container_type']);
			$temp_containerType->ContainerTypeLibelle($val['container_type_libelle']);
			$temp_container = new Container;
			$temp_container->IdContainer($val['id_container']);
			$temp_container->IdContainerType($val['id_container_type']);
			$temp_container->DateAcquisition($val['date_acquisition']);
			$temp_container->DateFin($val['date_fin']);
			$temp_container->Libelle($val['libelle']);
			$temp_container->ContainerType = $temp_containerType;
			array_push($temp_coll, $temp_container);
		}
		return $temp_coll;
	}
	else
	{
		unset($connQuery);
		return('error, update failed.');
	}
	unset($connQuery);
	return(1);
}
?>