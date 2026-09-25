<?php
class ControleurDefaut
{
	public function defautAction($params, $post)
	{
		Vue::montrer('accueil', []);
	}
}