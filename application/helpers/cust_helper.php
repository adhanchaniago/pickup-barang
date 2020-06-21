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
		case 4:
			return $jenis.'-primary';
		break;
		default:
			return $jenis.'-white';
		break;
	}
}
function text_status($value,$jenis = 'text')
{
	switch ($value) {
		case 1:
			return $jenis.'-light';
		break;
		case 2:
			return $jenis.'-dark';
		break;
		case 3:
			return $jenis.'-light';
		break;
		case 4:
			return $jenis.'-light';
		break;
		default:
			return '';
		break;
	}
}
function icon_status($value,$jenis = 'fa')
{
	switch ($value) {
		case 1:
			return $jenis.'-stopwatch';
		break;
		case 2:
			return $jenis.'-shipping-fast';
		break;
		case 3:
			return $jenis.'-pallet';
		break;
		case 4:
			return $jenis.'-paper-plane';
		break;
		default:
			return '';
		break;
	}
}
