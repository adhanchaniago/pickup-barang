<?php

function kapital($value)
{
	return ucwords(strtolower($value));
}
function nominal($value)
{
	return str_replace(',', '.', number_format($value));
}
function bg_status($value,$jenis = 'bg')
{
	switch ($value) {
		case 1:
			return $jenis.'-danger';
		break;
		case 2:
			return $jenis.'-warning';
		break;
		case 3:
			return $jenis.'-success';
		break;
		default:
			return $jenis.'-white';
		break;
	}
}
function text_status($value)
{
	switch ($value) {
		case 1:
			return 'text-light';
		break;
		case 2:
			return 'text-dark';
		break;
		case 3:
			return 'text-light';
		break;
		default:
			return '';
		break;
	}
}
