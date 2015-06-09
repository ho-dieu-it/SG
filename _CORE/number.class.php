<?php

/*
	LEGO-PHP
	@author - Hoang Huy Phan
	@All rights reserved
	Support by	:	_
	Edited by	:	_
*/

//	Public function
//	*	string	ngat_so($so)	:	1000000.18 -> 1,000,000.18

//	Private function
//	*	string	ngat_so_($so)	:	1000000.18 -> 1,000,000

class	lg_number
{
//	Public	function
	public	function	money($so, $num = 0)
	{
		return	self::ngat_so($so);
		// return money_format($so , $num);
	}
	public	function	ngat_so($so)
	{
		$dau = "";
		if ($so < 0)	{	$so = abs($so);	$dau = "-"; }
		$x		=	explode(".",$so);
		$du		=	$x[1];
		$so		=	$x[0];
		$x		=	self::_ngat_so($so);
		if ( ($du <> 0) && (!empty($du)) )		$x		=	$x	.".".	$du;
		return	$dau.$x;
	}
//	Private	function
	private	function	_ngat_so($so)
	{
		$dem	=	0;
		$x		=	"";
		for ($i = strlen($so)-1; $i >= 0; $i--)
		{
			$dem++;
			$x = substr($so,$i,1).$x;
			if ( ($i <> 0) && ($dem % 3 == 0) )	$x = ",".$x;
		}
		return $x;
	}
}
?>