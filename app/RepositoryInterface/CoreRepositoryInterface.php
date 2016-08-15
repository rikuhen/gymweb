<?php

namespace GymWeb\RepositoryInterface;

/**
* Autor: 
* Jorge Luis Veliz
* Descripcion:
* Interface del cual todos los repositorios deben basarse
*/
interface CoreRepositoryInterface
{
	
	public function enum($params = null);


	public function find($id, $returnException = true);


	public function save($data);


	public function edit($id,$data);
	

	public function remove($id);
}