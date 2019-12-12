<?php
namespace SharpMinds\Type;

interface TypeInterface
{	
	public function prepareToSave();

    public function convertToType();
	
	public function setValue($value);
}